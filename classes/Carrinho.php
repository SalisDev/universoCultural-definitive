<?php 
class Carrinho {
    // Método para adicionar um livro ao carrinho
    public static function adicionarCarrinho($idLivro, $idUsuario) {
        try {
            $pdo = MySql::conectar();
            
            // Verifica se o livro já está no carrinho do usuário
            $sql = $pdo->prepare("SELECT COUNT(*) FROM tbcarrinho WHERE cod_livro = ? AND cod_usuario = ?");
            $sql->execute([$idLivro, $idUsuario]);
            $count = $sql->fetchColumn();

            // Se o livro já estiver no carrinho, não adiciona novamente
            if ($count > 0) {
                return false; // Retorna false, indicando que o livro já está no carrinho
            }

            // Caso contrário, adiciona o livro ao carrinho
            $sql = $pdo->prepare("INSERT INTO tbcarrinho (cod_livro, cod_usuario) VALUES (?, ?)");
            $sql->execute([$idLivro, $idUsuario]);
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar carrinho: " . $e->getMessage());
            return false;
        }
    }

    // Método para listar os livros do carrinho
    public static function listarCarrinho($idUsuario) {
        try {
            $pdo = MySql::conectar();
            $sql = $pdo->prepare("
                SELECT 
                    c.cod AS carrinho_id,
                    l.nome,
                    l.autor,
                    l.idioma,
                    l.preco,
                    l.imagem,
                    l.estoque AS estoque
                FROM tbcarrinho c
                INNER JOIN tbLivro l ON c.cod_livro = l.cod
                WHERE c.cod_usuario = ?
            ");
            $sql->execute([$idUsuario]);
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar os livros do carrinho: " . $e->getMessage());
            return false;
        }
    }
    
    // Método para excluir um livro do carrinho
    public static function removerLivroCarrinho($idCarrinho, $idUsuario) {
        try {
            $pdo = MySql::conectar();
            
            // Verificar se o livro existe no carrinho do usuário
            $sql = $pdo->prepare("SELECT COUNT(*) FROM tbcarrinho WHERE cod = ? AND cod_usuario = ?");
            $sql->execute([$idCarrinho, $idUsuario]);
            $count = $sql->fetchColumn();

            if ($count > 0) {
                // Se o livro está no carrinho, execute a remoção
                $sql = $pdo->prepare("DELETE FROM tbcarrinho WHERE cod = ? AND cod_usuario = ?");
                $sql->execute([$idCarrinho, $idUsuario]);
                return true;
            } else {
                return false; // Caso o livro não esteja no carrinho
            }
        } catch (PDOException $e) {
            error_log("Erro ao remover livro do carrinho: " . $e->getMessage());
            return false;
        }
    }
    
}

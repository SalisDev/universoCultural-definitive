<?php 
class Carrinho {
    public static function adicionarCarrinho($idLivro, $idUsuario) {
        try {
            $pdo = MySql::conectar();
            $sql = $pdo->prepare("INSERT INTO tbcarrinho (cod_livro, cod_usuario) VALUES (?, ?)");
            $sql->execute([$idLivro, $idUsuario]);
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar carrinho: " . $e->getMessage());
            return false;
        }
    }

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
    

    public static function excluirLivroCarrinho($id) {
        try {
            $pdo = MySql::conectar();
            $sql = $pdo->prepare("DELETE FROM tbcarrinho WHERE cod = ?");
            $sql->execute([$id]);
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao excluir livro do carrinho: " . $e->getMessage());
            return false;
        }
    }
}

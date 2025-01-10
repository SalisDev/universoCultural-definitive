<?php 
class Favorito {
    // Método para adicionar ou remover livro dos favoritos
    public static function adicionarFavorito($idLivro, $idUsuario) {
        try {
            $pdo = MySql::conectar();
            
            // Verifica se o livro já está favoritado pelo usuário
            $sql = $pdo->prepare("SELECT COUNT(*) FROM tbfavorito WHERE cod_livro = :cod_livro AND cod_usuario = :cod_usuario");
            $sql->bindParam(':cod_livro', $idLivro, PDO::PARAM_INT);
            $sql->bindParam(':cod_usuario', $idUsuario, PDO::PARAM_INT);
            $sql->execute();
            $count = $sql->fetchColumn();
    
            if ($count > 0) {
                // Se o livro já está nos favoritos, remove o favorito
                $sql = $pdo->prepare("DELETE FROM tbfavorito WHERE cod_livro = :cod_livro AND cod_usuario = :cod_usuario");
                $sql->bindParam(':cod_livro', $idLivro, PDO::PARAM_INT);
                $sql->bindParam(':cod_usuario', $idUsuario, PDO::PARAM_INT);
                $sql->execute();
                return 'removido'; // Retorna "removido" quando desfavorita
            }
    
            // Se o livro não está favoritado, insere no banco
            $sql = $pdo->prepare("INSERT INTO tbfavorito (cod_livro, cod_usuario) VALUES (:cod_livro, :cod_usuario)");
            $sql->bindParam(':cod_livro', $idLivro, PDO::PARAM_INT);
            $sql->bindParam(':cod_usuario', $idUsuario, PDO::PARAM_INT);
            $sql->execute();
    
            return 'adicionado'; // Retorna "adicionado" quando favoritado
        } catch (PDOException $e) {
            error_log("Erro ao adicionar ou remover favorito: " . $e->getMessage());
            return false;
        }
    }
    
    // Método para listar os favoritos do usuário
    public static function listarLivros($idUsuario) {
        try {
            $pdo = MySql::conectar();
            // Alterando o LEFT JOIN para INNER JOIN para listar apenas os livros favoritados
            $sql = $pdo->prepare("
                SELECT 
                    l.cod,
                    l.nome,
                    l.subtitulo,
                    l.imagem,
                    l.preco,
                    l.estoque,
                    f.cod_livro AS is_favorite
                FROM tbLivro l
                INNER JOIN tbfavorito f ON l.cod = f.cod_livro
                WHERE f.cod_usuario = :cod_usuario
            ");
            $sql->bindParam(':cod_usuario', $idUsuario, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar os livros favoritos: " . $e->getMessage());
            return false;
        }
    }
    
    
    
    
    // Método para excluir um livro dos favoritos do usuário
    public static function excluirLivroFavorito($idLivro, $idUsuario) {
        try {
            $pdo = MySql::conectar();
            
            // Se o livro já está nos favoritos, remove o favorito
            $sql = $pdo->prepare("DELETE FROM tbfavorito WHERE cod_livro = ? AND cod_usuario = ?");
            $sql->execute([$idLivro, $idUsuario]);

            return 'removido';
        } catch (PDOException $e) {
            error_log("Erro ao excluir livro dos favoritos: " . $e->getMessage());
            return false;
        }
    }
}



<?php 
class Favorito {
    public static function adicionarFavorito($idLivro, $idUsuario) {
        try {
            $pdo = MySql::conectar();
            $sql = $pdo->prepare("INSERT INTO tbfavorito (cod_livro, cod_usuario) VALUES (?, ?)");
            $sql->execute([$idLivro, $idUsuario]);
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar carrinho: " . $e->getMessage());
            return false;
        }
    }

    public static function listarFavorito($idUsuario) {
        try {
            $pdo = MySql::conectar();
            $sql = $pdo->prepare("
                SELECT 
                    c.cod AS favorito_id,
                    l.nome,
                    l.autor,
                    l.idioma,
                    l.preco,
                    l.imagem,
                    l.estoque AS estoque
                FROM tbfavorito c
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
    

    public static function excluirLivroFavorito($id) {
        try {
            $pdo = MySql::conectar();
            $sql = $pdo->prepare("DELETE FROM tbfavorito WHERE cod = ?");
            $sql->execute([$id]);
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao excluir livro do carrinho: " . $e->getMessage());
            return false;
        }
    }
}

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
            $sql = $pdo->prepare("SELECT * FROM tbcarrinho WHERE cod_usuario = ?");
            $sql->execute([$idUsuario]);
            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar os livros". $e->getMessage());
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

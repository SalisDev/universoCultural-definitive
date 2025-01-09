<?php 
class Compra {
    public static function cadastrarCompra($entrega, $hora, $dataCompra, $quantidade, $livro, $usuario) {
        try {
            $pdo = MySql::conectar();
            $sql = $pdo->prepare("INSERT INTO tbcompra (entrega, hora, dataCompra, quantidade, livro, usuario) VALUES (?, ?, ?, ?, ?, ?)");
            $sql->execute([$entrega, $hora, $dataCompra, $quantidade, $livro, $usuario]);
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar compra: " . $e->getMessage());
            return false;
        }
    }

    public static function atualizarCompra($id, $entrega, $hora, $dataCompra, $quantidade, $livro, $usuario) {
        try {
            $pdo = MySql::conectar();
            $sql = $pdo->prepare( "UPDATE tbcompra SET entrega = ?, hora = ?, dataCompra = ?, quantidade = ?, livro = ?, usuario = ? WHERE cod = ?");
            $sql->execute([$entrega, $hora, $dataCompra, $quantidade, $livro, $usuario, $id]);
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao atualizar compra: " . $e->getMessage());
            return false;
        }
    }

    public static function excluirCompra($id) {
        try {
            $pdo = MySql::conectar();
            $sql = $pdo->prepare("DELETE FROM tbcompra WHERE cod = ?");
            $sql->execute([$id]);
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao excluir compra: " . $e->getMessage());
            return false;
        }
    }
}

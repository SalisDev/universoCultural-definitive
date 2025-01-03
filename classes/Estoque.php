<?php
class Estoque {
    public static function cadastrarEstoque($quantidade, $valorVenda, $valorCompra, $lote) {
        try {
            $pdo = MySql::conectar();
            $sql = $pdo->prepare("INSERT INTO estoque (quantidade, valorVenda, valorCompra, lote) VALUES (?, ?, ?, ?)");
            $sql->execute([$quantidade, $valorVenda, $valorCompra, $lote]);
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar estoque: " . $e->getMessage());
            return false;
        }
    }

    public static function atualizarEstoque($id, $quantidade, $valorVenda, $valorCompra, $lote) {
        try {
            $pdo = MySql::conectar();
            $sql = $pdo->prepare("UPDATE estoque SET quantidade = ?, valorVenda = ?, valorCompra = ?, lote = ? WHERE cod = ?");
            $sql->execute([$quantidade, $valorVenda, $valorCompra, $lote, $id]);
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao atualizar estoque: " . $e->getMessage());
            return false;
        }
    }

    public static function excluirEstoque($id) {
        try {
            $pdo = MySql::conectar();
            $sql = $pdo->prepare("DELETE FROM estoque WHERE cod = ?");
            $sql->execute([$id]);
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao excluir estoque: " . $e->getMessage());
            return false;
        }
    }
}
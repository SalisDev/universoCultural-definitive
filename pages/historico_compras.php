<?php
// Verifique se o usuário está logado
if (!isset($_SESSION['cod'])) {
    echo '<script>alert("Você precisa estar logado para acessar o histórico de compras!");</script>';
    exit;
}

$idUsuario = $_SESSION['cod'];

// Função para listar compras do usuário
function listarCompras($usuario) {
    try {
        $pdo = MySql::conectar();
        $sql = $pdo->prepare("SELECT * FROM tbcompra WHERE usuario = ? ORDER BY dataCompra DESC");
        $sql->execute([$usuario]);
        return $sql->fetchAll();
    } catch (PDOException $e) {
        error_log("Erro ao listar compras: " . $e->getMessage());
        return false;
    }
}

$compras = listarCompras($idUsuario);
?>

<div class="container">
    <div class="history-title">
        <h2>Histórico de Compras</h2>
    </div>
    <div class="history-list">
        <?php
        if ($compras && count($compras) > 0) {
            foreach ($compras as $compra) {
                echo '
                <div class="purchase-container">
                    <div class="purchase-details">
                        <div><strong>Livro:</strong> ' . htmlspecialchars(Livro::pegarNome($compra['livro'])) . '</div>
                        <div><strong>Quantidade:</strong> ' . htmlspecialchars($compra['quantidade']) . '</div>
                        <div><strong>Data da Compra:</strong> ' . date("d/m/Y", strtotime($compra['dataCompra'])) . '</div>
                        <div><strong>Status da Entrega:</strong> ' . htmlspecialchars($compra['entrega']) . '</div>
                    </div>
                </div>';
            }
        } else {
            echo '<p class="text-center">Você ainda não fez nenhuma compra.</p>';
        }
        ?>
    </div>
</div>

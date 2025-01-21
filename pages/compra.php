<style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}
.container {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}
.confirmation-header {
    margin-bottom: 20px;
}
.confirmation-header h1 {
    font-size: 2em;
    margin-bottom: 10px;
}
.confirmation-header p {
    font-size: 1.2em;
    color: #666;
}
.order-details {
    display: flex;
    align-items: flex-start;
    gap: 20px;
}
.image-section img {
    max-width: 200px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}
.order-info {
    flex: 1;
    text-align: left; /* Garante alinhamento do texto */
}
.order-info ul {
    list-style: none;
    padding: 0;
    font-size: 1.2em;
}
.order-info li {
    margin-bottom: 10px;
}
.price-total {
    font-size: 1.5em;
    font-weight: bold;
    margin-top: 20px;
}
.buttons {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}
.buttons button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1em;
    color: #fff;
    transition: all 0.3s ease;
}
.cancel-btn {
    background-color: #dc3545; /* Vermelho */
}
.cancel-btn:hover {
    background-color: #b02a37; /* Vermelho mais escuro */
}
.confirm-btn {
    background-color: #28a745; /* Verde */
}
.confirm-btn:hover {
    background-color: #218838; /* Verde mais escuro */
}
.buttons button:focus {
    outline: 2px solid #007bff;
}
@media (max-width: 768px) {
    .order-details {
        flex-direction: column;
        align-items: flex-start;
    }
    .buttons {
        flex-direction: column;
        width: 100%;
        align-items: flex-start;
    }
    .buttons button {
        width: 100%;
    }
}
</style>



<?php


if (isset($_GET['cod'])) {
    $idLivro = $_GET['cod'];
    $livroDetalhes = Livro::buscarLivroPorId($idLivro);

    $idUsuario = $_SESSION['cod'];
    if (isset($_POST['finalizarCompra'])) {
        $hora = date("H:i:s"); // Hora da compra
        $dataCompra = date("Y-m-d");
        if (Compra::cadastrarCompra("pendente", $hora,$dataCompra, 1, $idLivro, $idUsuario)) { // Alterado para Compra::finalizarCompra
            echo '<script>alert("Compra finalizada com sucesso!");</script>';
            header("Location: historico_compras"); // Redireciona para o histórico de compras
            exit;
        } else {
            echo '<script>alert("Erro ao finalizar compra!");</script>';
        }
    }

    if ($livroDetalhes) {
        echo '
        <div class="container">
            <div class="confirmation-header">
                <h1>Confirmar Compra</h1>
                <p>Revise os detalhes da sua compra antes de finalizar.</p>
            </div>
            <div class="order-details">
                <div class="image-section">
                    <img src="' . htmlspecialchars($livroDetalhes['imagem']) . '" alt="Capa do livro ' . htmlspecialchars($livroDetalhes['nome']) . '">
                </div>
                <div class="order-info">
                    <ul>
                        <li><strong>Produto:</strong> ' . htmlspecialchars($livroDetalhes['nome']) . '</li>
                        <li><strong>Editora:</strong> ' . htmlspecialchars($livroDetalhes['editora']) . '</li>
                        <li><strong>Quantidade:</strong> 1</li>
                        <li><strong>Preço Unitário:</strong> R$ ' . number_format(floatval($livroDetalhes['preco']), 2, ',', '.') . '</li>
                        <li><strong>Total do Pedido:</strong> R$ ' . number_format(floatval($livroDetalhes['preco']), 2, ',', '.') . '</li>
                    </ul>
                    <p class="price-total">Total: R$ ' . number_format(floatval($livroDetalhes['preco']), 2, ',', '.') . '</p>
                    <div class="buttons">
                        <button class="cancel-btn" onclick="history.back()">Cancelar</button>
                        <form method="POST" action="">
                            <button type="submit" name="finalizarCompra" class="confirm-btn">Confirmar Compra</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>';
    } else {
        echo 'O id procurado é ' . htmlspecialchars($_GET['cod']);
    }
} else {
    echo '<p>ID do livro não especificado.</p>';
}


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Compra</title>
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
</head>
<body>
    <div class="container">
        <div class="confirmation-header">
            <h1>Confirmar Compra</h1>
            <p>Revise os detalhes da sua compra antes de finalizar.</p>
        </div>
        <div class="order-details">
            <div class="image-section">
                <img src="public/imagens/Biblioteca-da-meia-noite.jpg" alt="Capa do livro 'Biblioteca da Meia-Noite'">
            </div>
            <div class="order-info">
                <ul>
                    <li><strong>Produto:</strong> Biblioteca da Meia-Noite</li>
                    <li><strong>Editora:</strong> SLA</li>
                    <li><strong>Quantidade:</strong> 1</li>
                    <li><strong>Preço Unitário:</strong> R$ 49,90</li>
                    <li><strong>Total do Pedido:</strong> R$ 49,90</li>
                </ul>
                <p class="price-total">Total: R$ 49,90</p>
                <div class="buttons">
                    <button class="cancel-btn">Cancelar</button>
                    <button class="confirm-btn">Confirmar Compra</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

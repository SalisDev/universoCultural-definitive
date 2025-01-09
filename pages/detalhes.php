<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Livro</title>
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
        .book-details {
            display: flex;
            gap: 20px;
        }
        .image-section img {
            max-width: 300px;
            border-radius: 8px;
        }
        .info-section {
            flex: 1;
            text-align: left; /* Garante alinhamento à esquerda */
        }
        .info-section h1 {
            font-size: 2em;
            margin-bottom: 10px;
        }
        .info-section ul {
            list-style: none;
            padding: 0;
            font-size: 1.2em;
        }
        .info-section li {
            margin-bottom: 10px;
        }
        .info-section .price {
            margin: 20px 0;
            font-size: 1.5em;
            font-weight: bold;
        }
        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        .buttons button {
            flex: 1;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            color: #fff;
            transition: all 0.3s ease;
        }
        .cart-btn {
            background-color: #a235dc;
        }
        .cart-btn:hover {
            background-color: #971da7;
            transform: scale(1.05);
        }
        .buy-btn {
            background-color: #28a745; /* Verde */
        }
        .buy-btn:hover {
            background-color: #218838; /* Tom de verde mais escuro */
            transform: scale(1.05);
        }
        @media (max-width: 768px) {
            .book-details {
                flex-direction: column;
                align-items: center;
            }
            .image-section img {
                max-width: 80%;
            }
            .info-section {
                text-align: left; /* Alinhamento à esquerda mantido em dispositivos menores */
            }
            .buttons {
                flex-direction: column;
            }
            .buttons button {
                flex: none;
                width: 100%;
            }
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="book-details">
            <div class="image-section">
                <img src="public/imagens/Biblioteca-da-meia-noite.jpg" alt="Capa do livro 'Biblioteca da Meia-Noite'">
            </div>
            <div class="info-section">
                <h1>Biblioteca da Meia-Noite</h1>
                <ul class="book-metadata">
                    <li>Editora: SLA</li>
                    <li>Capa: Simples</li>
                    <li>Quantidade de páginas: 123</li>
                    <li>Restantes no estoque: 456</li>
                    <li>Idioma: Português</li>
                    <li>Gênero: Aventura</li>
                    <li>Ano de lançamento: 2023</li>
                </ul>
                <p class="price">Preço: R$ 49,90</p>
                <div class="buttons">
                    <button class="cart-btn">Adicionar ao Carrinho</button>
                    <button class="buy-btn">Comprar</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

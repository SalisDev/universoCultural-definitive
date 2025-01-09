<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>do carrinho</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .book-container {
            max-width: 100%;
            margin: 10px 0;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .book-image {
            width: 150px;
            height: auto;
            border-radius: 5px;
        }

        .book-details {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            justify-content: center; /* Alinha as informações centralizadas verticalmente */
        }

        .book-title, .book-price, .book-info {
            margin: 5px 0;
            text-align: left;
        }

        .book-title strong, .book-price strong {
            font-weight: bold; /* Faz com que as palavras 'Capa' e 'Autor' fiquem em negrito */
        }

        .remove-cart-btn, .buy-btn {
            padding: 10px 20px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            margin-bottom: 10px; /* Espaço entre os botões */
            width: 100%; /* Faz com que os botões ocupem a largura total disponível */
        }

        .remove-cart-btn {
            background-color: #dc3545;
        }
        
        .remove-cart-btn:hover {
            background-color: #a71d2a;
            transform: scale(1.05); /* Pequena animação ao passar o mouse */
        }

        .buy-btn {
            background-color: #28a745;
        }

        .buy-btn:hover {
            background-color: #218838;
            transform: scale(1.05); /* Pequena animação ao passar o mouse */
        }

        /* Agrupa os botões e empilha verticalmente */
        .button-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
    </style>
</head>
<body>
  <div class="container">
      <div class="cart-title">
          <h2>Livros do carrinho</h2>
      </div>
      <div class="book-list" id="cartList"> 
          <!-- Exemplo de livro carrinho -->
          <div class="book-container">
              <img src="public/imagens/mentindo.jpg" alt="Livro do carrinho" class="book-image">
              <div class="book-details">
                  <div class="book-title">Um de Nós Está Mentindo</div>
                  <div class="book-info"><strong>Capa:</strong> Dura</div>
                  <div class="book-info"><strong>Autor:</strong> Karen Slaoq</div>
                  <div class="book-info"><strong>idioma:</strong> portugas</div>
                  <div class="book-info"><strong>quantidade no estoque:</strong> sla mn</div>
                  <div class="book-price"><strong>Preço</strong> R$ 45,52</div>
              </div>
              <div class="button-group">
                    <button class="remove-fav-btn">Remover do Carrinho</button>
                    <button class="cart-btn">Remover do Carrinho</button>
                        
                  <button class="buy-btn">Comprar</button>
              </div>
          </div>
          <!-- Outros livros do carrinho serão adicionados aqui dinamicamente -->
      </div>
  </div>

</body>
</html>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Inicial</title>
    <link rel="stylesheet" href="Estilos.css"> <!-- Link para o CSS externo -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Link para funcionalidades do Bootstrap -->
</head>

<style>
        
.book-container {
  flex: 1 1 calc(25% - 40px); /* Cada item ocupa até 25% da largura, com um gap ajustado */
  max-width: 250px; /* Largura máxima para os livros */
  margin: 10px;
  border: 1px solid #ddd;
  padding: 15px;
  border-radius: 10px;
  text-align: center;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease;
  background-color: #ffffff;
}

.book-container:hover {
  transform: scale(1.05);
}

.book-image {
  width: 100%;
  height: auto; /* Manter proporções corretas */
  object-fit: cover;
  border-radius: 5px;
}

.book-title {
  font-size: 18px;
  font-weight: bold;
  margin-top: 10px;
}

.book-price {
  font-size: 16px;
  color: green;
  margin-top: 5px;
}

.book-details-btn {
  margin-top: 10px;
  padding: 8px 15px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.book-details-btn:hover {
  background-color: #0056b3;
}

.book-list {
  display: flex;
  flex-wrap: wrap; /* Permite que os elementos quebrem linha */
  justify-content: center; /* Centraliza os itens na horizontal */
  gap: 20px; /* Adiciona espaço entre os livros */
  padding: 20px; /* Espaço interno ao redor da lista */
}

.book-icons {
  margin: 10px 0;
  display: flex;
  justify-content: center;
  gap: 10px;
}

.icon-btn {
  background-color: transparent;
  border: none;
  font-size: 20px;
  cursor: pointer;
  color: #555;
  transition: color 0.3s;
}

.icon-btn:hover {
  color: #ff6f61;
}

.buy-btn {
  background-color: #4caf50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.buy-btn:hover {
  background-color: #2b5f2d;
}
.detal-btn {
  background-color: #4c6daf;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.detal-btn:hover {
  background-color: #2b355f;
}

    </style>

<body class="adicionar">
    <!-- Carrossel -->
    <div id="bookCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?php echo INCLUDE_PATH; ?>public/imagens/promocao.jpeg" class="d-block w-100" alt="Promoção">
            </div>
            <div class="carousel-item">
                <img src="<?php echo INCLUDE_PATH; ?>public/imagens/destaques.jpeg" class="d-block w-100" alt="Novidades">
            </div>
            <!-- <div class="carousel-item">
                <img src="https://via.placeholder.com/1200x400?text=Livros+Populares" class="d-block w-100" alt="Populares">
            </div> -->
        </div>
        <a class="carousel-control-prev" href="#bookCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#bookCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Próximo</span>
        </a>
    </div>

    <!-- Exposição dos Livros -->
     
</div>
    <div class="container mt-5">
        <div class="exibitonTitle">
            <h2 class="text-center mb-4">Livros Disponíveis</h2>
        </div>
        <div class="book-list">
        
        
        
        <?php
            $livros = Livro::listarLivros(); // Obtém os livros do banco de dados

            if ($livros && count($livros) > 0) {
                foreach ($livros as $livro) {
                    echo '
                    <div class="book-container">
                        <img src="' . htmlspecialchars($livro['imagem']) . '" alt="' . htmlspecialchars($livro['subtitulo']) . '" class="book-image">
                        <div class="book-title">' . htmlspecialchars($livro['subtitulo']) . '</div>
                        <div class="book-author"><strong>nome:</strong> ' . htmlspecialchars($livro['nome']) . '</div>
                        <div class="book-author"><strong>Capa:</strong> ' . htmlspecialchars($livro['capa']) . '</div>
                        <div class="book-price"><strong>Preço:</strong> R$ ' . htmlspecialchars($livro['estoque']) . '</div>
                        <button class="book-details-btn">Ver Detalhes</button>
                    </div>';
                }
            } else {
                echo '<p class="text-center">Nenhum livro disponível no momento.</p>';
            }
        ?>

            
        <!-- exemplo -->
     <div class="book-container">
        <img src="public/imagens/mentindo.jpg" alt="Livro 4" class="book-image">
        <div class="book-title">um de nos está mentindo</div>
        <div class="book-price">R$ 45,52</div>
        <div class="book-icons">
            <button class="icon-btn" title="Adicionar aos Favoritos">
                <i class="fas fa-heart"></i> <!-- Ícone de Favoritos -->
            </button>
            <button class="icon-btn" title="Adicionar ao Carrinho">
                <i class="fas fa-shopping-cart"></i> <!-- Ícone de Carrinho -->
            </button>
        </div>

        <button class="buy-btn">Comprar</button> <!-- Botão de Comprar -->
        <button class="detal-btn">detalhes</button> <!-- Botão de Comprar -->
        
      </div>
     <!-- fim do exemplo -->

        </div> 
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

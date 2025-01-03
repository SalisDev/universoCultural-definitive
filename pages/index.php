<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Inicial</title>
    <link rel="stylesheet" href="Estilos.css"> <!-- Link para o CSS externo -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Link para funcionalidades do Bootstrap -->
</head>
<body class="adicionar">
    <!-- Carrossel -->
    <div id="bookCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?php echo INCLUDE_PATH; ?>public/imagens/black.jpeg" class="d-block w-100" alt="Promoção">
            </div>
            <div class="carousel-item">
                <img src="<?php echo INCLUDE_PATH; ?>public/imagens/frete.jpeg" class="d-block w-100" alt="Novidades">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1200x400?text=Livros+Populares" class="d-block w-100" alt="Populares">
            </div>
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
                        <div class="book-author"><strong>Autor:</strong> ' . htmlspecialchars($livro['autor']) . '</div>
                        <div class="book-author"><strong>Capa:</strong> ' . htmlspecialchars($livro['capa']) . '</div>
                        <div class="book-price"><strong>Preço:</strong> R$ ' . htmlspecialchars($livro['estoque']) . '</div>
                        <button class="book-details-btn">Ver Detalhes</button>
                    </div>';
                }
            } else {
                echo '<p class="text-center">Nenhum livro disponível no momento.</p>';
            }
            ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

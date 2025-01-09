    <!-- Carrossel -->
    <div id="bookCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?php echo INCLUDE_PATH; ?>public/imagens/promocao.jpeg" class="d-block w-100" alt="Promoção">
            </div>
            <div class="carousel-item">
                <img src="<?php echo INCLUDE_PATH; ?>public/imagens/destaques.jpeg" class="d-block w-100"
                    alt="Novidades">
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
            $livros = Livro::listarLivros();
            
            if ($livros && count($livros) > 0) {
                foreach ($livros as $livro) {
                    echo '
                    <div class="book-container">
                        <img src="' . htmlspecialchars($livro['imagem']) . '" alt="' . htmlspecialchars($livro['subtitulo']) . '" class="book-image">
                        <div class="book-title">' . htmlspecialchars($livro['nome']) . '</div>
                        <div class="book-price">R$ ' . floatval($livro['preco']) . '</div>
                        <div class="book-icons">
                            <button class="icon-btn" title="Adicionar aos Favoritos">
                                <i class="fas fa-heart"></i> <!-- Ícone de Favoritos -->
                            </button>
                            <button class="icon-btn" title="Adicionar ao Carrinho">
                                <i class="fas fa-shopping-cart"></i> <!-- Ícone de Carrinho -->
                            </button>
                        </div>
                        <button class="buy-btn">Comprar</button> <!-- Botão de Comprar -->
                        <button class="detal-btn">Detalhes</button> <!-- Botão de Comprar -->
                    </div>';
                }
            } else {
                echo '<p class="text-center">Nenhum livro disponível no momento.</p>';
            }
            ?>
        </div>
    </div>

    <!-- Scripts -->
    
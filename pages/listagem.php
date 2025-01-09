<!-- Exposição dos Livros -->
<div class="container mt-5">
    <div class="exibitonTitle">
        <h2 class="text-center mb-4">Livros Disponíveis</h2>
        <h3><a href=""></a></h3>
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
                        <button Id="buy-btn">Comprar</button> <!-- Botão de Comprar -->
                        <button class="detal-btn">Detalhes</button> <!-- Botão de Comprar -->
                    </div>';
                }
            } else {
                echo '<p class="text-center">Nenhum livro disponível no momento.</p>';
            }
            ?>

</div>
        <!-- livros adicionadas dinamicamente pelo php -->
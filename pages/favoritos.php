<div class="container">
    <div class="favorites-title">
        <h2>Meus Favoritos</h2>
    </div>
    <div class="book-list" id="favoritesList">
        <?php
        $idUsuario = $_SESSION['cod'];
        $favoritos = Favorito::listarFavorito($idUsuario); // Obtém os livros favoritos do banco de dados

        if ($favoritos && count($favoritos) > 0) {
            foreach ($favoritos as $favorito) {
                echo '
                <div class="book-containerList">
                    <img src="' . htmlspecialchars($favorito['imagem']) . '" alt="' . htmlspecialchars($favorito['nome']) . '" class="book-imageList">
                    <div class="book-detailsList">
                        <div class="book-title"><strong>Nome:</strong> ' . htmlspecialchars($favorito['nome']) . '</div>
                        <div class="book-info"><strong>Autor:</strong> ' . htmlspecialchars($favorito['autor']) . '</div>
                        <div class="book-info"><strong>Idioma:</strong> ' . htmlspecialchars($favorito['idioma']) . '</div>
                        <div class="book-info"><strong>Estoque:</strong> ' . htmlspecialchars($favorito['estoque']) . '</div>
                        <div class="book-price"><strong>Preço:</strong> R$ ' . number_format($favorito['preco'], 2, ',', '.') . '</div>
                    </div>
                    <div class="button-group">
                        <form method="POST" action="removerFavorito.php">
                            <input type="hidden" name="idFavorito" value="' . htmlspecialchars($favorito['favorito_id']) . '">
                            <button type="submit" class="remove-fav-btn">Remover dos Favoritos</button>
                        </form>
                        <form method="POST" action="adicionarCarrinho.php">
                            <input type="hidden" name="idLivro" value="' . htmlspecialchars($favorito['favorito_id']) . '">
                            <button type="submit" class="cart-btn">Adicionar ao Carrinho</button>
                        </form>
                        <button class="buy-btn">Comprar</button>
                    </div>
                </div>';
            }
        } else {
            echo '<p class="text-center">Nenhum livro nos favoritos no momento.</p>';
        }
        ?>
    </div>
</div>

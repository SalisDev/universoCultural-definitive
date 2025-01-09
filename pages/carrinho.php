<?php 
$idUsuario = $_SESSION['cod'];
?>

<div class="container">
    <div class="cart-title">
        <h2>Carrinho de compras</h2>
    </div>
    <div class="book-list" id="cartList">
        <?php
        $carrinhos = Carrinho::listarCarrinho($idUsuario);
        if ($carrinhos && count($carrinhos) > 0) {
            foreach ($carrinhos as $carrinho) {
                echo '
                <div class="book-containerList">
                    <img src="' . $carrinho['imagem'] . '" alt="' . htmlspecialchars($carrinho['nome']) . '" class="book-imageList">
                    <div class="book-detailsList">
                        <div class="book-title">' . htmlspecialchars($carrinho['nome']) . '</div>
                        <div class="book-info"><strong>Autor:</strong> ' . htmlspecialchars($carrinho['autor']) . '</div>
                        <div class="book-info"><strong>Idioma:</strong> ' . htmlspecialchars($carrinho['idioma']) . '</div>
                        <div class="book-info"><strong>Quantidade no Estoque:</strong> ' . htmlspecialchars($carrinho['estoque']) . '</div>
                        <div class="book-price"><strong>Preço:</strong> R$ ' . number_format($carrinho['preco'], 2, ',', '.') . '</div>
                    </div>
                    <div class="button-group">
                        <form method="POST" action="removerLivro.php">
                            <input type="hidden" name="idCarrinho" value="' . htmlspecialchars($carrinho['carrinho_id']) . '">
                            <button type="submit" class="remove-cart-btn">Remover do Carrinho</button>
                        </form>
                        <button class="buy-btn">Comprar</button>
                    </div>
                </div>';
            }
        } else {
            echo '<p class="text-center">Nenhum livro no carrinho no momento.</p>';
        }
        ?>
    </div>
</div>

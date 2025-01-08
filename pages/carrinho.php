<?php 

$idUsuario = $_SESSION['cod'];
?>

<div class="container">
    <div class="carrinho">
        <?php
        $carrinhos = Carrinho::listarCarrinho($idUsuario); // Obtém os livros do banco de dados
        print_r($carrinhos);
        
        if ($carrinhos && count($carrinhos) > 0) {
            foreach ($carrinhos as $carrinho) {
                echo '
                <div class="book-container">
                    <p>'.$carrinho.'</p>
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
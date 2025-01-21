<?php 

// Verifique se o usuário está logado
if (!isset($_SESSION['cod'])) {
    echo '<script>alert("Você precisa estar logado para acessar o carrinho!");</script>';
    exit;
}

$idUsuario = $_SESSION['cod'];
$totalPedido = 0; // Inicialize o total do pedido

// Verifique se a requisição de remoção foi feita
if (isset($_POST['idCarrinho'])) {
    $idCarrinho = $_POST['idCarrinho'];
    
    // Chame o método de exclusão do livro do carrinho
    if (Carrinho::removerLivroCarrinho($idCarrinho, $idUsuario)) { 
        header("Location: carrinho"); // Redireciona de volta para a página do carrinho
        exit;
    } else {
        echo '<script>alert("Erro ao remover livro do carrinho!");</script>';
    }
}

// Verifique se a requisição de finalização foi feita
if (isset($_POST['finalizarCompra'])) {
    if (Compra::finalizarCompra($idUsuario)) { // Alterado para Compra::finalizarCompra
        echo '<script>alert("Compra finalizada com sucesso!");</script>';
        header("Location: historico_compras"); // Redireciona para o histórico de compras
        exit;
    } else {
        echo '<script>alert("Erro ao finalizar compra!");</script>';
    }
}
?>

<div class="container">
    <div class="cart-title">
        <h2>Carrinho de compras</h2>
    </div>
    <div class="book-list" id="cartList">
        <?php
        // Recupera os livros no carrinho do usuário
        $carrinhos = Carrinho::listarCarrinho($idUsuario); // Alterado para Compra::listarCarrinho
        
        if ($carrinhos && count($carrinhos) > 0) {
            foreach ($carrinhos as $carrinho) {
                $totalPedido += $carrinho['preco']; // Soma o preço ao total do pedido
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
                        <form method="POST" action=""> 
                            <input type="hidden" name="idCarrinho" value="' . htmlspecialchars($carrinho['carrinho_id']) . '">
                            <button type="submit" class="remove-cart-btn">Remover do Carrinho</button>
                        </form>
                    </div>
                </div>';
            }
        } else {
            echo '<p class="text-center">Nenhum livro no carrinho no momento.</p>';
        }
        ?>
    </div>
    <?php if ($totalPedido > 0): ?>
    <div class="cart-summary">
        <div class="total-price">
            <h3>Total do Pedido: R$ <?= number_format($totalPedido, 2, ',', '.') ?></h3>
        </div>
        <form method="POST" action="">
            <button type="submit" name="finalizarCompra" class="checkout-btn">Finalizar Compra</button>
        </form>
    </div>
    <?php endif; ?>
</div>

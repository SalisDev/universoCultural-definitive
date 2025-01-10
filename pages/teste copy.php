<?php 

    // Verifica se foi clicado o botão de adicionar ou remover carrinho
    if (isset($_POST['adicionarCarrinho']) || isset($_POST['removerLivroCarrinho'])) {
        // Chama o método de adicionar ou remover carrinho dependendo do estado atual
        $status = carrinho::adicionarcarrinho($idLivro, $idUsuario);
        if ($status) {
            header("Location: " . $_SERVER['PHP_SELF']); // Redirecionar para a mesma página
        } else {
            echo '<script>alert("Erro ao adicionar/remover carrinho!");</script>';
        }
    }
?>
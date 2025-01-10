<?php
// Remover favorito se o formulário foi enviado
if (isset($_POST['idFavorito']) && isset($_SESSION['cod'])) {
    $idFavorito = $_POST['idFavorito'];
    $idUsuario = $_SESSION['cod'];

    // Verifique se o ID do favorito está sendo passado corretamente
    if (empty($idFavorito) || empty($idUsuario)) {
        echo '<script>alert("Dados inválidos para remoção!");</script>';
        exit;
    }

    // Remover o livro dos favoritos
    if (Favorito::excluirLivroFavorito($idFavorito, $idUsuario)) {
        header("Location: favoritos");
        exit;

    } else {
        echo '<script>alert("Erro ao remover favorito!");</script>';
    }
}


// Adicionar ao carrinho se o formulário foi enviado
if (isset($_POST['idLivro']) && isset($_SESSION['cod'])) {
    $idLivro = $_POST['idLivro'];
    $idUsuario = $_SESSION['cod'];

    // Exemplo de uso no formulário de adicionar ao carrinho
    if (Carrinho::adicionarCarrinho($idLivro, $idUsuario) === false) {
        echo '<script>alert("Este livro já está no seu carrinho!");</script>';
    } else {
        echo '<script>alert("Livro adicionado ao carrinho!");</script>';
    }

    header("Location: carrinho"); // Redireciona para a página do carrinho
    exit;
}

// Listar os livros favoritos do usuário
$idUsuario = $_SESSION['cod'];
$favoritos = Favorito::listarLivros($idUsuario);
?>

<div class="container">
    <div class="favorites-title">
        <h2>Meus Favoritos</h2>
    </div>
    <div class="book-list" id="favoritesList">
        <?php
        if ($favoritos && count($favoritos) > 0) {
            foreach ($favoritos as $favorito) {
                // Verificar se os dados existem antes de usar
                $nome = isset($favorito['nome']) ? htmlspecialchars($favorito['nome']) : 'Nome não disponível';
                $autor = isset($favorito['autor']) ? htmlspecialchars($favorito['autor']) : 'Autor não disponível';
                $idioma = isset($favorito['idioma']) ? htmlspecialchars($favorito['idioma']) : 'Idioma não disponível';
                $estoque = isset($favorito['estoque']) ? htmlspecialchars($favorito['estoque']) : 'Estoque não disponível';
                $preco = isset($favorito['preco']) ? number_format($favorito['preco'], 2, ',', '.') : 'Preço não disponível';
                $imagem = isset($favorito['imagem']) ? htmlspecialchars($favorito['imagem']) : 'default.jpg'; // Imagem padrão

                echo '
                <div class="book-containerList">
                    <img src="' . $imagem . '" alt="' . $nome . '" class="book-imageList">
                    <div class="book-detailsList">
                        <div class="book-title"><strong>Nome:</strong> ' . $nome . '</div>
                        <div class="book-info"><strong>Autor:</strong> ' . $autor . '</div>
                        <div class="book-info"><strong>Idioma:</strong> ' . $idioma . '</div>
                        <div class="book-info"><strong>Estoque:</strong> ' . $estoque . '</div>
                        <div class="book-price"><strong>Preço:</strong> R$ ' . $preco . '</div>
                    </div>
                    <div class="button-group">
                        <!-- Formulário para remover do favorito -->
                        <form method="POST">
                            <input type="hidden" name="idFavorito" value="' . $favorito['cod'] . '">
                            <button type="submit" class="remove-fav-btn">Remover dos Favoritos</button>
                        </form>
                        <!-- Formulário para adicionar ao carrinho -->
                        <form method="POST">
                            <input type="hidden" name="idLivro" value="' . $favorito['cod'] . '">
                            <button type="submit" class="cart-btn">Adicionar ao Carrinho</button>
                        </form>
                        <!-- Botão de compra (redirecionamento para a página de compra) -->
                        <button class="buy-btn" onclick="window.location.href=\'compra.php?idLivro=' . $favorito['cod'] . '\'">Comprar</button>
                    </div>
                </div>';
            }
        } else {
            echo '<p class="text-center">Nenhum livro nos favoritos no momento.</p>';
        }
        ?>
    </div>
</div>

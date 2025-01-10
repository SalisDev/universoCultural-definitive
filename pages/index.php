<?php
// Verificar se o formulário foi enviado para adicionar ou remover favorito ou adicionar ao carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idLivro = $_POST['idLivro'];
    $idUsuario = $_SESSION['cod'];

    // Verifica se foi clicado o botão de adicionar ou remover favorito
    if (isset($_POST['adicionarFavorito']) || isset($_POST['removerFavorito'])) {
        // Chama o método de adicionar ou remover favorito dependendo do estado atual
        $status = Favorito::adicionarFavorito($idLivro, $idUsuario);
        if ($status) {
            header("Location: " . $_SERVER['PHP_SELF']); // Redirecionar para a mesma página
        } else {
            echo '<script>alert("Erro ao adicionar/remover favorito!");</script>';
        }
    }

    // Verifica se foi clicado o botão de adicionar ao carrinho
    if (isset($_POST['adicionarCarrinho']) || isset($_POST['removerLivroCarrinho'])) {
        if (isset($_SESSION['cod'])) {
            $idUsuario = $_SESSION['cod'];
            // Verifica se o livro já está no carrinho
            if (Carrinho::adicionarCarrinho($idLivro, $idUsuario) === false) {
                echo '<script>alert("Este livro já está no seu carrinho!");</script>';
            } else {
                echo '<script>alert("Livro adicionado ao carrinho!");</script>';
            }
        }
        header("Location: " . $_SERVER['PHP_SELF']); // Redirecionar para a mesma página
        exit;
    }
}

// Carregar os livros do banco e adicionar a informação se está favoritado
$idUsuario = $_SESSION['cod'];
$livros = Livro::listarLivros($idUsuario);
?>

<!-- Front-End -->
<div id="bookCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?php echo INCLUDE_PATH; ?>public/imagens/promocao.jpeg" class="d-block w-100" alt="Promoção">
        </div>
        <div class="carousel-item">
            <img src="<?php echo INCLUDE_PATH; ?>public/imagens/destaques.jpeg" class="d-block w-100" alt="Novidades">
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

<div class="container mt-5">
    <h2 class="text-center mb-4">Livros Disponíveis</h2>
    <div class="book-list">
        <?php
        if ($livros && count($livros) > 0) {
            foreach ($livros as $livro) {
                // Verifica se o livro já foi favoritado
                $favoritoStatus = $livro['is_favorite'] ? 'Remover dos Favoritos' : 'Adicionar aos Favoritos';
                $favoritoClass = $livro['is_favorite'] ? 'favorited' : '';
                $buttonName = $livro['is_favorite'] ? 'removerFavorito' : 'adicionarFavorito';

                echo '
        <div class="book-container">
            <img src="' . htmlspecialchars($livro['imagem']) . '" alt="' . htmlspecialchars($livro['subtitulo']) . '" class="book-image">
            <div class="book-title">' . htmlspecialchars($livro['nome']) . '</div>
            <div class="book-price">R$ ' . floatval($livro['preco']) . '</div>
            <div class="book-icons">
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="idLivro" value="' . htmlspecialchars($livro['cod']) . '">
                    <button type="submit" name="' . $buttonName . '" class="icon-btn add-to-favorites ' . $favoritoClass . '" 
                            title="' . $favoritoStatus . '">
                        <i class="fas fa-heart"></i>
                    </button>
                </form>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="idLivro" value="' . htmlspecialchars($livro['cod']) . '">
                    <button type="submit" name="adicionarCarrinho" class="icon-btn remove-from-favorites" 
                            title="Adicionar ao carrinho">
                        <i class="fas fa-cart-shopping"></i>
                    </button>
                </form>
            </div>
            <button Id="buy-btn">Comprar</button> <!-- Botão de Comprar -->
            <a class="detal-link" href="detalhes.php?idLivro=' . htmlspecialchars($livro['cod']) . '"><button class="detal-btn">detalhes</button></a> 
             <!-- Botão de Detalhes -->
    </div>';
            }
            
        } else {
            echo '<p class="text-center">Nenhum livro disponível no momento.</p>';
        }
        ?>
    </div>
</div>

<style>
    .favorited {
        color: red;
    }

    a {
        color: white;
        text-decoration: none;
    }

    a :hover {
        color: white;
        text-decoration: none;
    }

</style>

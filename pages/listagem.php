<!-- Exposição dos Livros -->
<div class="container mt-5">
    <div class="exibitonTitle">
        <h2 class="text-center mb-4">Livros Disponíveis</h2>
        <h3><a href=""></a></h3>
    </div>

    <div class="book-list">
        <?php
        $idUsuario = $_SESSION['cod']; // Use o ID do usuário autenticado
        $livros = Livro::listarLivros($idUsuario);

        if ($livros && count($livros) > 0) {
            foreach ($livros as $livro) {
                echo '
                <div class="book-container">
                    <img src="' . htmlspecialchars($livro['imagem']) . '" alt="' . htmlspecialchars($livro['subtitulo']) . '" class="book-image">
                    <div class="book-title">' . htmlspecialchars($livro['nome']) . '</div>
                    <div class="book-price">R$ ' . floatval($livro['preco']) . '</div>
                    <div class="book-icons">
                        
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
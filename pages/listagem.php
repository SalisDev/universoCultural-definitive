<style>
    
</style>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluir_livro'])) {
    require_once __DIR__ . '/../classes/Livro.php'; // Caminho para a classe Livro

    $idLivro = $_POST['id_livro'] ?? null; // Captura o ID do livro do formulário
    if ($idLivro) {
        // Conectar ao banco de dados
        $pdo = MySql::conectar();

        // Passo 1: Remover as referências ao livro na tabela tbfavorito
        $sql = $pdo->prepare("DELETE FROM tbfavorito WHERE cod_livro = ?");
        $sql->execute([$idLivro]);

        // Passo 2: Remover as referências ao livro na tabela tbcarrinho
        $sql = $pdo->prepare("DELETE FROM tbcarrinho WHERE cod_livro = ?");
        $sql->execute([$idLivro]);

        // Passo 3: Excluir o livro da tabela tbLivro
        $excluido = Livro::excluirLivro($idLivro);

        if ($excluido) {
            echo "<script>alert('Livro excluído com sucesso!');</script>";
            // Redireciona para a página de livros após a exclusão
            header("Location: listagem.php");
            exit;
        } else {
            echo "<script>alert('Erro ao excluir o livro.');</script>";
        }
    } else {
        echo "<script>alert('ID do livro não foi especificado.');</script>";
    }
}
?>


<!-- Exposição dos Livros -->
<div class="container mt-5">
    <div class="exibitonTitle">
        <h2 class="text-center mb-4">Livros Disponíveis</h2>
    </div>

    <div class="book-list">
        <?php
        $idUsuario = $_SESSION['cod'] ?? null; // Pega o ID do usuário autenticado

        if ($idUsuario) {
            // Lista os livros disponíveis para o usuário
            $livros = Livro::listarLivros($idUsuario);

            if ($livros && count($livros) > 0) {
                foreach ($livros as $livro) {
                    echo '
                    <div class="book-container">
                        <img src="' . htmlspecialchars($livro['imagem']) . '" alt="' . htmlspecialchars($livro['subtitulo']) . '" class="book-image">
                        <div class="book-title">' . htmlspecialchars($livro['nome']) . '</div>
                        <div class="book-price">R$ ' . number_format(floatval($livro['preco']), 2, ',', '.') . '</div>
                        <form method="POST" action="">
                            <input type="hidden" name="id_livro" value="' . htmlspecialchars($livro['cod']) . '">
                            <button type="submit" name="excluir_livro" class="cancel-btn">Excluir</button>
                        </form>
                        <button class="detal-btn">Detalhes</button>
                    </div>';
                }
            } else {
                echo '<p class="text-center">Nenhum livro disponível no momento.</p>';
            }
        } else {
            echo '<p class="text-center">Erro: Sessão não inicializada ou usuário não autenticado.</p>';
        }
        ?>
    </div>
</div>

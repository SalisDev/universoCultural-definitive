<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dados do formulário
    $nome = $_POST['nome'];
    $autor = $_POST['autor'];
    $editora = $_POST['editora'];
    $ISBN = $_POST['ISBN'];
    $paginas = $_POST['paginas'];
    $subtitulo = $_POST['subtitulo'];
    $idioma = $_POST['idioma'];
    $genero = $_POST['genero'];
    $anoLancamento = $_POST['year'];
    $estoque = $_POST['estoque'];
    $preco = $_POST['preco'];
    $tipo_capa = $_POST['tipo_capa'];

    // Upload da imagem
    $imagem = $_FILES['imagem'];
    $uploadDir = 'uploads/capas/';
    $nomeArquivo = uniqid('capa_', true) . '.' . pathinfo($imagem['name'], PATHINFO_EXTENSION);
    $uploadFilePath = $uploadDir . $nomeArquivo;

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Verifica se o arquivo foi enviado corretamente
    if ($imagem['error'] === UPLOAD_ERR_OK) {
        if (move_uploaded_file($imagem['tmp_name'], $uploadFilePath)) {
            // Chama o método para cadastrar o livro
            $resultado = Livro::cadastrarLivro($nome, $estoque,$preco,$tipo_capa, $uploadFilePath, $autor, $editora, $ISBN, $paginas, $subtitulo, $idioma, $genero, $anoLancamento);

            if ($resultado) {
                echo "Livro cadastrado com sucesso!";
            } else {
                echo "Erro ao cadastrar o livro.";
            }
        } else {
            echo "Erro ao mover o arquivo para o diretório de upload.";
        }
    } else {
        echo "Erro no upload da imagem: " . $imagem['error'];
    }
}
?>

<!-- <main class="cadastromain"> -->
<div class="adicionar">
    <div class="container2">
        <form action="#" method="POST" class="form-cadastro" enctype="multipart/form-data">
            <h1>Cadastro de Livros</h1>

            <!-- Campos de entrada -->
            <label for="nome">Nome do livro:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="tipo_capa">Capa:</label>
            <select id="tipo_capa" name="tipo_capa" required>
                <option value="">Selecione o tipo de capa</option>
                <option value="dura">Dura</option>
                <option value="simples">Simples</option>
            </select>

            <label for="imagem">Imagem:</label>
            <input type="file" id="imagem" name="imagem" accept="image/*" required>

            <label for="autor">Autor:</label>
            <select id="autor" name="autor" required>
                <option value="">Selecione um autor</option>
                <option value="1">Clarisse Lispector</option>
            </select>

            <label for="editora">Editora:</label>
            <select id="editora" name="editora" required>
                <option value="">Selecione uma editora</option>
                <option value="1">Arqueiro</option>
            </select>

            <label for="ISBN">ISBN:</label>
            <input type="number" id="ISBN" name="ISBN" min="1000000000000" max="9999999999999" placeholder="0000000000000" title="Digite o ISBN do livro">
            <script>
                const numberInput = document.getElementById('ISBN');
                numberInput.addEventListener('input', function () {
                    const value = this.value;
                    if (value.length > 13) {
                    this.value = value.slice(0, 13);
                    }
                });
            </script>

            <label for="paginas">Quantidade de Páginas:</label>
            <input type="number" id="paginas" name="paginas" required>

            <label for="subtitulo">Subtítulo:</label>
            <input type="text" id="subtitulo" name="subtitulo">

            <label for="estoque">Estoque:</label>
            <input type="number" id=" estoque" name="estoque">

            <label for="preco">Valor do produto:</label>
            <input type="number" id="preco" name="preco" step=".01">

            <label for="idioma">Idioma:</label>
            <select id="idioma" name="idioma" required>
                <option value="">Selecione um idioma</option>
                <option value="1">Português</option>
            </select>

            <label for="genero">Gênero:</label>
            <select id="genero" name="genero" required>
                <option value="">Selecione um gênero</option>
                <option value="1">Aventura</option>
            </select>

            <label for="year">Ano de lançamento:</label>
            <input type="number" id="year" name="year" min="1000" max="2025" required>

            <button type="submit" class="btn-submit">Cadastrar</button>
        </form>

    </div>
</div>
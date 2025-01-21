<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Caminho do arquivo de log
    $logFile = 'error_log.txt';

    // Dados do formulário
    $nome = $_POST['nome'];
    $autor = $_POST['autor'];
    $editora = $_POST['editora'];
    $ISBN = $_POST['ISBN'];
    $paginas = $_POST['paginas'];
    $resumo = $_POST['resumo'];
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
        if (!mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
            error_log("Erro ao criar o diretório de upload: $uploadDir\n", 3, $logFile);
            die("Erro ao criar o diretório de upload.");
        }
    }

    // Verifica se o arquivo foi enviado corretamente
    if ($imagem['error'] === UPLOAD_ERR_OK) {
        if (move_uploaded_file($imagem['tmp_name'], $uploadFilePath)) {
            // Chama o método para cadastrar o livro
            $resultado = Livro::cadastrarLivro($nome, $estoque, $preco, $tipo_capa, $uploadFilePath, $autor, $editora, $ISBN, $paginas, $resumo, $idioma, $genero, $anoLancamento);

            if ($resultado) {
                echo "<script>alert('Livro cadastrado com sucesso!')</script>";
            } else {
                $errorMessage = "Erro ao cadastrar o livro no banco de dados";
                error_log("$errorMessage\n", 3, $logFile);
                echo "<script>alert('$errorMessage')</script>";
            }
        } else {
            $errorMessage = "Erro ao mover o arquivo para o diretório de upload: $uploadFilePath.";
            error_log("$errorMessage\n", 3, $logFile);
            echo "<script>alert('$errorMessage')</script>";
        }
    } else {
        $errorMessage = "Erro no upload da imagem. Código de erro: " . $imagem['error'];
        error_log("$errorMessage\n", 3, $logFile);
        echo "<script>alert('$errorMessage')</script>";
    }
}
?>


<!-- <main class="cadastromain"> -->
<form action="#" method="POST" class="form-cadastro" enctype="multipart/form-data">
    <h1>Cadastro de Livros</h1>

    <!-- Campos de entrada -->
    <label for="nome">Nome do livro:</label>
    <input type="text" id="nome" name="nome" required>

    <label for="tipo_capa">Capa:</label>
    <select id="tipo_capa" name="tipo_capa" required>
        <option value="">Selecione o tipo de capa</option>
        <option value="Dura">Dura</option>
        <option value="Simples">Simples</option>
    </select>

    <label for="imagem">Imagem:</label>
    <input type="file" id="imagem" name="imagem" accept="image/*" required>

    <label for="autor">Autor:</label>
    <select id="autor" name="autor" required>
        <option value="">Selecione um autor</option>
        <option value="Clarice">Clarisse Lispector</option>
    </select>

    <label for="editora">Editora:</label>
    <select id="editora" name="editora" required>
        <option value="">Selecione uma editora</option>
        <option value="Arqueiro">Arqueiro</option>
    </select>

    <label for="ISBN">ISBN:</label>
    <input type="number" id="ISBN" name="ISBN" min="1000000000000" max="9999999999999" placeholder="0000000000000"
        title="Digite o ISBN do livro">
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

    <label for="resumo">Resumo:</label>
    <input type="text" id="resumo" name="resumo">

    <label for="estoque">Estoque:</label>
    <input type="number" id=" estoque" name="estoque">

    <label for="preco">Valor do produto:</label>
    <input type="number" id="preco" name="preco" step="any">

    <label for="idioma">Idioma:</label>
    <select id="idioma" name="idioma" required>
        <option value="">Selecione um idioma</option>
        <option value="Português">Português</option>
    </select>

    <label for="genero">Gênero:</label>
    <select id="genero" name="genero" required>
        <option value="">Selecione um gênero</option>
        <option value="Aventura">Aventura</option>
    </select>

    <label for="year">Ano de lançamento:</label>
    <input type="number" id="year" name="year" min="1000" max="2025" required>

    <button type="submit" class="btn-submit">Cadastrar</button>
</form>
<?php
// Inclui o arquivo de conexão
include 'conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $nome = $conn->real_escape_string($_POST['nome']);
    $capa = $conn->real_escape_string($_POST['capa']);
    $autor = intval($_POST['autor']);
    $editora = intval($_POST['editora']);
    $isbn = $conn->real_escape_string($_POST['ISBN']);
    $paginas = intval($_POST['paginas']);
    $subtitulo = $conn->real_escape_string($_POST['subtitulo']);
    $idioma = intval($_POST['idioma']);
    $genero = intval($_POST['genero']);
    $anoLancamento = intval($_POST['year']);

    // Monta o SQL para inserir o livro no banco de dados
    $sql = "INSERT INTO tbLivro (capa, autor, editora, ISBN, paginas, subtitulo, idioma, genero, anoLancamento) 
            VALUES ('$capa', $autor, $editora, '$isbn', $paginas, '$subtitulo', $idioma, $genero, $anoLancamento)";

    // Executa a query e verifica se foi bem-sucedida
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Livro cadastrado com sucesso!'); window.location.href='adicionar.html';</script>";
    } else {
        echo "Erro ao cadastrar livro: " . $conn->error;
    }
}

// Fecha a conexão
$conn->close();
?>

<?php
include 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idioma = $_POST['idioma'];

    if (!empty($idioma)) {
        $sql = "INSERT INTO idioma (nome) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $idioma);

        if ($stmt->execute()) {
            echo "<script>alert('idioma cadastrado com sucesso!'); window.location.href = 'adicionar1.html';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar idioma: " . $conn->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('O campo Nome do idioma não pode estar vazio!');</script>";
    }

    $conn->close();
}
?>
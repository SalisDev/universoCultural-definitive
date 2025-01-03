<?php
include 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $autor = $_POST['autor'];

    if (!empty($autor)) {
        $sql = "INSERT INTO autor (nome) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $autor);

        if ($stmt->execute()) {
            echo "<script>alert('Autor cadastrado com sucesso!'); window.location.href = 'adicionar1.html';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar autor: " . $conn->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('O campo Nome do autor não pode estar vazio!');</script>";
    }

    $conn->close();
}
?>
9
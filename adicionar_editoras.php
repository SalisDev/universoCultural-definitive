<?php
include 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $editora = $_POST['editora'];

    if (!empty($editora)) {
        $sql = "INSERT INTO editora (nome) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $editora);

        if ($stmt->execute()) {
            echo "<script>alert('editora cadastrado com sucesso!'); window.location.href = 'adicionar1.html';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar editora: " . $conn->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('O campo Nome do editora não pode estar vazio!');</script>";
    }

    $conn->close();
}
?>
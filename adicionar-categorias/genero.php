<?php
include 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $genero = $_POST['genero'];

    if (!empty($genero)) {
        $sql = "INSERT INTO genero (nome) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $genero);

        if ($stmt->execute()) {
            echo "<script>alert('genero cadastrado com sucesso!'); window.location.href = 'adicionar1.html';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar genero: " . $conn->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('O campo Nome do genero não pode estar vazio!');</script>";
    }

    $conn->close();
}
?>
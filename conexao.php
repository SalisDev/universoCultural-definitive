<?php
// Configuração do banco de dados
$servername = "localhost";
$username = "root"; // Altere se necessário
$password = "1393"; // Altere se necessário
$dbname = "universo_cultural";

// Criação da conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    echo("Falha na conexão com o banco de dados: " . $conn->connect_error);
}
?>
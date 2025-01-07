<?php

// $email = $_SESSION['email'];
// $usuario = Usuario::obterUsuario($email);

$url = isset($_GET['url']) ? $_GET['url'] : 'home';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universo Cultural</title>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>/public/styles/styles.css">
    <script src="https://kit.fontawesome.com/d9dda7c4a9.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="navbar">
            <a href="<?php echo INCLUDE_PATH; ?>" class="logo"><img class="logo" src="<?php echo INCLUDE_PATH; ?>public/imagens/logo.png" alt="Universo Cultural"></a>

            
            <ul class="nav-links">
                <li><a href="<?php echo INCLUDE_PATH; ?>">Início</a></li>
                <li><a href="<?php echo INCLUDE_PATH; ?>adicionar">Cadastro</a></li>
                <li><a href="<?php echo INCLUDE_PATH; ?>listagem">Listagem</a></li>
                <li><a href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
                <!-- Ícone de Favoritos -->
                <li><a href="<?php echo INCLUDE_PATH; ?>favoritos"><i class="fas fa-heart"></i> Favoritos</a></li>
                <!-- Ícone de Carrinho -->
                <li><a href="<?php echo INCLUDE_PATH; ?>carrinho"><i class="fas fa-shopping-cart"></i> Carrinho</a></li>
            </ul>

        </div>
    </header>
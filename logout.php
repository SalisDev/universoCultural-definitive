<?php
// Inicia a sessão
session_start();

// Destroi a sessão
session_destroy();

// Redireciona o usuário para a página inicial ou de login
header("Location: /universo-cultural/");
exit();
?>

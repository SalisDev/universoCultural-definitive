<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login de Usuários</title>
    <link rel="stylesheet" href="userlog.css">
</head>

<body>
    <div class="container">
        <h1>Login de Usuário</h1>
        <form action="#" method="POST">
        <?php echo INCLUDE_PATH; ?>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Digite seu email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="footer">
                Ainda não tem uma conta? <a href="cadastro">Cire sua conta.</a>
            </div>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $_POST['email'];
                $senha = $_POST['senha'];

                if (Usuario::login($email, $senha)) {
                    if (isset($_POST['lembrar'])) {
                        setcookie('lembrar', true, time() + (60 * 60 * 24 * 30), '/');
                        setcookie('email', $email, time() + (60 * 60 * 24 * 30), '/');
                        setcookie('senha', $senha, time() + (60 * 60 * 24 * 30), '/');
                    }
                    header('Location: ' . INCLUDE_PATH);
                    exit();
                } else {
                    echo '<p class="error">Nome de usuário ou senha incorretos.</p>';
                }
            }
            ?>
        </form>


    </div>
</body>

</html>
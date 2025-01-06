<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Cadastro de Usuários</title>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>/public/styles/userlog.css">
</head>

<body>
    <div class="container">
        <h1>Cadastro de Usuário</h1>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Digite seu email" required>
            </div>
            <div class="form-group">
                <label for="cpf">Cpf</label>
                <input type="cpf" id="cpf" name="cpf" placeholder="Digite seu cpf" required>
            </div>
            <div class="form-group">
                <label for="phone">Telefone</label>
                <input type="tel" id="phone" name="phone" placeholder="Digite seu telefone" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
            </div>
            <div class="endereco">
                <div class="form-group">
                    <label for="estado">Selecione seu Estado:</label>
                    <select id="estado" name="estado">
                        <option value="">Selecione o Estado</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="cidade">Selecione sua Cidade:</label>
                    <select id="cidade" name="cidade" disabled>
                        <option value="">Selecione o Estado primeiro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="bairro">Escreva seu Bairro:</label>
                    <input id="bairro" name="bairro" type="text" placeholder="Bairro">
                </div>


                <div class="form-group">
                    <label for="rua">Escreva sua Rua:</label>
                    <input id="rua" name="rua" type="text" placeholder="Rua">
                </div>
                <div class="form-group">
                    <label for="numero">Escreva seu Numero de residencia:</label>
                    <input id="numero" name="numero" type="number" placeholder="Numero">
                </div>
                <div class="form-group">
                    <label for="cep">Escreva seu CEP:</label>
                    <input id="cep" name="cep" type="cep" placeholder="Cep">
                </div>
            </div>
            <button type="submit" class="btn">Cadastrar</button>
        </form>

        <div class="footer">
            Já tem uma conta? <a href="login">Faça login</a>
        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $estado = $_POST['estado'];
            $cidade = $_POST['cidade'];
            $numero = $_POST['numero'];
            $rua = $_POST['rua'];
            $bairro = $_POST['bairro'];
            $cep = $_POST['cep'];
            $cpf = $_POST['cpf'];
            $phone = $_POST['phone'];

            $result = Usuario::cadastrarUsuario($nome, $email, $senha, $estado, $cidade, $numero, $cep, $cpf, $phone, $rua, $bairro);

            if ($result['success']) {
                echo '<p class="success">' . $result['message'] . ' <a href="login">Faça login</a>.</p>';
            } else {
                echo '<p class="error">' . $result['message'] . '</p>';
            }
        }
        ?>
    </div>
    <script src="<?php echo INCLUDE_PATH ?>public/js/buscaEstado.js"></script>
</body>

</html>
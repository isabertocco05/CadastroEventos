<?php
session_start();
include('../config/conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acao']) && $_POST['acao'] == 'login') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($senha, $user['senha'])) {

        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_tipo'] = $user['tipo']; // admin ou user normal
        
        if ($user['tipo'] == 'admin') {
            header('Location: views/admin/painel.php');
        } else {
            header('Location: views/user/painel.php');
        }
        exit();
    } else {
        $erro = "Usuário ou senha incorretos!";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style/login.css">
</head>
<body>
    <div class="container">
        <div class="options">
            <button id="login" class="ativar" onclick="showLogin()">Login</button>
            <button id="cadastrar" onclick="showCadastrar()">Cadastrar</button>
        </div>

        <div id="loginForm">
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <input type="hidden" name="acao" value="login">
                <label for="usuario">Usuário</label>
                <input type="text" name="usuario" id="usuario" required>
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" required>
                <button type="submit">Entrar</button>
            </form>
            <?php if (isset($erro)) { echo "<p style='color: red;'>$erro</p>"; } ?>
        </div>

        <div id="cadastroForm" style="display: none;">
            <h2>Cadastrar</h2>
            <form action="login.php" method="POST">
                <input type="hidden" name="acao" value="cadastro">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
                <label for="usuario">Usuário</label>
                <input type="text" name="usuario" id="usuario" required>
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" required>
                <label for="confirmaSenha">Confirme a Senha</label>
                <input type="password" name="confirmaSenha" id="confirmaSenha" required>
                <button type="submit">Cadastrar</button>
            </form>
            <?php if (isset($erro)) { echo "<p style='color: red;'>$erro</p>"; } ?>
        </div>
    </div>

    <script>
        function showLogin() {
            document.getElementById('loginForm').style.display = 'block';
            document.getElementById('cadastroForm').style.display = 'none';
            document.getElementById('login').classList.add('ativar');
            document.getElementById('cadastrar').classList.remove('ativar');
        }

        function showCadastrar() {
            document.getElementById('loginForm').style.display = 'none';
            document.getElementById('cadastroForm').style.display = 'block';
            document.getElementById('cadastrar').classList.add('ativar');
            document.getElementById('login').classList.remove('ativar');
        }
    </script>
</body>
</html>

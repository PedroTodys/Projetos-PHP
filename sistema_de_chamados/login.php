<?php
session_start();
require_once 'config.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_tipo'] = $usuario['tipo'];
        header('Location: painel.php');
        exit;
    } else {
        $erro = "E-mail ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Help Desk</title>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">

</head>
<body>
    <div class="Login-container">
        <h2 class="login">Login</h2>
        <?php if ($erro): ?>
            <p style="color:red"><?= $erro ?></p>
         <?php endif; ?>
        <form method="post">
             <input type="email" name="email" placeholder="E-mail" required><br>
             <input type="password" name="senha" placeholder="Senha" required><br>
             <button type="submit">Entrar</button>
         </form>
    </div>
</body>
</html>

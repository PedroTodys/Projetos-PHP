<?php
session_start();
require_once('config.php');

$mensagem = "";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $password = $_POST['senha'];

    // Verifica se já existe o usuário
    $stmt = $connection->prepare("SELECT * FROM reconhecimento WHERE Name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $mensagem = "Esse nome de usuário já existe.";
    } else {
        // Criptografar a senha antes de salvar
        $senha_hash =$password;

        $stmt = $connection->prepare("INSERT INTO reconhecimento (Name, Password) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $senha_hash);
        $stmt->execute();

        $_SESSION['usuario'] = $name;
        $_SESSION['ok'] = true;
        header('Location: login.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
            color: #fff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            width: 320px;
            text-align: center;
            backdrop-filter: blur(10px);
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            margin-bottom: 16px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
            background: rgba(255,255,255,0.2);
            color: #fff;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        input[type="text"]:hover,
        input[type="password"]:hover,
        input[type="text"]:focus,
        input[type="password"]:focus {
            box-shadow: 0 0 8px rgba(255,255,255,0.4);
            background-color: rgba(255,255,255,0.25);
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #219150;
            box-shadow: 0 0 10px rgba(39,174,96,0.5);
        }

        a {
            color: #fff;
            text-decoration: underline;
        }

        .login-link {
            margin-top: 20px;
            font-size: 14px;
        }

        .erro {
            background-color: rgba(255, 0, 0, 0.15);
            color: #ffcccc;
            border: 1px solid rgba(255, 0, 0, 0.3);
            padding: 12px;
            margin-bottom: 16px;
            border-radius: 8px;
            font-size: 14px;
            animation: fadeIn 0.4s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cadastro</h1>
        <h3>Crie sua conta</h3>

        <?php if (!empty($mensagem)): ?>
            <div class="erro"><?= htmlspecialchars($mensagem) ?></div>
        <?php endif; ?>

        <form method="POST" action="cadastro.php">
            <input type="text" name="name" placeholder="Nome de usuário" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="submit" name="acao" value="Cadastrar">
        </form>

        <div class="login-link">
            <p>Já tem uma conta? <a href="login.php">Entre aqui</a></p>
        </div>
    </div>
</body>
</html>

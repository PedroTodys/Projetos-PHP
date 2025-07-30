<?php
session_start();
require_once('config.php');

$mensagem_erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeform = $_POST['name'];
    $senhaform = $_POST['senha'];

    $stmt = $connection->prepare("SELECT Name, Password FROM reconhecimento WHERE Name = ? AND Password = ? LIMIT 1");
    $stmt->bind_param("ss", $nomeform, $senhaform);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $mensagem_erro = "Usuário ou senha inválidos.";
    } else {
        $linha = $result->fetch_assoc();
        $_SESSION['usuario'] = $linha['Name'];
        $_SESSION['senha'] = $linha['Password'];
        $_SESSION['ok'] = true;
        header('Location: home.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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

        .login-container {
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
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
            box-shadow: 0 0 10px rgba(52,152,219,0.5);
        }

        a {
            color: #fff;
            text-decoration: underline;
        }

        .register {
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
        .logo {
            width: 80px;
            height: 80px;
            margin-bottom: 16px;
            filter: drop-shadow(0 0 10px rgba(52, 152, 219, 0.6));
            animation: fadeIn 0.6s ease-in-out;
        }

    </style>
</head>
<body>
    <div class="login-container">
      <img src="logodaempresa.png" alt="Logo da empresa" class="logo">
        <h1>Entrar</h1>
        <h3>Conectar-se com sua conta</h3>

        <?php if (!empty($mensagem_erro)): ?>
            <div class="erro"><?= htmlspecialchars($mensagem_erro) ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <input type="text" name="name" placeholder="Nome de usuário" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="submit" name="enviar" value="Entrar">
        </form>

        <div class="register">
            <p>Não tem uma conta? <a href="cadastro.php">Registre-se aqui</a></p>
        </div>
    </div>
</body>
</html>

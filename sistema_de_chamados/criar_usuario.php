<?php
session_start();
require_once 'config.php';

// Verifica se está logado e se é admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $tipo = $_POST['tipo'] ?? 'cliente';

    // Verifica se o e-mail já existe
    $verifica = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
    $verifica->execute([$email]);

    if ($verifica->rowCount() > 0) {
        $mensagem = "Esse e-mail já está cadastrado.";
    } else {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $senhaHash, $tipo]);
        $mensagem = "Usuário criado com sucesso!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Criar Usuário</title>
</head>
<body>
    <h2>Criar Novo Usuário</h2>
    <p><a href="painel.php">← Voltar ao painel</a></p>

    <?php if ($mensagem): ?>
        <p><?= $mensagem ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="nome" placeholder="Nome" required><br>
        <input type="email" name="email" placeholder="E-mail" required><br>
        <input type="password" name="senha" placeholder="Senha" required><br>
        <select name="tipo">
            <option value="cliente">Cliente</option>
            <option value="admin">Admin</option>
        </select><br><br>
        <button type="submit">Criar Usuário</button>
    </form>
</body>
</html>

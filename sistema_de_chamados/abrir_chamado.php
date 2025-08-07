<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $usuario_id = $_SESSION['usuario_id'];

    if ($titulo && $descricao) {
        $stmt = $pdo->prepare("INSERT INTO chamados (usuario_id, titulo, descricao) VALUES (?, ?, ?)");
        $stmt->execute([$usuario_id, $titulo, $descricao]);
        $mensagem = "Chamado aberto com sucesso!";
    } else {
        $mensagem = "Preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Abrir Chamado</title></head>

<body>
    <h2>Abrir Chamado</h2>
    <p><a href="painel.php">← Voltar</a></p>

    <?php if ($mensagem): ?>
        <p><?= $mensagem ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="titulo" placeholder="Título" required><br><br>
        <textarea name="descricao" placeholder="Descreva o problema..." rows="6" cols="40" required></textarea><br><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>

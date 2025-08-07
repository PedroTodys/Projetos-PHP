<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$usuario_nome = $_SESSION['usuario_nome'];
$usuario_tipo = $_SESSION['usuario_tipo'];

if ($usuario_tipo === 'admin') {
    $stmt = $pdo->query("SELECT chamados.*, usuarios.nome AS autor FROM chamados JOIN usuarios ON chamados.usuario_id = usuarios.id ORDER BY chamados.criado_em DESC");
} else {
    $stmt = $pdo->prepare("SELECT * FROM chamados WHERE usuario_id = ? ORDER BY criado_em DESC");
    $stmt->execute([$usuario_id]);
}

$chamados = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Painel - Help Desk</title>
</head>
<body>
    <h2>Bem-vindo, <?= htmlspecialchars($usuario_nome) ?>!</h2>

    <p><a href="abrir_chamado.php">➕ Abrir Novo Chamado</a> | 
    <?php if ($usuario_tipo === 'admin'): ?>
        <a href="criar_usuario.php">👤 Criar Usuário</a> | 
    <?php endif; ?>
    <a href="logout.php">Sair</a></p>

    <h3>Seus Chamados</h3>
    <?php if (empty($chamados)): ?>
        <p>Nenhum chamado encontrado.</p>
    <?php else: ?>
        <table border="1" cellpadding="5">
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Status</th>
                <th>Data</th>
                <?php if ($usuario_tipo === 'admin'): ?>
                    <th>Usuário</th>
                <?php endif; ?>
                <th>Ação</th>
            </tr>
            <?php foreach ($chamados as $chamado): ?>
                <tr>
                    <td><?= $chamado['id'] ?></td>
                    <td><?= htmlspecialchars($chamado['titulo']) ?></td>
                    <td><?= $chamado['status'] ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($chamado['criado_em'])) ?></td>
                    <?php if ($usuario_tipo === 'admin'): ?>
                        <td><?= htmlspecialchars($chamado['autor']) ?></td>
                    <?php endif; ?>
                    <td><a href="ver_chamado.php?id=<?= $chamado['id'] ?>">Ver</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>

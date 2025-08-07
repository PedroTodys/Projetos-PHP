<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$chamado_id = $_GET['id'] ?? null;

if (!$chamado_id) {
    header('Location: painel.php');
    exit;
}

// Pega o chamado
$stmt = $pdo->prepare("SELECT chamados.*, usuarios.nome AS autor FROM chamados JOIN usuarios ON chamados.usuario_id = usuarios.id WHERE chamados.id = ?");
$stmt->execute([$chamado_id]);
$chamado = $stmt->fetch();

if (!$chamado) {
    echo "Chamado não encontrado.";
    exit;
}

// Verifica permissão
if ($_SESSION['usuario_tipo'] !== 'admin' && $chamado['usuario_id'] != $_SESSION['usuario_id']) {
    echo "Acesso negado.";
    exit;
}

// Pega respostas
$stmtRespostas = $pdo->prepare("SELECT r.*, u.nome FROM respostas_chamado r JOIN usuarios u ON r.usuario_id = u.id WHERE r.chamado_id = ? ORDER BY r.criado_em ASC");
$stmtRespostas->execute([$chamado_id]);
$respostas = $stmtRespostas->fetchAll();
?>

<!DOCTYPE html>
<html>
<head><title>Chamado #<?= $chamado['id'] ?></title></head>
<body>
    <h2>Chamado #<?= $chamado['id'] ?> - <?= htmlspecialchars($chamado['titulo']) ?></h2>
    <p><a href="painel.php">← Voltar</a></p>

    <p><strong>Status:</strong> <?= $chamado['status'] ?></p>
    <p><strong>Autor:</strong> <?= htmlspecialchars($chamado['autor']) ?></p>
    <p><strong>Descrição:</strong><br><?= nl2br(htmlspecialchars($chamado['descricao'])) ?></p>
    <p><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($chamado['criado_em'])) ?></p>

    <hr>
    <h3>Respostas</h3>
    <?php if ($respostas): ?>
        <?php foreach ($respostas as $r): ?>
            <p><strong><?= htmlspecialchars($r['nome']) ?>:</strong><br>
            <?= nl2br(htmlspecialchars($r['mensagem'])) ?><br>
            <small><em><?= date('d/m/Y H:i', strtotime($r['criado_em'])) ?></em></small></p>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhuma resposta ainda.</p>
        <hr>
    <?php endif; ?>

    <h3>Responder</h3>
    <form method="post" action="responder_chamado.php">
        <input type="hidden" name="chamado_id" value="<?= $chamado_id ?>">
        <textarea name="mensagem" rows="5" cols="50" required></textarea><br><br>
        <button type="submit">Responder</button>
    </form>

    <br>
    <?php if ($_SESSION['usuario_tipo'] === 'admin'): ?>
        <form method="post" action="responder_chamado.php">
            <input type="hidden" name="chamado_id" value="<?= $chamado_id ?>">
            <label for="status">Alterar status:</label>
            <select name="status">
                <option value="aberto" <?= $chamado['status'] === 'aberto' ? 'selected' : '' ?>>Aberto</option>
                <option value="em andamento" <?= $chamado['status'] === 'em andamento' ? 'selected' : '' ?>>Em andamento</option>
                <option value="resolvido" <?= $chamado['status'] === 'resolvido' ? 'selected' : '' ?>>Resolvido</option>
            </select>
            <button type="submit">Atualizar</button>
        </form>
    <?php endif; ?>
</body>
</html>

<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$chamado_id = $_POST['chamado_id'] ?? null;
$mensagem = $_POST['mensagem'] ?? '';
$status = $_POST['status'] ?? null;

if ($chamado_id && $mensagem) {
    $stmt = $pdo->prepare("INSERT INTO respostas_chamado (chamado_id, usuario_id, mensagem) VALUES (?, ?, ?)");
    $stmt->execute([$chamado_id, $usuario_id, $mensagem]);
}

// Atualiza status se for admin e status foi enviado
if ($_SESSION['usuario_tipo'] === 'admin' && $chamado_id && $status) {
    $stmt = $pdo->prepare("UPDATE chamados SET status = ? WHERE id = ?");
    $stmt->execute([$status, $chamado_id]);
}

header("Location: ver_chamado.php?id=$chamado_id");
exit;

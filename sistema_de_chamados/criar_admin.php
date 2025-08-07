<?php
require_once 'config.php';

$nome = 'Admin';
$email = 'admin@helpdesk.com';
$senha = 'admin123';
$tipo = 'admin';

// Gera hash da senha
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)");
$stmt->execute([$nome, $email, $senhaHash, $tipo]);

echo "Usuário admin criado com sucesso!";
?>

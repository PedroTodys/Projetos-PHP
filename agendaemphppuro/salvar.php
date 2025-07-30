<?php
require 'config.php';

$nome = $_POST['nome'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$email = $_POST['email'] ?? '';

// Proteção básica contra SQL injection
$nome = $connection->real_escape_string($nome);
$telefone = $connection->real_escape_string($telefone);
$email = $connection->real_escape_string($email);

if ($nome && $telefone && $email) {
    $sql = "INSERT INTO contatos (nome, telefone, email) VALUES ('$nome', '$telefone', '$email')";
    if ($connection->query($sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Erro ao salvar: " . $connection->error;
    }
} else {
    echo "Todos os campos são obrigatórios.";
}
?>

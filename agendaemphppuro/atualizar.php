<?php
require 'config.php';

$id = intval($_POST['id']);
$nome = $_POST['nome'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$email = $_POST['email'] ?? '';

// Proteção básica
$nome = $connection->real_escape_string($nome);
$telefone = $connection->real_escape_string($telefone);
$email = $connection->real_escape_string($email);

if ($id && $nome && $telefone && $email) {
    $sql = "UPDATE contatos SET nome = '$nome', telefone = '$telefone', email = '$email' WHERE id = $id";
    if ($connection->query($sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Erro ao atualizar: " . $connection->error;
    }
} else {
    echo "Todos os campos são obrigatórios.";
}
?>

<?php
require 'config.php';

$id = $_GET['id'] ?? 0;
$id = intval($id);

if ($id) {
    $sql = "DELETE FROM contatos WHERE id = $id";
    if ($connection->query($sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Erro ao excluir: " . $connection->error;
    }
} else {
    echo "ID inválido.";
}
?>

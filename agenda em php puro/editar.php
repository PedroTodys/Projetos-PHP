<?php
require 'config.php';

$id = $_GET['id'] ?? 0;
$id = intval($id);

$result = $connection->query("SELECT * FROM contatos WHERE id = $id");

if ($result->num_rows === 0) {
    echo "Contato não encontrado.";
    exit;
}

$contato = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Contato</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f2f2; padding: 20px; }
        h1 { color: #333; }
        form { background: #fff; padding: 20px; border-radius: 5px; width: 400px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        label { display: block; margin-top: 10px; }
        input { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; }
        button { margin-top: 15px; padding: 10px 20px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        a { display: inline-block; margin-top: 15px; color: #555; text-decoration: none; }
    </style>
</head>
<body>
    <h1>✏️ Editar Contato</h1>

    <form action="atualizar.php" method="post">
        <input type="hidden" name="id" value="<?= $contato['id'] ?>">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($contato['nome']) ?>" required>

        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" value="<?= htmlspecialchars($contato['telefone']) ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($contato['email']) ?>" required>

        <button type="submit">Salvar Alterações</button>
    </form>

    <a href="index.php">← Voltar para a lista</a>
</body>
</html>

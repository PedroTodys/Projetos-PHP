<?php
require 'config.php';

// Busca os contatos no banco
$result = $connection->query("SELECT * FROM contatos ORDER BY criado_em DESC");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Agenda de Contatos</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f2f2; padding: 20px; }
        h1 { color: #333; }
        table { width: 100%; background: #fff; border-collapse: collapse; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        a { text-decoration: none; color: blue; margin-right: 10px; }
        .add { display: inline-block; margin-bottom: 15px; background: #28a745; color: white; padding: 10px; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>📇 Agenda de Contatos</h1>
    <a class="add" href="adicionar.php">➕ Adicionar Contato</a>
    <table>
        <tr>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Email</th>
            <th>Criado em</th>
            <th>Ações</th>
        </tr>

        <?php while ($contato = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($contato['nome']) ?></td>
                <td><?= htmlspecialchars($contato['telefone']) ?></td>
                <td><?= htmlspecialchars($contato['email']) ?></td>
                <td><?= date('d/m/Y H:i', strtotime($contato['criado_em'])) ?></td>
                <td>
                    <a href="editar.php?id=<?= $contato['id'] ?>">✏️ Editar</a>
                    <a href="excluir.php?id=<?= $contato['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este contato?')">🗑️ Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

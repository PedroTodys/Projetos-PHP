<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Contato</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f2f2; padding: 20px; }
        h1 { color: #333; }
        form { background: #fff; padding: 20px; border-radius: 5px; width: 400px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        label { display: block; margin-top: 10px; }
        input { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; }
        button { margin-top: 15px; padding: 10px 20px; background: #28a745; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        a { display: inline-block; margin-top: 15px; color: #555; text-decoration: none; }
    </style>
</head>
<body>
    <h1>➕ Novo Novo Contato</h1>

    <form action="salvar.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>

        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <button type="submit">Salvar</button>
    </form>

    <a href="index.php">← Voltar para a lista</a>
</body>
</html>

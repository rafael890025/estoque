<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];

    $stmt = $pdo->prepare("INSERT INTO produtos (nome, descricao, quantidade, preco) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $descricao, $quantidade, $preco]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Produto</title>
</head>
<body>
    <h1>Adicionar Novo Produto</h1>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao"></textarea><br>

        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" required><br>

        <label for="preco">Preço:</label>
        <input type="text" name="preco" required><br>

        <button type="submit">Adicionar Produto</button>
    </form>
</body>
</html>

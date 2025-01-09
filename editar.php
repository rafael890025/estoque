<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];

    $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, descricao = ?, quantidade = ?, preco = ? WHERE id = ?");
    $stmt->execute([$nome, $descricao, $quantidade, $preco, $id]);

    header('Location: index.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
</head>
<body>
    <h1>Editar Produto</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?php echo $produto['nome']; ?>" required><br>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao"><?php echo $produto['descricao']; ?></textarea><br>

        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" value="<?php echo $produto['quantidade']; ?>" required><br>

        <label for="preco">Preço:</label>
        <input type="text" name="preco" value="<?php echo $produto['preco']; ?>" required><br>

        <button type="submit">Atualizar Produto</button>
    </form>
</body>
</html>

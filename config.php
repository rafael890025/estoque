<?php
$host = 'localhost';
$dbname = 'estoque';
$username = 'root'; // ou outro nome de usuário
$password = ''; // senha, caso tenha configurado uma

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>

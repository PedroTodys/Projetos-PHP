<?php
$host = 'localhost';
$db = 'helpdesk'; // substitua pelo nome real
$user = 'root';        // ou o seu usuário
$pass = '@Yuzaki0709';            // ou sua senha

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco: " . $e->getMessage());
}

<?php
$host = 'localhost';
$dbname = 'agenda_php';
$user = 'root';
$pass = '@Yuzaki0709';

$connection = new mysqli($host, $user, $pass, $dbname);

if ($connection->connect_error) {
    die('Erro ao conectar ao banco de dados: ' . $connection->connect_error);
}
?>
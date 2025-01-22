<?php
// Configuração do banco de dados
$host = 'localhost';
$dbname = 'teste_revvo';
$user = 'root';
$password = 'Mm@#91284025';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

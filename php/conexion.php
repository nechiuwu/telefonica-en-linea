<?php
$servername = "localhost";
$username = "root";
$password = "Mycr8760ne14.";
$dbname = "telefonica_en_linea";
$port = 3306;

try {
    $pdo = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Conexión fallida: ' . $e->getMessage();
}

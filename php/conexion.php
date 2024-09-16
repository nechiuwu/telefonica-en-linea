<?php
$servername = "localhost";
$username = "root";
$password = "Mycr8760ne14.";
$dbname = "telefonica_en_linea";
$port = 3336;

$mysqli = new mysqli($servername, $username, $password, $dbname, $port);

if ($mysqli->connect_error) {
    die('Error de conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$mysqli->close();

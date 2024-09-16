<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre_usuario = :usuario");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();
    $usuarioDb = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuarioDb && password_verify($contrasena, $usuarioDb['contrasena'])) {
        $_SESSION['usuario_id'] = $usuarioDb['id'];
        $_SESSION['rol'] = $usuarioDb['rol'];
        header("Location: ../views/perfil.php");
    } else {
        echo "Credenciales incorrectas.";
    }
}

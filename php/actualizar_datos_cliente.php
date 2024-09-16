<?php
include 'conexion.php';
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'cliente') {
    header("Location: ../views/perfil.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_SESSION['usuario_id'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $tipo_plan = $_POST['tipo_plan'];

    if (empty($nombre) || empty($email) || empty($tipo_plan)) {
        die("Los campos 'Nombre', 'Correo electrónico' y 'Tipo de Plan' son obligatorios.");
    }

    try {
        $stmt = $pdo->prepare("UPDATE clientes SET nombre = :nombre, direccion = :direccion, email = :email, telefono = :telefono, tipo_plan = :tipo_plan WHERE id_usuario = :id_usuario");
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':tipo_plan', $tipo_plan);
        $stmt->execute();

        header("Location: ../views/perfil.php");
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

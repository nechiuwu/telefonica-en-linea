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
        $stmt = $mysqli->prepare("UPDATE clientes SET nombre = :nombre, direccion = :direccion, email = :email, telefono = :telefono, tipo_plan = :tipo_plan WHERE id_usuario = :id_usuario");
        $stmt->bind_param(':id_usuario', $id_usuario);
        $stmt->bind_param(':nombre', $nombre);
        $stmt->bind_param(':direccion', $direccion);
        $stmt->bind_param(':email', $email);
        $stmt->bind_param(':telefono', $telefono);
        $stmt->bind_param(':tipo_plan', $tipo_plan);
        $stmt->execute();

        $stmt->close();
        $mysqli->close();
        header("Location: ../views/perfil.php");
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

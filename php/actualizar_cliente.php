<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $rut = $_POST['rut'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $tipo_plan = $_POST['tipo_plan'];

    try {
        $stmt = $mysqli->prepare("UPDATE clientes SET rut = :rut, nombre = :nombre, direccion = :direccion, email = :email, telefono = :telefono, tipo_plan = :tipo_plan WHERE id = :id");
        $stmt->bind_param(':id', $id);
        $stmt->bind_param(':rut', $rut);
        $stmt->bind_param(':nombre', $nombre);
        $stmt->bind_param(':direccion', $direccion);
        $stmt->bind_param(':email', $email);
        $stmt->bind_param(':telefono', $telefono);
        $stmt->bind_param(':tipo_plan', $tipo_plan);
        $stmt->execute();

        $stmt->close();
        $mysqli->close();
        header("Location: ../views/gestionar_clientes.php");
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

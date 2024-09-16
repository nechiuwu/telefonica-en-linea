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
        $stmt = $pdo->prepare("UPDATE clientes SET rut = :rut, nombre = :nombre, direccion = :direccion, email = :email, telefono = :telefono, tipo_plan = :tipo_plan WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':rut', $rut);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':tipo_plan', $tipo_plan);
        $stmt->execute();

        header("Location: ../views/gestionar_clientes.php");
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

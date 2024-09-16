<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $rut = $_POST['rut'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $contrasena = $_POST['contrasena'];
    $rol = $_POST['rol'];

    if (empty($usuario) || empty($rut) || empty($direccion) || empty($telefono) || empty($contrasena) || empty($rol)) {
        die("Todos los campos son obligatorios.");
    }

    $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre_usuario, contrasena, rol, estatus) VALUES (:nombre_usuario, :contrasena, :rol, 'activo')");
        $stmt->bindParam(':nombre_usuario', $usuario);
        $stmt->bindParam(':contrasena', $hashed_password);
        $stmt->bindParam(':rol', $rol);
        $stmt->execute();

        $usuario_id = $pdo->lastInsertId();

        if ($rol === 'cliente') {
            $stmt = $pdo->prepare("INSERT INTO clientes (id_usuario, rut, nombre, direccion, email, telefono, tipo_plan) VALUES (:id_usuario, :rut, :nombre_usuario, :direccion, :email, :telefono, 'normal')");
            $stmt->bindParam(':id_usuario', $usuario_id);
            $stmt->bindParam(':rut', $rut);
            $stmt->bindParam(':nombre_usuario', $nombre);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->execute();
        }

        echo "Registro exitoso. <a href='../views/login.php'>Volver al login</a>";
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

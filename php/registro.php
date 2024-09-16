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
        $us = $mysqli->prepare("INSERT INTO usuarios (nombre_usuario, contrasena, rol, estatus) VALUES (:nombre_usuario, :contrasena, :rol, 'activo')");
        $us->bind_param(':nombre_usuario', $usuario);
        $us->bind_param(':contrasena', $hashed_password);
        $us->bind_param(':rol', $rol);
        $us->execute();

        $usuario_id = $mysqli->insert_id;

        if ($rol === 'cliente') {
            $cl = $mysqli->prepare("INSERT INTO clientes (id_usuario, rut, nombre, direccion, email, telefono, tipo_plan) VALUES (:id_usuario, :rut, :nombre_usuario, :direccion, :email, :telefono, 'normal')");
            $cl->bind_param(':id_usuario', $usuario_id);
            $cl->bind_param(':rut', $rut);
            $cl->bind_param(':nombre_usuario', $nombre);
            $cl->bind_param(':direccion', $direccion);
            $cl->bind_param(':email', $email);
            $cl->bind_param(':telefono', $telefono);
            $cl->execute();
        }

        echo "Registro exitoso. <a href='../views/login.php'>Volver al login</a>";
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

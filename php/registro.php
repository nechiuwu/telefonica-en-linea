<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['email'];
    $nombre_usuario = $_POST['name'];
    $contrasena = $_POST['password'];
    $rol = $_POST['rol'];

    $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO usuarios (correo_electronico, nombre_usuario, contrasena, rol, estatus) VALUES (:correo, :nombre_usuario, :contrasena, :rol, 'activo')");
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->bindParam(':contrasena', $hashed_password);
        $stmt->bindParam(':rol', $rol);
        $stmt->execute();
        
        echo "Registro exitoso. <a href='../views/index.php'>Volver al login</a>";
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>

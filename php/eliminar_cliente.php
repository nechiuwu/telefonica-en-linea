<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM clientes WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: ../views/gestionar_clientes.php");
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

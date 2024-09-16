<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    try {
        $cl = $pdo->prepare("DELETE FROM clientes WHERE id = :id");
        $cl->bindParam(':id', $id);
        $cl->execute();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    try {
        $us = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $us->bindParam(':id', $cliente['id_usuario']);
        $us->execute();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
    header("Location: ../views/gestionar_clientes.php");
}

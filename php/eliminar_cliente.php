<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $mysqli->prepare("SELECT * FROM clientes WHERE id = :id");
        $stmt->bind_param(':id', $id);
        $stmt->execute();
        $cliente = $stmt->get_result();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    try {
        $cl = $mysqli->prepare("DELETE FROM clientes WHERE id = :id");
        $cl->bind_param(':id', $id);
        $cl->execute();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    try {
        $us = $mysqli->prepare("DELETE FROM usuarios WHERE id = :id");
        $us->bind_param(':id', $cliente['id_usuario']);
        $us->execute();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
    $stmt-> close();
    $mysqli->close();
    header("Location: ../views/gestionar_clientes.php");
}

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li> <a href="../php/logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>
    <div class="container label-form input-form">
        <?php
        include '../php/conexion.php';

        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <form action="../php/actualizar_cliente.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">

            <label for="rut">RUT</label>
            <input type="text" id="rut" name="rut" value="<?php echo $cliente['rut']; ?>" required>

            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $cliente['nombre']; ?>" required>

            <label for="direccion">Dirección</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo $cliente['direccion']; ?>">

            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" value="<?php echo $cliente['email']; ?>">

            <label for="telefono">Teléfono</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo $cliente['telefono']; ?>">

            <label for="tipo_plan">Tipo de Plan</label>
            <select id="tipo_plan" name="tipo_plan" required>
                <option value="normal" <?php echo ($cliente['tipo_plan'] == 'normal') ? 'selected' : ''; ?>>Normal</option>
                <option value="bueno" <?php echo ($cliente['tipo_plan'] == 'bueno') ? 'selected' : ''; ?>>Bueno</option>
                <option value="excelente" <?php echo ($cliente['tipo_plan'] == 'excelente') ? 'selected' : ''; ?>>Excelente</option>
                <option value="oferta temporada" <?php echo ($cliente['tipo_plan'] == 'oferta temporada') ? 'selected' : ''; ?>>Oferta de Temporada</option>
            </select>

            <button type="submit">Actualizar</button>
        </form>
        <a href="gestionar_clientes.php">Volver a la gestión de clientes</a>
    </div>
</body>

</html>
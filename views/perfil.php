<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - En Linea</title>
    <link rel="stylesheet" href="../styles/index.css">
</head>

<body>
    <div class="container">
        <?php
        session_start();
        include '../php/conexion.php';

        if (!isset($_SESSION['usuario_id'])) {
            header("Location: ../views/login.php");
            exit();
        }

        $usuario_id = $_SESSION['usuario_id'];
        $rol = $_SESSION['rol'];

        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->bindParam(':id', $usuario_id);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare("SELECT * FROM clientes WHERE id_usuario = :id_usuario");
        $stmt->bindParam(':id_usuario', $usuario_id);
        $stmt->execute();
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>

        <h1>Perfil de Usuario</h1>
        <p>Correo Electrónico: <?php echo $usuario['correo_electronico']; ?></p>
        <p>Nombre de Usuario: <?php echo $usuario['nombre_usuario']; ?></p>
        <p>Rol: <?php echo ucfirst($usuario['rol']); ?></p>

        <?php if ($rol === 'cliente'): ?>
            <h2>Mis Datos</h2>
            <form action="../php/actualizar_datos_cliente.php" method="POST">
                <input type="hidden" name="id_usuario" value="<?php echo $usuario_id; ?>">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $cliente['nombre']; ?>" required>

                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo $cliente['direccion']; ?>">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $cliente['email']; ?>">

                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="<?php echo $cliente['telefono']; ?>">

                <label for="tipo_plan">Tipo de Plan:</label>
                <select id="tipo_plan" name="tipo_plan" required>
                    <option value="normal" <?php echo ($cliente['tipo_plan'] == 'normal') ? 'selected' : ''; ?>>Normal</option>
                    <option value="bueno" <?php echo ($cliente['tipo_plan'] == 'bueno') ? 'selected' : ''; ?>>Bueno</option>
                    <option value="excelente" <?php echo ($cliente['tipo_plan'] == 'excelente') ? 'selected' : ''; ?>>Excelente</option>
                    <option value="oferta temporada" <?php echo ($cliente['tipo_plan'] == 'oferta temporada') ? 'selected' : ''; ?>>Oferta de Temporada</option>
                </select>

                <button type="submit">Actualizar Datos</button>
            </form>
        <?php endif; ?>

        <a href="../views/gestionar_clientes.php">Ir a gestionar clientes</a>
        <a href="../php/logout.php">Cerrar sesión</a>
    </div>
</body>

</html>
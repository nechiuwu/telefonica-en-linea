<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes - En linea</title>
    <link rel="stylesheet" href="../styles/index.css">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: ../views/login.php");
        exit();
    }
    if ($_SESSION['rol'] !== 'agente'): ?>
        header("Location: ../views/perfil.php");
    <?php endif; ?>
    <header>
        <nav>
            <ul>
                <li><a href="../php/logout.php">Cerrar sesión</a></li>
                <li><a href="../views/perfil.php">Volver al perfil</a></li>
            </ul>
        </nav>
    </header>

    <h1>Gestión de Clientes</h1>
    <table>
        <thead>
            <tr>
                <th>RUT</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Tipo de Plan</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../php/conexion.php';

            $stmt = $pdo->query("SELECT * FROM clientes");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>{$row['rut']}</td>
                        <td>{$row['nombre']}</td>
                        <td>{$row['direccion']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['telefono']}</td>
                        <td>{$row['tipo_plan']}</td>
                        <td>
                            <a href='editar.php?id={$row['id']}'>Editar</a>
                            <a href='../php/eliminar_cliente.php?id={$row['id']}'>Eliminar</a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>
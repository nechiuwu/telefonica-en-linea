<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - En linea</title>
    <link rel="stylesheet" href="../styles/index.css">
</head>

<body>
    <div class="container">
        <form action="../php/registro.php" method="POST">
            <label for="correo">Correo electrónico</label>
            <input type="email" id="correo" name="correo" required>

            <label for="nombre_usuario">Nombre de Usuario</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" minlength="8" required>

            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <label for="rol">Rol</label>
            <select id="rol" name="rol" required>
                <option value="cliente">Cliente</option>
                <option value="agente">Agente</option>
            </select>

            <button type="submit">Registrar</button>
        </form>
    </div>
</body>

</html>
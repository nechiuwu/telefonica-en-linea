<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>En Linea - Valparaiso</title>
    <link rel="stylesheet" href="../styles/index.css">
</head>

<body>
    <div class="container">
        <form action="../php/login.php" method="POST">
            <label for="correo">Correo electrónico</label>
            <input type="email" id="correo" name="correo" required>
            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>
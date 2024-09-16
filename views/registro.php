<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - En linea</title>
    <link rel="stylesheet" href="../styles/index.css">
</head>

<body>
    <script>
        function validarUsuario() {
            var usuario = document.getElementById("usuario").value;
            var errorMsg = "";
            if (usuario.length < 8) {
                errorMsg += "El usuario debe tener al menos 8 caracteres.\n";
            }
            if (!/[A-Z]/.test(usuario)) {
                errorMsg += "El usuario debe contener al menos una letra mayúscula.\n";
            }
            var simbolosEspeciales = /[\(\)\$\%\"!\/&\"=]/;
            if (!simbolosEspeciales.test(usuario)) {
                errorMsg += 'El usuario debe contener al menos un símbolo especial: ( ) $ % " ! / & " =';
            }
            if (errorMsg) {
                alert(errorMsg);
                return false;
            }
            return true;
        }
    </script>
    <header>
        <nav>
            <ul>
                <li> <a href="../views/login.php">Iniciar sesión</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <form onsubmit="return validarUsuario()" action="../php/registro.php" method="POST">
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="usuario" minlength="8" required title="Email o nombre usuario">

            <label for="rut">RUT</label>
            <input type="text" id="rut" name="rut" minlength="9" maxlength="12" required>

            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="direccion">Dirección</label>
            <input type="text" id="direccion" name="direccion" required>

            <label for="telefono">Teléfono</label>
            <input type="text" id="telefono" name="telefono" minlength="9" required>

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
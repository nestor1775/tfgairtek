

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>
<body>

    <h2>Iniciar sesión</h2>

    <!-- Mostrar error si las credenciales son incorrectas -->
    <?php if (isset($error)): ?>
        <div style="color: red;">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <!-- Formulario de login -->
    <form action="index.php?action=login" method="POST">
        <div>
            <label for="name">Nombre</label>
            <input type="text" name="name" required>
        </div>

        <div>
            <label for="password">Contraseña</label>
            <input type="password" name="password" required>
        </div>

        <div>
            <button type="submit">Iniciar sesión</button>
        </div>
    </form>

</body>
</html>

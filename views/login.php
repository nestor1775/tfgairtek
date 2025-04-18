

<?php
// Incluir el header
    include_once __DIR__ . '/templates/header.php';
?>

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

    <?php
// Incluir el footer    
    include_once __DIR__ . '/templates/footer.php';
?>  
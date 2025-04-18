



<?php
require_once __DIR__ . '/../models/user.php'; 
$user = new User();
$admins = $user->getAll();

// Incluir el header
include_once __DIR__ . '/templates/header.php';

?>

<form action="index.php?action=createProject" method="POST">
    <label for="nombre">Nombre del Proyecto:</label>
    <input type="text" id="nombre" name="nombre" required><br>

    <label for="id_administrador">ID del Administrador:</label>
    <select id="id_administrador" name="id_administrador" required>
        <option value="" disabled selected>Selecciona un Administrador</option>
        <?php
        // Iterar sobre los administradores y crear una opción para cada uno
        foreach ($admins as $admin) {
            echo "<option value=\"" . $admin['id'] . "\">" . $admin['nombre_usuario'] . "</option>";
        }
        ?>
    </select><br>

    <button type="submit">Crear Proyecto</button>
</form>

<?php
// Incluir el footer
include_once __DIR__ . '/templates/footer.php';

?>

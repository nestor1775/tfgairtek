<?php
require_once('models/user.php'); 
$user = new User();
$admins = $user->getAll(); 
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

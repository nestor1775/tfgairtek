<?php
require_once __DIR__ . '/../controllers/parteController.php';
require_once __DIR__ . '/../controllers/workerController.php';
$controller = new ParteController();
$workerController = new WorkerController();
$proyecto= $controller->mostrarPartePorToken();
$workers= $workerController->getWorkers();
// Incluir el header
include_once __DIR__ . '/templates/header.php';
?>

    <form action="done.php" method="POST">
    

    <label for="id_trabajador">Nombre del trabajador</label>
    <select id="id_trabajador" name="id_trabajador" required>
        <option value="" disabled selected>Selecciona un trabajador</option>
        <?php
        // Iterar sobre los administradores y crear una opción para cada uno
        foreach ($workers as $worker) {
            echo "<option value=\"" . $worker['id'] . "\">". $worker['nombre']." ". $worker['apellido'] . "</option>";
        }
        ?>
    </select><br>

    <label for="projectName">Nombre del proyecto asociado</label>
    <input type="text" id="projectName" value="<?php echo $proyecto["nombre"] ?>" required readonly><br>
    <input type="hidden" name="id_proyecto" value="<?= $proyecto['id'] ?>">

    <label for="parteDate">fecha del parte</label>
    <input type="date" id="parteDate" name="parteDate" required ><br>

    <label for="hours">horas</label>
    <input type="number" id="hours" name="hours" required ><br>

    <label for="extraHours">horas extras</label>
    <select id="extraHours" name="extraHours" required>
        <option value="1" selected>si</option>
        <option value="0">no</option>
        
    </select><br>

    <label for="festiveDay">dia festivo</label>
    <select id="festiveDay" name="festiveDay" required>
        <option value="1" selected>si</option>
        <option value="0">no</option>
        
    </select><br>

    <label for="observations">observaciones</label>
    <input type="text" id="observations" name="observations" ><br>


    <label for="firmaCliente">Firma responsable (empresa origen)</label>
    <div style="border: 1px solid #ccc; padding: 10px; max-width: 500px;">
        <canvas id="firmaCliente" style="width: 100%; height: 200px; border: 1px solid #000;"></canvas>
        <button type="button" onclick="borrarFirma('firmaCliente')" style="margin-top: 5px;">Borrar Firma</button>
    </div>
    <input type="hidden" name="firma_base64_cliente" id="firma_base64_cliente" required ><br>

    <label for="firmaAirtek">Firma responsable (air tek system)</label>
    <div style="border: 1px solid #ccc; padding: 10px; max-width: 500px;">
        <canvas id="firmaAirtek" style="width: 100%; height: 200px; border: 1px solid #000;"></canvas>
        <button type="button" onclick="borrarFirma('firmaAirtek')" style="margin-top: 5px;">Borrar Firma</button>
    </div>
    <input type="hidden" name="firma_base64_airtek" id="firma_base64_airtek" required >


    <button type="submit">Crear Parte</button>
</form>




<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="../js/signature.js"></script>

<?php
// Incluir el footer
include_once __DIR__ . '/templates/footer.php';
?>


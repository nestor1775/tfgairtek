<?php
require_once __DIR__ . '/../controllers/parteController.php';
require_once __DIR__ . '/../controllers/workerController.php';
$controller = new ParteController();
$workerController = new WorkerController();
$proyecto= $controller->mostrarPartePorToken();
$workers= $workerController->getWorkers();
print_r($proyecto)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

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
        <option value="0" selected>no</option>
        
    </select><br>

    <label for="festiveDay">dia festivo</label>
    <select id="festiveDay" name="festiveDay" required>
        <option value="1" selected>si</option>
        <option value="0" selected>no</option>
        
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
<script>
    // Crear las variables para los SignaturePad de cada canvas
    const canvasCliente = document.getElementById("firmaCliente");
    const signaturePadCliente = new SignaturePad(canvasCliente);

    const canvasAirtek = document.getElementById("firmaAirtek");
    const signaturePadAirtek = new SignaturePad(canvasAirtek);

    // Función para ajustar el tamaño de cada canvas y asegurar que las firmas se dibujen bien
    function resizeCanvas(signaturePad, canvas) {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        
        const width = canvas.offsetWidth;
        const height = canvas.offsetHeight;

        canvas.width = width * ratio;
        canvas.height = height * ratio;

        canvas.style.width = width + "px";
        canvas.style.height = height + "px";

        canvas.getContext("2d").scale(ratio, ratio);

        signaturePad.clear(); // Limpiar la firma si cambia el tamaño
    }

    // Ajustar el tamaño de los canvas cuando se redimensiona la ventana
    window.addEventListener("resize", function() {
        resizeCanvas(signaturePadCliente, canvasCliente);
        resizeCanvas(signaturePadAirtek, canvasAirtek);
    });

    // Inicializar los canvas para que se ajusten al tamaño correcto desde el principio
    resizeCanvas(signaturePadCliente, canvasCliente);
    resizeCanvas(signaturePadAirtek, canvasAirtek);

    // Función para borrar la firma
    function borrarFirma(canvasId) {
        if (canvasId === 'firmaCliente') {
            signaturePadCliente.clear();
        } else if (canvasId === 'firmaAirtek') {
            signaturePadAirtek.clear();
        }
    }

    // Función para capturar las firmas y guardarlas como base64 en los inputs ocultos
    document.querySelector("form").addEventListener("submit", function(e) {
        if (!signaturePadCliente.isEmpty()) {
            const firmaClienteBase64 = signaturePadCliente.toDataURL();
            document.getElementById("firma_base64_cliente").value = firmaClienteBase64;
        } else {
            alert("Por favor firma el campo de la empresa origen antes de enviar.");
            e.preventDefault();
        }

        if (!signaturePadAirtek.isEmpty()) {
            const firmaAirtekBase64 = signaturePadAirtek.toDataURL();
            document.getElementById("firma_base64_airtek").value = firmaAirtekBase64;
        } else {
            alert("Por favor firma el campo de Air Tek antes de enviar.");
            e.preventDefault();
        }
    });
</script>



</body>
</html>
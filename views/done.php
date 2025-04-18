<?php
require_once __DIR__ . '/../controllers/parteController.php';

// Configuración para la plantilla base
$pageTitle = "Parte Creado";
$basePath = "../";
$additionalCss = '';
$additionalScripts = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_proyecto = $_POST["id_proyecto"]; // Asegúrate de incluir esto en el form si no lo tienes
    $id_trabajador = $_POST["id_trabajador"];
    $fecha = $_POST["parteDate"];
    $horas_trabajadas = $_POST["hours"];
    $horas_extra = $_POST["extraHours"];
    $dia_festivo = $_POST["festiveDay"];
    $observaciones = $_POST["observations"];
    $firma_empresa = $_POST["firma_base64_cliente"];
    $firma_airtek = $_POST["firma_base64_airtek"];

    $controller = new ParteController();
    $resultado = $controller->createNewParte(
        $id_proyecto,
        $id_trabajador,
        $fecha,
        $horas_trabajadas,
        $horas_extra,
        $dia_festivo,
        $observaciones,
        $firma_empresa,
        $firma_airtek
    ); 
}

// Incluir el header
include_once __DIR__ . '/templates/header.php';
?>

<!-- Contenido específico de la página -->
<div class="bg-white rounded-lg shadow-md p-6 max-w-md mx-auto">
    <?php 
    if (isset($resultado) && $resultado){
        echo '<div class="text-center">
                <div class="mb-4 text-green-500">
                    <i class="fas fa-check-circle text-5xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-green-600 mb-4">¡Parte insertado correctamente!</h1>
                <p class="text-gray-600 mb-6">El parte de trabajo ha sido registrado en el sistema.</p>
                <a href="../index.php" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded transition duration-300">
                    <i class="fas fa-home mr-1"></i> Volver al inicio
                </a>
              </div>';
    } else {
        echo '<div class="text-center">
                <div class="mb-4 text-red-500">
                    <i class="fas fa-exclamation-circle text-5xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-red-600 mb-4">Error al insertar el parte</h1>
                <p class="text-gray-600 mb-6">Ha ocurrido un error al registrar el parte de trabajo.</p>
                <a href="../index.php" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded transition duration-300">
                    <i class="fas fa-home mr-1"></i> Volver al inicio
                </a>
              </div>';
    }
    ?>
</div>

<?php
// Incluir el footer
include_once __DIR__ . '/templates/footer.php';
?>
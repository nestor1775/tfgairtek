<?php
require_once __DIR__ . '/../controllers/parteController.php';

echo $_POST["parteDate"] ;

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
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<h1></h1>
<body>
    <?php 
    if ($resultado){
        echo "<h1>correctamente insertado</h1>";
    }
    
    ?>
</body>
</html>
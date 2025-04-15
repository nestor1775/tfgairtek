<?php
    // Configuración de la base de datos
    $host = 'tfgnestor-tfgnestor.b.aivencloud.com'; 
    $usuario = 'avnadmin'; 
    $contraseña = 'AVNS_pswaLQtnE_N0OXKFhU2'; 
    $base_de_datos = 'AppPartesTrabajo';
    $puerto = 19768;

    $conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos, $puerto);
    
?>

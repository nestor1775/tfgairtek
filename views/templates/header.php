<?php
// Obtener la ruta base para los enlaces
$basePath = isset($basePath) ? $basePath : '../';
?>
<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - Air Tek System' : 'Air Tek System'; ?></title>
    <link href="<?php echo $basePath; ?>css/output.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="<?php echo $basePath; ?>img/favicon.ico" type="image/x-icon">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Scripts adicionales específicos de la página -->
    <?php if (isset($additionalCss)) echo $additionalCss; ?>
</head>
<body class="min-h-screen bg-base-100">
    <!-- Header -->
    <header class="navbar bg-base-100 shadow-md">
        <!-- <h1>aqui hare el menu</h1> -->
    </header>

    <!-- Contenedor principal -->
    <main class="container mx-auto p-4">
        <!-- El contenido específico de cada página irá aquí -->

</html> 
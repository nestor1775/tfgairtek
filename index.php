<?php
session_start();

// controladores
require_once('controllers/AuthController.php');
require_once('controllers/projectController.php');
require_once('controllers/parteController.php');


$action = $_GET['action'] ?? null;

if ($action === null) {
    if (isset($_SESSION['usuario'])) {
        header('Location: index.php?action=dashboard');
        exit;
    } else {
        $action = 'loginForm';
    }
}

$authController = new AuthController();
$projectController = new ProjectController();

// Verificar la acción y procesarla
switch ($action) {
    case 'loginForm':
        // Mostrar formulario de login
        $authController->loginForm();
        break;
        
    case 'login':
        // Procesar el login
        $authController->login();
        break;
        
    case 'logout':
        // Procesar el logout
        $authController->logout();
        break;
        
    case 'dashboard':
        // Verificar si el usuario está logueado antes de permitir el acceso al dashboard
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?action=loginForm");
            exit(); // Detener la ejecución del script
        }
        // Si está logueado, mostrar el dashboard
        include('views/dashboard.php');
        break;

    case 'createProject':
        $projectController->create(); // Mostrar formulario
        break;

    case 'newProject':
        $projectController->newProjectForm();        // Proesar datos del formulario
        break;


        
    default:
        echo "Acción no válida";  // Mostrar mensaje si la acción no existe
        break;
}

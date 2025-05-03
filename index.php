<?php
session_start();

// controladores
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/ProjectController.php';
require_once __DIR__ . '/controllers/ParteController.php';
require_once __DIR__ . '/controllers/WorkerController.php';
$authController = new AuthController();
$projectController = new ProjectController();
$parteController = new ParteController();
$workerController = new WorkerController();


$action = $_GET['action'] ?? null;
if ($action === null) {
    if (isset($_SESSION['usuario'])) {
        header('Location: index.php?action=dashboard');
        exit;
    } else {
        $action = 'loginForm';
    }
}

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
            exit();    // Detener la ejecución del script
        }
        // Obtener los proyectos usando el controlador
        $proyectos = $projectController->getAll();
        $proyectosActivos = $projectController->getActive();
        $proyectosInactivos = $projectController->getNotActive();
        // Si está logueado, mostrar el dashboard

        if ($_SESSION['usuario']['rol']==0){
            include __DIR__ . '/views/dashboard.php';
            break;
        }elseif ($_SESSION['usuario']['rol']==1){
            include __DIR__ . '/views/dashboardV2.php';
            break;
        }
        

    case 'createProject':
        $projectController->create(); // Mostrar formulario
        break;

    case 'newProject':
        $projectController->newProjectForm();        // Proesar datos del formulario
        break;

    case 'viewActiveProjects':
        // Obtener los proyectos activos
        $proyectosActivos = $projectController->getActive();
        // Incluir la vista de proyectos activos
        include __DIR__ . '/views/activeProjects.php';
        break;

    case 'viewFinishedProjects':
        // Obtener los proyectos activos
        $proyectosInactivos = $projectController->getNotActive();
        // Incluir la vista de proyectos activos
        include __DIR__ . '/views/finishedProjects.php';
        break;

    case 'viewProject':
        // Obtener el proyecto activo
        $proyecto = $projectController->getById($_GET['id']);
        $partes = $parteController->getPartesByProjectId($_GET['id']);
        // Incluir la vista de proyecto activo
        include __DIR__ . '/views/viewProject.php';
        break;

    case 'getAllPartes':
        // Devolver todas las partes en JSON para las gráficas
        header('Content-Type: application/json');
        $parteController->getAllPartes();
        break;

    case 'getCountByMonth':
        // Devolver conteo de partes por mes en JSON para las gráficas
        header('Content-Type: application/json');
        $parteController->getCountByMonth();
        break;

    case 'offProject':
        $projectController->offProject($_POST['id_proyecto']);
        header('Location: index.php?action=viewActiveProjects');
        break;

    case 'onProject':
        $projectController->onProject($_POST['id_proyecto']);
        header('Location: index.php?action=viewActiveProjects');
        break;


    default:
        echo "Acción no válida";  // Mostrar mensaje si la acción no existe
        break;
}

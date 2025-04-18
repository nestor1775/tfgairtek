<?php
require_once __DIR__ . '/../models/project.php';

if (!class_exists('ProjectController')) {
    class ProjectController {

        public function newProjectForm() {
            include __DIR__ . '/../views/createProject.php';  
        }

        public function create() {
            if (isset($_POST['nombre']) && isset($_POST['id_administrador'])) {
                $nombre = $_POST['nombre'];
                $id_administrador = $_POST['id_administrador'];

                if (!empty($nombre) && !empty($id_administrador)) {

                    $projectModel = new Project();
                    $projectModel->newProject($nombre, $id_administrador);
                    header("Location: index.php?action=dashboard"); 
                    
            } else {
                    echo "Por favor, completa todos los campos del formulario.";
                }
            } else {
                echo "algo paso";
            }
        }
    }
}

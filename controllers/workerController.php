<?php
require_once __DIR__ . '/../models/worker.php';

if (!class_exists('WorkerController')) {
    class WorkerController {

        public function mostrarPartePorToken() {

            if (!isset($_GET['token'])) {
                die("Token no proporcionado.");
            }

            $token = $_GET['token'];
            $parteModel = new Parte();
            $proyecto = $parteModel->getByToken($token);

            if (!$proyecto) {
                die("Proyecto no encontrado.");
            }

            return $proyecto;
        }

        public function getWorkers() {
            $workerModel = new  Worker();
            return $workerModel->getAll();
        }
    }
}
?>

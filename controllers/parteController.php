<?php
require_once __DIR__ . '/../models/parte.php';

if (!class_exists('ParteController')) {
    class ParteController {
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

        public function createNewParte($id_proyecto,$id_trabajador,$fecha,$horas_trabajadas,$horas_extra,$dia_festivo,$observaciones,$firma_responsable_empresaorigen,$firma_responsable_airtek) {

            $parteModel = new Parte();
            $newparte= $parteModel->newParte($id_proyecto,$id_trabajador,$fecha,$horas_trabajadas,$horas_extra,$dia_festivo,$observaciones,$firma_responsable_empresaorigen,$firma_responsable_airtek);

            return $newparte;
        }
    }
}
?>

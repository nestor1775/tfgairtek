<?php
require_once __DIR__ . '/../config/database.php';

class Parte {
    private $db;

    public function __construct() {
        global $conexion; 
        $this->db = $conexion;
    }

    // Buscar parteporid
    public function findByid($id) {
        $stmt = $this->db->prepare("SELECT * FROM partes WHERE id = ?");
        $stmt->bind_param("i", $id); // 's' es para string
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Devuelve un array asociativo o false
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM partes");
        $stmt->execute();
        $result = $stmt->get_result();
    
        $partes = [];
        while ($row = $result->fetch_assoc()) {
            $partes[] = $row;
        }
    
        return $partes;
    }

    public function getbyToken($token) {
        $link = 'http://localhost:5000/views/parte.php?token=' . $token;

        $stmt = $this->db->prepare("SELECT * FROM Proyectos WHERE link_parte = ?");
        $stmt->bind_param("s", $link);
        $stmt->execute();
        $proyecto = $stmt->get_result()->fetch_assoc();

        return $proyecto;
    }

    public function newParte($id_proyecto,$id_trabajador,$fecha,$horas_trabajadas,$horas_extra,$dia_festivo,$observaciones,$firma_responsable_empresaorigen,$firma_responsable_airtek) {
        
        $stmt = $this->db->prepare("INSERT INTO Partes (id_proyecto, id_trabajador, fecha, horas_trabajadas, horas_extra, dia_festivo, observaciones, firma_responsable_empresaorigen, firma_responsable_airtek) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Enlazar los parámetros con el tipo de datos correspondiente:
        // 'i' para enteros, 's' para cadenas, 'd' para fechas, 'b' para binarios
        $stmt->bind_param(
            "iisisssss", // Definir el tipo de los parámetros: entero (i), cadena (s), entero (i), cadena (s), etc.
            $id_proyecto,
            $id_trabajador,
            $fecha,
            $horas_trabajadas,
            $horas_extra,
            $dia_festivo,
            $observaciones,
            $firma_responsable_empresaorigen,
            $firma_responsable_airtek
        );

        // Ejecutar la consulta SQL
        $stmt->execute();

        // Comprobar si la inserción fue exitosa
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false; // Hubo un problema con la inserción
        }

    }


}

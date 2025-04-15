<?php
require_once __DIR__ . '/../config/database.php';


class Worker {
    private $db;

    public function __construct() {
        global $conexion; 
        $this->db = $conexion;
    }

    // Buscar usuario por nombre de usuario
    public function findByname($username) {
        $stmt = $this->db->prepare("SELECT * FROM Administradores WHERE nombre_usuario = ?");
        $stmt->bind_param("s", $username); // 's' es para string
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Devuelve un array asociativo o false
    }

    // Validar usuario y contraseña
    

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM Trabajadores");
        $stmt->execute();
        $result = $stmt->get_result();
    
        $trabajadores = [];
        while ($row = $result->fetch_assoc()) {
            $trabajadores[] = $row;
        }
    
        return $trabajadores;
    }
    
}

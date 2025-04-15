<?php
require_once __DIR__ . '/../config/database.php';


class project {
    private $db;

    public function __construct() {
        global $conexion; 
        $this->db = $conexion;
    }

    // Buscar usuario por nombre de usuario
    public function findByprojectname($projectname) {
        $stmt = $this->db->prepare("SELECT * FROM proyectos WHERE nombre = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    

    public function newProject($nombre,$id_admin) {
        // Generar enlace único (puede ser UUID o una cadena aleatoria)
        $token = bin2hex(random_bytes(16)); // genera 32 caracteres hexadecimales
        $link_parte = "http://localhost:5000/views/parte.php?token=" . $token;

        $stmt = $this->db->prepare("INSERT INTO Proyectos (nombre, link_parte,id_administrador) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $nombre, $link_parte,$id_admin); // "s" para string
    
        if ($stmt->execute()) {
            echo "ok";
        } else {
            echo "Error al crear el proyecto: " . $stmt->error;
        }
    
        $stmt->close();
    }
    
}

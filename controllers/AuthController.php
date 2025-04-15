<?php
require_once('models/user.php');
session_start();

class AuthController {

    public function loginForm() {
        include('views/login.php');
    }

    public function login() {
        $username = $_POST['name'];
        $password = $_POST['password'];

        $usuarioModel = new User();
        $usuario = $usuarioModel->validate($username, $password);

        if ($usuario) {
            $_SESSION['usuario'] = $usuario;
            header("Location: index.php?action=dashboard");
        } else {
            $error = "Credenciales incorrectas";
            include('views/login.php');
        }
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?action=loginForm");
    }
}
?>

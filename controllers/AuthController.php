<?php
require_once __DIR__ . '/../models/Auth.php';

class AuthController {
    private $model;
    
    public function __construct() {
        $this->model = new Auth();
    }
    
    // Mostrar formulario de login
    public function showLogin() {
        // Si ya está autenticado, redirigir al dashboard
        if ($this->model->isAuthenticated()) {
            header('Location: index.php?page=dashboard');
            exit;
        }
        
        require_once __DIR__ . '/../views/auth/login.php';
    }
    
    // Procesar login
    public function processLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $resultado = $this->model->login($email, $password);
            
            if ($resultado['success']) {
                header('Location: index.php?page=dashboard');
                exit;
            } else {
                $_SESSION['mensaje'] = $resultado['message'];
                $_SESSION['tipo_mensaje'] = 'error';
                header('Location: index.php?page=login');
                exit;
            }
        }
    }
    
    // Cerrar sesión
    public function logout() {
        $this->model->logout();
        header('Location: index.php?page=login');
        exit;
    }
    
    // Dashboard principal
    public function dashboard() {
        // Verificar autenticación
        if (!$this->model->isAuthenticated()) {
            header('Location: index.php?page=login');
            exit;
        }
        
        $user = $this->model->getCurrentUser();
        require_once __DIR__ . '/../views/dashboard.php';
    }
}
?>
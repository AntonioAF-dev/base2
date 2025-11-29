<?php
require_once __DIR__ . '/../models/Auth.php';

class Middleware {
    private $auth;
    
    public function __construct() {
        $this->auth = new Auth();
    }
    
    // Verificar que esté autenticado
    public function requireAuth() {
        if (!$this->auth->isAuthenticated()) {
            header('Location: index.php?page=login');
            exit;
        }
    }
    
    // Verificar rol específico
    public function requireRole($roles) {
        $this->requireAuth();
        
        if (!$this->auth->hasRole($roles)) {
            $_SESSION['mensaje'] = 'No tienes permisos para acceder a esta sección';
            $_SESSION['tipo_mensaje'] = 'error';
            header('Location: index.php?page=dashboard');
            exit;
        }
    }
    
    // Redirigir si ya está autenticado
    public function redirectIfAuthenticated() {
        if ($this->auth->isAuthenticated()) {
            header('Location: index.php?page=dashboard');
            exit;
        }
    }
}
?>

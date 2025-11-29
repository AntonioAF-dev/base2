<?php
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Auth.php';

class UsuarioController {
    private $model;
    private $auth;
    
    public function __construct() {
        $this->model = new Usuario();
        $this->auth = new Auth();
        
        // Verificar autenticación
        if (!$this->auth->isAuthenticated()) {
            header('Location: index.php?page=login');
            exit;
        }
        
        // Solo admin puede gestionar usuarios
        if (!$this->auth->hasRole('Administrador')) {
            $_SESSION['mensaje'] = 'No tienes permisos para acceder a esta sección';
            $_SESSION['tipo_mensaje'] = 'error';
            header('Location: index.php?page=dashboard');
            exit;
        }
    }
    
    // Listar usuarios
    public function index() {
        $resultado = $this->model->obtenerTodos();
        $usuarios = $resultado['success'] ? $resultado['data'] : [];
        
        require_once __DIR__ . '/../views/usuarios/index.php';
    }
    
    // Crear usuario
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'nombre' => $_POST['nombre'] ?? '',
                'apellido' => $_POST['apellido'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? '',
                'rol' => $_POST['rol'] ?? 'Estudiante'
            ];
            
            $resultado = $this->model->crear($datos);
            
            if ($resultado['success']) {
                $this->setMensaje('Usuario creado exitosamente', 'success');
                header('Location: index.php?page=usuarios');
                exit;
            } else {
                $this->setMensaje($resultado['message'], 'error');
            }
        }
        
        require_once __DIR__ . '/../views/usuarios/crear.php';
    }
    
    // Editar usuario
    public function editar() {
        $id = $_GET['id'] ?? 0;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'nombre' => $_POST['nombre'] ?? '',
                'apellido' => $_POST['apellido'] ?? '',
                'email' => $_POST['email'] ?? '',
                'rol' => $_POST['rol'] ?? 'Estudiante'
            ];
            
            $resultado = $this->model->actualizar($id, $datos);
            
            if ($resultado['success']) {
                $this->setMensaje('Usuario actualizado exitosamente', 'success');
                header('Location: index.php?page=usuarios');
                exit;
            } else {
                $this->setMensaje($resultado['message'], 'error');
            }
        }
        
        // Obtener datos del usuario
        $resultado = $this->model->obtenerPorId($id);
        $usuario = $resultado['success'] ? $resultado['data'] : null;
        
        if (!$usuario) {
            $this->setMensaje('Usuario no encontrado', 'error');
            header('Location: index.php?page=usuarios');
            exit;
        }
        
        require_once __DIR__ . '/../views/usuarios/editar.php';
    }
    
    // Cambiar contraseña
    public function cambiarPassword() {
        $id = $_GET['id'] ?? 0;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newPassword = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            
            if ($newPassword !== $confirmPassword) {
                $this->setMensaje('Las contraseñas no coinciden', 'error');
            } else {
                $resultado = $this->model->cambiarPassword($id, $newPassword);
                
                if ($resultado['success']) {
                    $this->setMensaje('Contraseña actualizada exitosamente', 'success');
                    header('Location: index.php?page=usuarios');
                    exit;
                } else {
                    $this->setMensaje($resultado['message'], 'error');
                }
            }
        }
        
        require_once __DIR__ . '/../views/usuarios/cambiar_password.php';
    }
    
    // Eliminar usuario
    public function eliminar() {
        $id = $_GET['id'] ?? 0;
        
        $resultado = $this->model->eliminar($id);
        
        if ($resultado['success']) {
            $this->setMensaje('Usuario desactivado exitosamente', 'success');
        } else {
            $this->setMensaje($resultado['message'], 'error');
        }
        
        header('Location: index.php?page=usuarios');
        exit;
    }
    
    private function setMensaje($mensaje, $tipo) {
        $_SESSION['mensaje'] = $mensaje;
        $_SESSION['tipo_mensaje'] = $tipo;
    }
}
?>

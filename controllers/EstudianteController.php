<?php
require_once __DIR__ . '/../models/Estudiante.php';

class EstudianteController {
    private $model;
    
    public function __construct() {
        $this->model = new Estudiante();
    }
    
    // Listar todos los estudiantes
    public function index() {
        $resultado = $this->model->obtenerTodos();
        $estudiantes = $resultado['success'] ? $resultado['data'] : [];
        
        require_once __DIR__ . '/../views/estudiantes/index.php';
    }
    
    // Crear nuevo estudiante
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'nombre' => $_POST['nombre'] ?? '',
                'apellido' => $_POST['apellido'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? '',
                'bio' => $_POST['bio'] ?? ''
            ];
            
            // Validaciones básicas
            if (empty($datos['nombre']) || empty($datos['apellido']) || empty($datos['email']) || empty($datos['password'])) {
                $this->setMensaje('Todos los campos son obligatorios', 'error');
            } else {
                $resultado = $this->model->insertar($datos);
                
                if ($resultado['success']) {
                    $this->setMensaje('Estudiante registrado exitosamente', 'success');
                    header('Location: index.php?page=estudiantes');
                    exit;
                } else {
                    $this->setMensaje($resultado['message'], 'error');
                }
            }
        }
        
        require_once __DIR__ . '/../views/estudiantes/crear.php';
    }
    
    private function setMensaje($mensaje, $tipo) {
        $_SESSION['mensaje'] = $mensaje;
        $_SESSION['tipo_mensaje'] = $tipo;
    }
}
?>

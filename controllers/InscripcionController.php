<?php
require_once __DIR__ . '/../models/Inscripcion.php';
require_once __DIR__ . '/../models/Auth.php';

class InscripcionController {
    private $model;
    private $auth;
    
    public function __construct() {
        $this->model = new Inscripcion();
        $this->auth = new Auth();
        
        // Verificar autenticación
        if (!$this->auth->isAuthenticated()) {
            header('Location: index.php?page=login');
            exit;
        }
    }
    
    // Listar todas las inscripciones (Admin y Profesor)
    public function index() {
        $userRole = $_SESSION['user_role'] ?? '';
        
        // Si es estudiante, redirigir a sus inscripciones
        if ($userRole === 'Estudiante') {
            header('Location: index.php?page=inscripciones&action=mis-inscripciones');
            exit;
        }
        
        $resultado = $this->model->obtenerTodas();
        $inscripciones = $resultado['success'] ? $resultado['data'] : [];
        
        require_once __DIR__ . '/../views/inscripciones/index.php';
    }
    
    // Ver solo MIS inscripciones (Estudiante)
    public function misInscripciones() {
        $idUsuario = $_SESSION['user_id'] ?? 0;
        
        $resultado = $this->model->obtenerPorUsuario($idUsuario);
        $inscripciones = $resultado['success'] ? $resultado['data'] : [];
        
        require_once __DIR__ . '/../views/inscripciones/mis_inscripciones.php';
    }
    
    // Inscribirse en un curso (Estudiante)
    public function inscribirse() {
        $idUsuario = $_SESSION['user_id'] ?? 0;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idCurso = $_POST['id_curso'] ?? 0;
            
            $resultado = $this->model->inscribirse($idUsuario, $idCurso);
            
            if ($resultado['success']) {
                $this->setMensaje('¡Inscripción exitosa! Tu inscripción está pendiente de aprobación.', 'success');
                header('Location: index.php?page=inscripciones&action=mis-inscripciones');
                exit;
            } else {
                $this->setMensaje($resultado['message'], 'error');
            }
        }
        
        // Si hay error, regresar a cursos
        header('Location: index.php?page=cursos');
        exit;
    }
    
    // Actualizar estado de inscripción (Admin/Profesor)
    public function actualizar() {
        // Verificar permisos
        if (!$this->auth->hasRole(['Administrador', 'Profesor'])) {
            $this->setMensaje('No tienes permisos para esta acción', 'error');
            header('Location: index.php?page=dashboard');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idIns = $_POST['id_ins'] ?? 0;
            $estado = $_POST['estado'] ?? '';
            
            $resultado = $this->model->actualizarEstado($idIns, $estado);
            
            if ($resultado['success']) {
                $this->setMensaje('Inscripción actualizada exitosamente', 'success');
                header('Location: index.php?page=inscripciones');
                exit;
            } else {
                $this->setMensaje($resultado['message'], 'error');
            }
        }
        
        require_once __DIR__ . '/../views/inscripciones/actualizar.php';
    }
    
    // Buscar inscripciones por fechas
    public function buscar() {
        $inscripciones = [];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fechaInicio = $_POST['fecha_inicio'] ?? '';
            $fechaFin = $_POST['fecha_fin'] ?? '';
            
            $resultado = $this->model->buscarPorFechas($fechaInicio, $fechaFin);
            $inscripciones = $resultado['success'] ? $resultado['data'] : [];
        }
        
        require_once __DIR__ . '/../views/inscripciones/buscar.php';
    }
    
    // Obtener mensaje de estado (AJAX)
    public function obtenerMensajeEstado() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $estado = $_POST['estado'] ?? '';
            $resultado = $this->model->obtenerMensajeEstado($estado);
            
            echo json_encode($resultado);
            exit;
        }
    }
    
    private function setMensaje($mensaje, $tipo) {
        $_SESSION['mensaje'] = $mensaje;
        $_SESSION['tipo_mensaje'] = $tipo;
    }
}
?>
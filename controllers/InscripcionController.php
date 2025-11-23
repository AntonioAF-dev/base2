<?php
require_once __DIR__ . '/../models/Inscripcion.php';

class InscripcionController {
    private $model;
    
    public function __construct() {
        $this->model = new Inscripcion();
    }
    
    // Listar todas las inscripciones
    public function index() {
        $resultado = $this->model->obtenerTodas();
        $inscripciones = $resultado['success'] ? $resultado['data'] : [];
        
        require_once __DIR__ . '/../views/inscripciones/index.php';
    }
    
    // Actualizar estado de inscripción
    public function actualizar() {
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
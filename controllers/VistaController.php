<?php
require_once __DIR__ . '/../models/Vista.php';

class VistaController {
    private $model;
    
    public function __construct() {
        $this->model = new Vista();
    }
    
    // Mostrar página de vistas
    public function index() {
        $vistas = $this->model->obtenerVistas();
        $datosVista = null;
        
        // Si se seleccionó una vista, consultarla
        if (isset($_POST['vista'])) {
            $nombreVista = $_POST['vista'];
            $limite = $_POST['limite'] ?? 100;
            
            $resultado = $this->model->consultar($nombreVista, $limite);
            
            if ($resultado['success']) {
                $datosVista = $resultado;
            } else {
                $this->setMensaje($resultado['message'], 'error');
            }
        }
        
        require_once __DIR__ . '/../views/vistas/index.php';
    }
    
    // Consultar vista (AJAX)
    public function consultar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombreVista = $_POST['vista'] ?? '';
            $limite = $_POST['limite'] ?? 100;
            
            $resultado = $this->model->consultar($nombreVista, $limite);
            
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

<?php
require_once __DIR__ . '/../models/Pago.php';

class PagoController {
    private $model;
    
    public function __construct() {
        $this->model = new Pago();
    }
    
    // Listar todos los pagos
    public function index() {
        $resultado = $this->model->obtenerTodos();
        $pagos = $resultado['success'] ? $resultado['data'] : [];
        
        require_once __DIR__ . '/../views/pagos/index.php';
    }
    
    // Cancelar pago
    public function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idPago = $_POST['id_pago'] ?? 0;
            
            $resultado = $this->model->cancelar($idPago);
            
            if ($resultado['success']) {
                $this->setMensaje('Pago cancelado exitosamente', 'success');
                header('Location: index.php?page=pagos');
                exit;
            } else {
                $this->setMensaje($resultado['message'], 'error');
            }
        }
        
        require_once __DIR__ . '/../views/pagos/eliminar.php';
    }
    
    // Buscar pagos con filtros
    public function buscar() {
        $pagos = [];
        $totalPagos = 0;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $metodo = $_POST['metodo'] ?? '';
            $estado = $_POST['estado'] ?? '';
            
            $resultado = $this->model->buscar($metodo, $estado);
            
            if ($resultado['success']) {
                $pagos = $resultado['data'];
                foreach ($pagos as $pago) {
                    $totalPagos += $pago['MontoPag'];
                }
            }
        }
        
        require_once __DIR__ . '/../views/pagos/buscar.php';
    }
    
    // Calcular descuento (AJAX)
    public function calcularDescuento() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $monto = $_POST['monto'] ?? 0;
            $metodo = $_POST['metodo'] ?? '';
            
            $resultado = $this->model->calcularDescuento($monto, $metodo);
            
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
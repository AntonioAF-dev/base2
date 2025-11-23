<?php
require_once __DIR__ . '/../models/Nota.php';

class NotaController {
    private $model;
    
    public function __construct() {
        $this->model = new Nota();
    }
    
    // Listar todas las notas
    public function index() {
        $resultado = $this->model->obtenerTodas();
        $notas = $resultado['success'] ? $resultado['data'] : [];
        
        require_once __DIR__ . '/../views/notas/index.php';
    }
    
    // Buscar notas con filtros
    public function buscar() {
        $notas = [];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idCurso = $_POST['id_curso'] ?? 0;
            $califMin = $_POST['calif_min'] ?? 0;
            
            $resultado = $this->model->buscar($idCurso, $califMin);
            $notas = $resultado['success'] ? $resultado['data'] : [];
        }
        
        require_once __DIR__ . '/../views/notas/buscar.php';
    }
}
?>
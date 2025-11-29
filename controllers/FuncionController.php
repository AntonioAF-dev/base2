<?php
require_once __DIR__ . '/../models/Inscripcion.php';
require_once __DIR__ . '/../models/Nota.php';
require_once __DIR__ . '/../models/Curso.php';
require_once __DIR__ . '/../models/Pago.php';

class FuncionController {
    
    // Página principal de funciones
    public function index() {
        require_once __DIR__ . '/../views/funciones/index.php';
    }
    
    // Función 1: Mensaje de estado de inscripción
    public function mensajeEstado() {
        $resultado = null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $estado = $_POST['estado'] ?? '';
            $model = new Inscripcion();
            $resultado = $model->obtenerMensajeEstado($estado);
        }
        
        if (isset($_POST['ajax'])) {
            echo json_encode($resultado);
            exit;
        }
        
        return $resultado;
    }
    
    // Función 2: Clasificar nota
    public function clasificarNota() {
        $resultado = null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $calificacion = $_POST['calificacion'] ?? 0;
            $model = new Nota();
            $clasificacion = $model->clasificarNota($calificacion);
            
            $resultado = [
                'success' => true,
                'calificacion' => $calificacion,
                'clasificacion' => $clasificacion
            ];
        }
        
        if (isset($_POST['ajax'])) {
            echo json_encode($resultado);
            exit;
        }
        
        return $resultado;
    }
    
    // Función 3: Validar disponibilidad de curso
    public function validarDisponibilidad() {
        $resultado = null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idCurso = $_POST['id_curso'] ?? 0;
            $model = new Curso();
            $resultado = $model->validarDisponibilidad($idCurso);
        }
        
        if (isset($_POST['ajax'])) {
            echo json_encode($resultado);
            exit;
        }
        
        return $resultado;
    }
    
    // Función 4: Calcular descuento
    public function calcularDescuento() {
        $resultado = null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $monto = $_POST['monto'] ?? 0;
            $metodo = $_POST['metodo'] ?? '';
            $model = new Pago();
            $resultado = $model->calcularDescuento($monto, $metodo);
        }
        
        if (isset($_POST['ajax'])) {
            echo json_encode($resultado);
            exit;
        }
        
        return $resultado;
    }
}
?>
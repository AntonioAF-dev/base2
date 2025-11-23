<?php
require_once __DIR__ . '/../models/Curso.php';

class CursoController {
    private $model;
    
    public function __construct() {
        $this->model = new Curso();
    }
    
    // Crear nuevo curso
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'titulo' => $_POST['titulo'] ?? '',
                'descripcion' => $_POST['descripcion'] ?? '',
                'precio' => $_POST['precio'] ?? 0,
                'estado' => $_POST['estado'] ?? 'ACTIVO',
                'id_nivel' => $_POST['id_nivel'] ?? 0,
                'id_prof' => $_POST['id_prof'] ?? 0,
                'id_plat' => $_POST['id_plat'] ?? 0,
                'id_tipo' => $_POST['id_tipo'] ?? 0
            ];
            
            $resultado = $this->model->insertar($datos);
            
            if ($resultado['success']) {
                $this->setMensaje('Curso creado exitosamente', 'success');
                header('Location: index.php?page=cursos');
                exit;
            } else {
                $this->setMensaje($resultado['message'], 'error');
            }
        }
        
        require_once __DIR__ . '/../views/cursos/crear.php';
    }
    
    // Listar todos los cursos
    public function index() {
        $resultado = $this->model->obtenerTodos();
        $cursos = $resultado['success'] ? $resultado['data'] : [];
        
        require_once __DIR__ . '/../views/cursos/index.php';
    }
    
    // Buscar cursos con filtros
    public function buscar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idNivel = $_POST['id_nivel'] ?? 0;
            $idTipo = $_POST['id_tipo'] ?? 0;
            
            $resultado = $this->model->buscar($idNivel, $idTipo);
            $cursos = $resultado['success'] ? $resultado['data'] : [];
            
            require_once __DIR__ . '/../views/cursos/buscar.php';
            return;
        }
        
        require_once __DIR__ . '/../views/cursos/buscar.php';
    }
    
    // Validar disponibilidad de curso
    public function validarDisponibilidad() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idCurso = $_POST['id_curso'] ?? 0;
            $resultado = $this->model->validarDisponibilidad($idCurso);
            
            echo json_encode($resultado);
            exit;
        }
    }
    
    // Helpers
    private function setMensaje($mensaje, $tipo) {
        $_SESSION['mensaje'] = $mensaje;
        $_SESSION['tipo_mensaje'] = $tipo;
    }
}
?>
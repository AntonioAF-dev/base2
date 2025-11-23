<?php
require_once __DIR__ . '/Database.php';

class Curso extends Model {
    
    // Insertar curso usando procedimiento almacenado
    public function insertar($datos) {
        try {
            $params = [
                $datos['titulo'],
                $datos['descripcion'],
                $datos['precio'],
                $datos['estado'],
                $datos['id_nivel'],
                $datos['id_prof'],
                $datos['id_plat'],
                $datos['id_tipo']
            ];
            
            $this->callProcedure('sp_insertar_curso', $params, 'ssdsiiii');
            return ['success' => true, 'message' => 'Curso creado exitosamente'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    // Buscar cursos usando procedimiento almacenado
    public function buscar($idNivel = 0, $idTipo = 0) {
        try {
            $result = $this->callProcedure('sp_buscar_cursos', [$idNivel, $idTipo], 'ii');
            
            $cursos = [];
            while ($row = $result->fetch_assoc()) {
                $cursos[] = $row;
            }
            
            return ['success' => true, 'data' => $cursos];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    // Obtener todos los cursos
    public function obtenerTodos() {
        try {
            $query = "SELECT * FROM vista_cursos_completos";
            $result = $this->executeQuery($query);
            
            $cursos = [];
            while ($row = $result->fetch_assoc()) {
                $cursos[] = $row;
            }
            
            return ['success' => true, 'data' => $cursos];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    // Validar disponibilidad usando función
    public function validarDisponibilidad($idCurso) {
        try {
            $mensaje = $this->callFunction('fn_validar_disponibilidad_curso', [$idCurso]);
            return ['success' => true, 'mensaje' => $mensaje];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
?>
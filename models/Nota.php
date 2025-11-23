<?php
require_once __DIR__ . '/Database.php';

class Nota extends Model {
    
    // Buscar notas por curso y calificación mínima
    public function buscar($idCurso = 0, $califMin = 0) {
        try {
            $result = $this->callProcedure('sp_buscar_notas', [$idCurso, $califMin], 'id');
            
            $notas = [];
            while ($row = $result->fetch_assoc()) {
                // Clasificar cada nota usando función
                $row['clasificacion'] = $this->clasificarNota($row['CalifNot']);
                $notas[] = $row;
            }
            
            return ['success' => true, 'data' => $notas];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    // Clasificar nota usando función
    public function clasificarNota($calificacion) {
        try {
            return $this->callFunction('fn_clasificar_nota', [$calificacion]);
        } catch (Exception $e) {
            return 'ERROR';
        }
    }
    
    // Obtener todas las notas
    public function obtenerTodas() {
        try {
            $query = "SELECT * FROM vista_notas_estudiantes ORDER BY FechaCalifNot DESC";
            $result = $this->executeQuery($query);
            
            $notas = [];
            while ($row = $result->fetch_assoc()) {
                $notas[] = $row;
            }
            
            return ['success' => true, 'data' => $notas];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
?>
<?php
require_once __DIR__ . '/Database.php';

class Inscripcion extends Model {
    
    // Actualizar estado de inscripción
    public function actualizarEstado($idIns, $estado) {
        try {
            $this->callProcedure('sp_actualizar_inscripcion', [$idIns, $estado], 'is');
            return ['success' => true, 'message' => 'Inscripción actualizada exitosamente'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    // Buscar inscripciones por fechas
    public function buscarPorFechas($fechaInicio, $fechaFin) {
        try {
            $result = $this->callProcedure('sp_buscar_inscripciones', [$fechaInicio, $fechaFin], 'ss');
            
            $inscripciones = [];
            while ($row = $result->fetch_assoc()) {
                $inscripciones[] = $row;
            }
            
            return ['success' => true, 'data' => $inscripciones];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    // Obtener todas las inscripciones
    public function obtenerTodas() {
        try {
            $query = "SELECT * FROM vista_inscripciones_detalladas ORDER BY FechaIns DESC";
            $result = $this->executeQuery($query);
            
            $inscripciones = [];
            while ($row = $result->fetch_assoc()) {
                $inscripciones[] = $row;
            }
            
            return ['success' => true, 'data' => $inscripciones];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    // Obtener mensaje de estado usando función
    public function obtenerMensajeEstado($estado) {
        try {
            $mensaje = $this->callFunction('fn_mensaje_estado_inscripcion', [$estado]);
            return ['success' => true, 'mensaje' => $mensaje];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
?>
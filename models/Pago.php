<?php
require_once __DIR__ . '/Database.php';

class Pago extends Model {
    
    // Eliminar (cancelar) pago
    public function cancelar($idPago) {
        try {
            $this->callProcedure('sp_eliminar_pago', [$idPago], 'i');
            return ['success' => true, 'message' => 'Pago cancelado exitosamente'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    // Buscar pagos por método y estado
    public function buscar($metodo = '', $estado = '') {
        try {
            $result = $this->callProcedure('sp_buscar_pagos', [$metodo, $estado], 'ss');
            
            $pagos = [];
            while ($row = $result->fetch_assoc()) {
                $pagos[] = $row;
            }
            
            return ['success' => true, 'data' => $pagos];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    // Obtener todos los pagos
    public function obtenerTodos() {
        try {
            $query = "SELECT * FROM vista_pagos_completos ORDER BY FechaPag DESC";
            $result = $this->executeQuery($query);
            
            $pagos = [];
            while ($row = $result->fetch_assoc()) {
                $pagos[] = $row;
            }
            
            return ['success' => true, 'data' => $pagos];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    // Calcular descuento usando función
    public function calcularDescuento($monto, $metodo) {
        try {
            $descuento = $this->callFunction('fn_calcular_descuento_pago', [$monto, $metodo]);
            return [
                'success' => true, 
                'descuento' => $descuento,
                'monto_final' => $monto - $descuento
            ];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
?>
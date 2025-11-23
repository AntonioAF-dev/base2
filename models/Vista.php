<?php
require_once __DIR__ . '/Database.php';

class Vista extends Model {
    
    private $vistas = [
        'vista_cursos_completos' => 'Cursos Completos',
        'vista_inscripciones_detalladas' => 'Inscripciones Detalladas',
        'vista_pagos_completos' => 'Pagos Completos',
        'vista_notas_estudiantes' => 'Notas de Estudiantes',
        'vista_horarios_cursos' => 'Horarios de Cursos'
    ];
    
    // Obtener lista de vistas disponibles
    public function obtenerVistas() {
        return $this->vistas;
    }
    
    // Consultar una vista específica
    public function consultar($nombreVista, $limite = 100) {
        try {
            if (!array_key_exists($nombreVista, $this->vistas)) {
                throw new Exception("Vista no válida");
            }
            
            $query = "SELECT * FROM {$nombreVista} LIMIT {$limite}";
            $result = $this->executeQuery($query);
            
            $datos = [];
            $columnas = [];
            
            // Obtener nombres de columnas
            $fields = $result->fetch_fields();
            foreach ($fields as $field) {
                $columnas[] = $field->name;
            }
            
            // Obtener datos
            while ($row = $result->fetch_assoc()) {
                $datos[] = $row;
            }
            
            return [
                'success' => true,
                'nombre' => $this->vistas[$nombreVista],
                'columnas' => $columnas,
                'datos' => $datos,
                'total' => count($datos)
            ];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
?>
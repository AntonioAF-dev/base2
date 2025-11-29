<?php
require_once __DIR__ . '/Database.php';

class Inscripcion extends Model
{

    // Actualizar estado de inscripción
    public function actualizarEstado($idIns, $estado)
    {
        try {
            $this->callProcedure('sp_actualizar_inscripcion', [$idIns, $estado], 'is');
            return ['success' => true, 'message' => 'Inscripción actualizada exitosamente'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    // Buscar inscripciones por fechas
    public function buscarPorFechas($fechaInicio, $fechaFin)
    {
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
    public function obtenerTodas()
    {
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
    public function obtenerMensajeEstado($estado)
    {
        try {
            $mensaje = $this->callFunction('fn_mensaje_estado_inscripcion', [$estado]);
            return ['success' => true, 'mensaje' => $mensaje];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    // Registrar una nueva inscripción
    public function inscribirse($idUsuario, $idCurso)
    {
        try {
            // Verificar si el usuario ya está inscrito en ese curso
            $sqlCheck = "SELECT id FROM inscripciones 
                     WHERE id_usuario = ? AND id_curso = ?";

            $stmt = $this->db->prepare($sqlCheck);
            $stmt->bind_param("ii", $idUsuario, $idCurso);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return [
                    'success' => false,
                    'message' => 'Ya estás inscrito en este curso'
                ];
            }

            // Registrar inscripción
            $sqlInsert = "INSERT INTO inscripciones (id_usuario, id_curso, estado, fecha_inscripcion)
                      VALUES (?, ?, 'Pendiente', NOW())";

            $stmt = $this->db->prepare($sqlInsert);
            $stmt->bind_param("ii", $idUsuario, $idCurso);
            $stmt->execute();

            return ['success' => true];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    // Obtener inscripciones por usuario
public function obtenerPorUsuario($idUsuario) {
    try {
        $sql = "SELECT * FROM vista_inscripciones_detalladas 
                WHERE id_usuario = ?
                ORDER BY FechaIns DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        $result = $stmt->get_result();

        $inscripciones = [];
        while ($row = $result->fetch_assoc()) {
            $inscripciones[] = $row;
        }

        return ['success' => true, 'data' => $inscripciones];

    } catch (Exception $e) {
        return ['success' => false, 'message' => $e->getMessage()];
    }
}

}

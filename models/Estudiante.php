<?php
require_once __DIR__ . '/Database.php';

class Estudiante extends Model
{

    // Insertar estudiante usando procedimiento almacenado
    public function insertar($datos)
    {
        try {
            $passwordHash = password_hash($datos['password'], PASSWORD_DEFAULT);

            $params = [
                $datos['nombre'],
                $datos['apellido'],
                $datos['email'],
                $passwordHash,
                $datos['bio'] ?? ''
            ];

            $this->callProcedure('sp_insertar_estudiante', $params, 'sssss');
            return ['success' => true, 'message' => 'Estudiante registrado exitosamente'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    // Obtener todos los estudiantes
    public function obtenerTodos()
    {
        try {
            $query = "SELECT e.IdEstud, CONCAT(u.NomUsu, ' ', u.ApeUsu) as Nombre, 
                            u.EmailUsu, e.BioEstud, u.FechaRegUsu
                    FROM Estudiante e
                    INNER JOIN Usuario u ON e.IdUsu = u.IdUsu
                    ORDER BY u.FechaRegUsu DESC";

            $result = $this->executeQuery($query);

            $estudiantes = [];
            while ($row = $result->fetch_assoc()) {
                $estudiantes[] = $row;
            }

            return ['success' => true, 'data' => $estudiantes];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}

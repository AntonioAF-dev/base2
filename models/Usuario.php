<?php
require_once __DIR__ . '/Database.php';

class Usuario extends Model {
    
    // Obtener todos los usuarios
    public function obtenerTodos() {
        try {
            $query = "SELECT IdUsu, NomUsu, ApeUsu, EmailUsu, RolUsu, FechaRegUsu 
                     FROM Usuario ORDER BY FechaRegUsu DESC";
            $result = $this->executeQuery($query);
            
            $usuarios = [];
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }
            
            return ['success' => true, 'data' => $usuarios];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    // Crear usuario
    public function crear($datos) {
        try {
            $passwordHash = password_hash($datos['password'], PASSWORD_DEFAULT);
            
            $stmt = $this->conn->prepare(
                "INSERT INTO Usuario (NomUsu, ApeUsu, EmailUsu, PassUsu, RolUsu, FechaRegUsu) 
                 VALUES (?, ?, ?, ?, ?, CURDATE())"
            );
            
            $stmt->bind_param("sssss", 
                $datos['nombre'],
                $datos['apellido'],
                $datos['email'],
                $passwordHash,
                $datos['rol']
            );
            
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Usuario creado exitosamente'];
            } else {
                throw new Exception('Error al crear usuario: ' . $stmt->error);
            }
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    // Actualizar usuario
    public function actualizar($id, $datos) {
        try {
            $query = "UPDATE Usuario SET NomUsu = ?, ApeUsu = ?, EmailUsu = ?, RolUsu = ? WHERE IdUsu = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ssssi", 
                $datos['nombre'],
                $datos['apellido'],
                $datos['email'],
                $datos['rol'],
                $id
            );
            
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Usuario actualizado exitosamente'];
            } else {
                throw new Exception('Error al actualizar usuario');
            }
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    // Cambiar contraseña
    public function cambiarPassword($id, $newPassword) {
        try {
            $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
            
            $stmt = $this->conn->prepare("UPDATE Usuario SET PassUsu = ? WHERE IdUsu = ?");
            $stmt->bind_param("si", $passwordHash, $id);
            
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Contraseña actualizada'];
            } else {
                throw new Exception('Error al actualizar contraseña');
            }
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    // Eliminar usuario (lógico)
    public function eliminar($id) {
        try {
            // Cambiar a estado inactivo en lugar de eliminar
            $stmt = $this->conn->prepare("UPDATE Usuario SET RolUsu = 'Inactivo' WHERE IdUsu = ?");
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Usuario desactivado'];
            } else {
                throw new Exception('Error al desactivar usuario');
            }
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    // Obtener por ID
    public function obtenerPorId($id) {
        try {
            $stmt = $this->conn->prepare(
                "SELECT IdUsu, NomUsu, ApeUsu, EmailUsu, RolUsu, FechaRegUsu 
                 FROM Usuario WHERE IdUsu = ?"
            );
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                return ['success' => true, 'data' => $result->fetch_assoc()];
            } else {
                return ['success' => false, 'message' => 'Usuario no encontrado'];
            }
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
?>
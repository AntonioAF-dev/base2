<?php
require_once __DIR__ . '/Database.php';

class Auth extends Model {

    // Iniciar sesión con SISTEMA HÍBRIDO
    // Acepta contraseñas en TEXTO PLANO y HASH bcrypt
    public function login($email, $password) {
        try {
            $stmt = $this->conn->prepare("
                SELECT IdUsu, NomUsu, ApeUsu, EmailUsu, PassUsu, RolUsu 
                FROM Usuario 
                WHERE EmailUsu = ?
            ");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) {
                return ['success' => false, 'message' => 'Usuario no encontrado'];
            }

            $user = $result->fetch_assoc();

            $passwordValida = false;
            $actualizarHash = false;

            // MÉTODO 1: Si es hash bcrypt ($2y$ con 60 chars)
            if (strlen($user['PassUsu']) === 60 && substr($user['PassUsu'], 0, 4) === '$2y$') {

                // Verificar hash bcrypt
                if (password_verify($password, $user['PassUsu'])) {
                    $passwordValida = true;
                }

            } else {
                // MÉTODO 2: Contraseña en texto plano
                if ($password === $user['PassUsu']) {
                    $passwordValida = true;
                    $actualizarHash = true; // señal para actualizar la contraseña a bcrypt
                }
            }

            if (!$passwordValida) {
                return ['success' => false, 'message' => 'Contraseña incorrecta'];
            }

            // Si la contraseña era texto plano → actualizar a bcrypt automáticamente
            if ($actualizarHash) {
                $newHash = password_hash($password, PASSWORD_BCRYPT);
                $update = $this->conn->prepare("UPDATE Usuario SET PassUsu = ? WHERE IdUsu = ?");
                $update->bind_param("si", $newHash, $user['IdUsu']);
                $update->execute();
            }

            // Crear sesión
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user['IdUsu'];
            $_SESSION['user_name'] = $user['NomUsu'] . ' ' . $user['ApeUsu'];
            $_SESSION['user_email'] = $user['EmailUsu'];
            $_SESSION['user_role'] = $user['RolUsu'];

            return ['success' => true, 'message' => 'Inicio de sesión exitoso'];

        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }


    // Cerrar sesión
    public function logout() {
        session_unset();
        session_destroy();
        return ['success' => true, 'message' => 'Sesión cerrada'];
    }

    // Verificar si está autenticado
    public function isAuthenticated() {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    // Obtener usuario actual
    public function getCurrentUser() {
        if ($this->isAuthenticated()) {
            return [
                'id' => $_SESSION['user_id'],
                'name' => $_SESSION['user_name'],
                'email' => $_SESSION['user_email'],
                'role' => $_SESSION['user_role']
            ];
        }
        return null;
    }

    // Verificar permisos por rol
    public function hasRole($roles) {
        if (!$this->isAuthenticated()) {
            return false;
        }

        if (is_array($roles)) {
            return in_array($_SESSION['user_role'], $roles);
        }

        return $_SESSION['user_role'] === $roles;
    }
}
?>

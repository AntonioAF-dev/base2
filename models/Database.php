<?php
require_once __DIR__ . '/../config/database.php';

class Model {
    protected $db;
    protected $conn;
    
    public function __construct() {
        $this->db = Database::getInstance();
        $this->conn = $this->db->getConnection();
    }
    
    protected function executeQuery($query, $params = [], $types = "") {
        try {
            if (!empty($params)) {
                $stmt = $this->conn->prepare($query);
                if ($stmt === false) {
                    throw new Exception("Error preparando consulta: " . $this->conn->error);
                }
                
                if (!empty($types)) {
                    $stmt->bind_param($types, ...$params);
                }
                
                $stmt->execute();
                return $stmt;
            } else {
                $result = $this->conn->query($query);
                if ($result === false) {
                    throw new Exception("Error ejecutando consulta: " . $this->conn->error);
                }
                return $result;
            }
        } catch (Exception $e) {
            throw new Exception("Error en consulta: " . $e->getMessage());
        }
    }
    
    protected function callProcedure($procedureName, $params = [], $types = "") {
        try {
            $placeholders = implode(',', array_fill(0, count($params), '?'));
            $query = "CALL {$procedureName}({$placeholders})";
            
            $stmt = $this->conn->prepare($query);
            if ($stmt === false) {
                throw new Exception("Error preparando procedimiento: " . $this->conn->error);
            }
            
            if (!empty($params)) {
                $stmt->bind_param($types, ...$params);
            }
            
            $stmt->execute();
            return $stmt->get_result();
        } catch (Exception $e) {
            throw new Exception("Error llamando procedimiento: " . $e->getMessage());
        }
    }
    
    protected function callFunction($functionName, $params = []) {
        try {
            $paramStr = implode(',', array_map(function($p) {
                return is_numeric($p) ? $p : "'{$p}'";
            }, $params));
            
            $query = "SELECT {$functionName}({$paramStr}) as resultado";
            $result = $this->conn->query($query);
            
            if ($result === false) {
                throw new Exception("Error llamando función: " . $this->conn->error);
            }
            
            $row = $result->fetch_assoc();
            return $row['resultado'];
        } catch (Exception $e) {
            throw new Exception("Error en función: " . $e->getMessage());
        }
    }
}
?>

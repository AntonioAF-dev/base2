<?php
class Database {
    private static $instance = null;
    private $conn;
    
    // Configuración para Laragon
    private $host = 'localhost';
    private $db_name = 'SistemaCapacitaciones';
    private $username = 'root';
    private $password = '';
    
    private function __construct() {
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            
            if ($this->conn->connect_error) {
                throw new Exception("Error de conexión: " . $this->conn->connect_error);
            }
            
            $this->conn->set_charset("utf8mb4");
            
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->conn;
    }
    
    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
    
    private function __clone() {}
    
    public function __wakeup() {
        throw new Exception("No se puede deserializar un singleton");
    }
}
?>
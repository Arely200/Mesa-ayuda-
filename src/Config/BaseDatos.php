<?php
// ============================================================
// BREVE DESCRIPCIÓN:
// Clase de conexión a la base de datos (Patrón Singleton).
// Garantiza una única conexión PDO en toda la aplicación.
// También incluye métodos helpers para ejecutar consultas
// con prepared statements (seguridad contra SQL Injection).
// ============================================================

namespace Config;

use PDO;
use PDOException;

class BaseDatos
{
    private static $instancia = null;
    private $pdo;
    
    private function __construct()
    {
        try {
            $host = $_ENV['DB_HOST'] ?? 'localhost';
            $dbname = $_ENV['DB_NAME'] ?? 'mesa_ayuda';
            $user = $_ENV['DB_USER'] ?? 'root';
            $pass = $_ENV['DB_PASS'] ?? '';
            
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
            
            $this->pdo = new PDO($dsn, $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            
        } catch (PDOException $e) {
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }
    
    public static function obtenerInstancia()
    {
        if (self::$instancia === null) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }
    
    public function obtenerConexion()
    {
        return $this->pdo;
    }
    
    public function consulta($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
    public function obtenerUno($sql, $params = [])
    {
        $stmt = $this->consulta($sql, $params);
        return $stmt->fetch();
    }
    
    public function obtenerTodos($sql, $params = [])
    {
        $stmt = $this->consulta($sql, $params);
        return $stmt->fetchAll();
    }
    
    public function insertar($sql, $params = [])
    {
        $stmt = $this->consulta($sql, $params);
        return $this->pdo->lastInsertId();
    }
}
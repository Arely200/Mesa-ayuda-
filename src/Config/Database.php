<?php
// src/Config/Database.php

namespace Config;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;
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
    
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection()
    {
        return $this->pdo;
    }
    
    // Método para ejecutar consultas con prepared statements (SEGURIDAD)
    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }
    
    // Método para ejecutar consultas y obtener resultados
    public function query($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
    // Método para obtener un solo registro
    public function fetchOne($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch();
    }
    
    // Método para obtener múltiples registros
    public function fetchAll($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll();
    }
    
    // Método para insertar y obtener el ID
    public function insert($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $this->pdo->lastInsertId();
    }
}

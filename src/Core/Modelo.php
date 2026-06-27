<?php
// ============================================================
// BREVE DESCRIPCIÓN:
// Modelo base del sistema (Model).
// Todos los modelos heredan de esta clase.
// Proporciona métodos genéricos para interactuar con la BD
// (findAll, findById, create, update, delete). Cada modelo
// debe definir su propiedad $table con el nombre de la tabla.
// ============================================================


namespace Core;

use Config\BaseDatos;
use PDO;

class Modelo
{
    protected $db;
    protected $tabla;

    public function __construct()
    {
        $this->db = BaseDatos::obtenerInstancia()->obtenerConexion();
    }

    public function encontrarTodos($limite = null, $desplazamiento = 0)
    {
        $sql = "SELECT * FROM {$this->tabla} WHERE activo = 1";
        if ($limite) {
            $sql .= " LIMIT $limite OFFSET $desplazamiento";
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function encontrarPorId($id)
    {
        $sql = "SELECT * FROM {$this->tabla} WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function crear($datos)
    {
        $campos = implode(', ', array_keys($datos));
        $marcadores = ':' . implode(', :', array_keys($datos));
        
        $sql = "INSERT INTO {$this->tabla} ($campos) VALUES ($marcadores)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($datos);
        return $this->db->lastInsertId();
    }

    public function actualizar($id, $datos)
    {
        $set = [];
        foreach ($datos as $key => $value) {
            $set[] = "$key = :$key";
        }
        $setStr = implode(', ', $set);
        $datos['id'] = $id;
        
        $sql = "UPDATE {$this->tabla} SET $setStr WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($datos);
    }

    public function eliminar($id)
    {
        $sql = "UPDATE {$this->tabla} SET activo = 0 WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}
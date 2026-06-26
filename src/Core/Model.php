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

use Config\Database;
use PDO;

class Model
{
    protected $db;
    protected $table;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findAll($limit = null, $offset = 0)
    {
        $sql = "SELECT * FROM {$this->table} WHERE activo = 1";
        if ($limit) {
            $sql .= " LIMIT $limit OFFSET $offset";
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $fields = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO {$this->table} ($fields) VALUES ($placeholders)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "$key = :$key";
        }
        $setStr = implode(', ', $set);
        $data['id'] = $id;
        
        $sql = "UPDATE {$this->table} SET $setStr WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $sql = "UPDATE {$this->table} SET activo = 0 WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}

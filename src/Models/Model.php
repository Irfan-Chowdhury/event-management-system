<?php

namespace App\Models;

use App\Database\DatabaseManager;
use Exception;

abstract class Model
{
    protected $table;  
    protected $db;

    public function __construct()
    {
        $this->db = new DatabaseManager();
    }

    public function getAll() 
    {
        $query = "SELECT * FROM $this->table ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function fetchDataByAttribute($key, $value) 
    {
        $query = "SELECT * FROM $this->table WHERE `$key` = ? LIMIT 1";
        $result = $this->db->select($query, [$value], "s");
    
        return $result ? $result[0] : null;
    }

    public function checkUniqueExceptId($key, $value, $id) 
    {
        $query = "SELECT * FROM $this->table WHERE `$key` = ? AND `id` != ? LIMIT 1";
        $result = $this->db->select($query, [$value, $id], "ss");
    
        return $result ? $result[0] : null;
    }

    public function getById($id): array|bool|null 
    {
        $query = "SELECT * FROM $this->table WHERE `id` = ? LIMIT 1";
        $result = $this->db->select($query, [$id], "s");
    
        return $result ? $result[0] : null;
    }

    public function insert(array $data) 
    {
        $keys = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $types = str_repeat("s", count($data)); // Assuming all are strings

        $query = "INSERT INTO $this->table ($keys) VALUES ($placeholders)";

        $result = $this->db->insert($query, array_values($data), $types);

        if(!$result) {
            throw new Exception("Internal Server Error", 500);
        } 
    }

    public function update(array $data, $id)
    {
        $setClause = implode(", ", array_map(function($key) {
            return "`$key` = ?";
        }, array_keys($data)));
        $types = str_repeat("s", count($data)) . "s"; // Assuming all are strings

        $query = "UPDATE $this->table SET $setClause WHERE `id` = ?";
        $params = array_merge(array_values($data), [$id]);

        $result = $this->db->update($query, $params, $types);

        if(!$result) {
            throw new Exception("Internal Server Error", 500);
        }
    }

    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE `id` = ?";
        $result = $this->db->delete($query, [$id], "s");

        if(!$result) {
            throw new Exception("Internal Server Error", 500);
        }
    }

    protected static function getKeys(array $data) : string
    {
        $arrayKeys = array_keys($data);
        $arrayKeysData = implode(', ', $arrayKeys);

        return $arrayKeysData;
    }

    protected static function getValues(array $data) : string
    {
        $arrayValues = array_values($data);
        $arrayValuesData = implode("', '", array_map('addslashes', $arrayValues));

        return $arrayValuesData;
    }
}
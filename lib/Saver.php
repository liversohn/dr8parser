<?php

namespace Saver;

abstract class Saver {
    
    protected $db;
    protected $data;
    
    public function __construct(\Dibi\Connection $db) {
        $this->db = $db;
    }
    
    public function save() {
        return $this->db->insert(static::$tableName, $this->data)->execute();
    }
    
    public function getSavedId() {
        return $this->db->getInsertId();
    }
    
    public function setValue($key, $value) {
        if (in_array($key, static::$allowedFields)) {
            $this->data[$key] = (string) $value;
        }
    }
    
}
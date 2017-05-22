<?php

namespace App\Core;

/**
 * Class Model
 * @package App\Core
 */
class Model
{
    protected $db;
    protected $tableName;
    
    public function __construct($tableName)
    {
        $this->db = new DataBase();
        $this->tableName = $tableName;
    }
}

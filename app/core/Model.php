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
    protected $config;
    
    public function __construct($tableName)
    {
        $this->db = new DataBase();
        $this->config = new Config();
        $this->tableName = $tableName;
    }
}

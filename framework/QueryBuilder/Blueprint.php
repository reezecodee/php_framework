<?php

namespace Framework\QueryBuilder;

use Database\Database;

class Blueprint
{
    public Database $db;
    public $tableName = '';
    public $columns = [];

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
        $this->db = new Database();
    }

    public function createTable()
    {
        $columns = '';
        
        for ($i = 0; $i < count($this->columns); $i++) {
            $comma = $i < count($this->columns) - 1 ? ',' : '';
            $columns .= "{$this->columns[$i]}$comma";
        }

        $statement = $this->db->prepare("CREATE TABLE {$this->tableName} ($columns);");
        $statement->execute();
    }

    public function id(string $attr_name = 'id', $length = 12)
    {
        array_push($this->columns, "$attr_name INT($length) AUTO_INCREMENT PRIMARY KEY");
        return $this;
    }

    public function varchar(string $attr_name, $length = 255)
    {
        array_push($this->columns, "$attr_name VARCHAR($length)");
        return $this;
    }

    public function unique()
    {
        return $this;
    }
}

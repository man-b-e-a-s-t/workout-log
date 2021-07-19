<?php
class Sex{
  
    // database connection and table name
    private $conn;
    private $table_name = "sex";
  
    // object properties
    public $id;
    public $name;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
?>
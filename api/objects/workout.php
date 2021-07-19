<?php
class Workout{
  
    // database connection and table name
    private $conn;
    private $table_name = "workout";
  
    // object properties
    public $id;
    public $user_id;
    public $name;
    public $workout_date;
    public $notes;
    public $created;
    public $modified;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
?>
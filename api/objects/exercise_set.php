<?php
class ExerciseSet{
  
    // database connection and table name
    private $conn;
    private $table_name = "exercise_set";
  
    // object properties
    public $id;
    public $exercise_d;
    public $weight;
    public $reps;
    public $created;
    public $modified;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
?>
<?php
class WorkoutExerciseSet{
  
    // database connection and table name
    private $conn;
    private $table_name = "workout_exercise_set";
  
    // object properties
    public $id;
    public $workout_exercise_id;
    public $weight;
    public $reps;
    public $time;
    public $created;
    public $modified;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
?>
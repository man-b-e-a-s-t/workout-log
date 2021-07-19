<?php
class WorkoutExercise{
  
    // database connection and table name
    private $conn;
    private $table_name = "workout_exercise";
  
    // object properties
    public $id;
    public $user_id;
    public $workout_id;
    public $exercise_id;
    public $weight_goal;
    public $set_goal;
    public $rep_goal;
    public $created;
    public $modified;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
?>
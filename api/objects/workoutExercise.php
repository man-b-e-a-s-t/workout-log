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
    public $step_number;
    public $weight_goal;
    public $time_goal;
    public $set_goal;
    public $rep_goal;
    public $notes;
    public $created;
    public $modified;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
    // read products
    function read(){
        // select all query
        $query = "SELECT
                    id, user_id, workout_id, exercise_id, step_number, weight_goal,
                    time_goal, set_goal, rep_goal, notes, created, modified
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name DESC";

        if ($this->id && $this->id != null) {
            // select one query
            $query = "SELECT
                        id, user_id, workout_id, exercise_id, step_number, weight_goal,
                        time_goal, set_goal, rep_goal, notes, created, modified
                    FROM
                        " . $this->table_name . "
                    WHERE id = ?
                    LIMIT
                        0,1";
        }

        if ($this->workoutId && $this->workoutId != null) {
            // select one query
            $query = "SELECT
                        id, user_id, workout_id, exercise_id, step_number, weight_goal,
                        time_goal, set_goal, rep_goal, notes, created, modified
                    FROM
                        " . $this->table_name . "
                    WHERE workout_id = ?";
        }

        if ($this->exercise_id && $this->exercise_id != null) {
            // select one query
            $query = "SELECT
                        id, user_id, workout_id, exercise_id, step_number, weight_goal,
                        time_goal, set_goal, rep_goal, notes, created, modified
                    FROM
                        " . $this->table_name . "
                    WHERE exercise_id = ?";
        }
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        if ($this->id && $this->id != null) {
            $stmt->bindParam(1, $this->id);
        }

        if ($this->workoutId && $this->workoutId != null) {
            $stmt->bindParam(1, $this->workoutId);
        }

        if ($this->exercise_id && $this->exercise_id != null) {
            $stmt->bindParam(1, $this->exercise_id);
        }
    
        // execute query
        $stmt->execute();
      
        return $stmt;
    }

    // create exercise
    function create(){
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    user_id=:user_id, workout_id=:workout_id, exercise_id=:exercise_id, step_number=:step_number, weight_goal=:weight_goal,
                    time_goal=:time_goal, set_goal=:set_goal, rep_goal=:rep_goal, notes=:notes, modified=:modified, created=:created";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        $this->workout_id=htmlspecialchars(strip_tags($this->workout_id));
        $this->exercise_id=htmlspecialchars(strip_tags($this->exercise_id));
        $this->step_number=htmlspecialchars(strip_tags($this->step_number));
        $this->weight_goal=htmlspecialchars(strip_tags($this->weight_goal));
        $this->time_goal=htmlspecialchars(strip_tags($this->time_goal));
        $this->set_goal=htmlspecialchars(strip_tags($this->set_goal));
        $this->rep_goal=htmlspecialchars(strip_tags($this->rep_goal));
        $this->notes=htmlspecialchars(strip_tags($this->notes));
        $this->modified=htmlspecialchars(strip_tags($this->modified));
        $this->created=htmlspecialchars(strip_tags($this->created));
    
        // bind values
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":workout_id", $this->workout_id);
        $stmt->bindParam(":exercise_id", $this->exercise_id);
        $stmt->bindParam(":step_number", $this->step_number);
        $stmt->bindParam(":weight_goal", $this->weight_goal);
        $stmt->bindParam(":time_goal", $this->time_goal);
        $stmt->bindParam(":set_goal", $this->set_goal);
        $stmt->bindParam(":rep_goal", $this->rep_goal);
        $stmt->bindParam(":notes", $this->notes);
        $stmt->bindParam(":modified", $this->modified);
        $stmt->bindParam(":created", $this->created);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // copy workout
    function copy($previous_workout_id){
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                    (user_id, workout_id, exercise_id, step_number, weight_goal,
                    time_goal, set_goal, rep_goal, notes, created, modified)
                SELECT
                    user_id, " . $this->workout_id . ", exercise_id, step_number, weight_goal,
                    time_goal, set_goal, rep_goal, notes, NOW(), NOW()
                FROM
                    " . $this->table_name . "
                WHERE workout_id = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $previous_workout_id);
    
        // execute query
        if ($stmt->execute()) {
            return true;
        }
      
        return false;
    }

    // update the product
    function update(){
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    user_id=:user_id, workout_id=:workout_id, exercise_id=:exercise_id, step_number=:step_number, weight_goal=:weight_goal,
                    time_goal=:time_goal, set_goal=:set_goal, rep_goal=:rep_goal, notes=:notes, modified=:modified
                WHERE
                    id=:id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        $this->workout_id=htmlspecialchars(strip_tags($this->workout_id));
        $this->exercise_id=htmlspecialchars(strip_tags($this->exercise_id));
        $this->step_number=htmlspecialchars(strip_tags($this->step_number));
        $this->weight_goal=htmlspecialchars(strip_tags($this->weight_goal));
        $this->time_goal=htmlspecialchars(strip_tags($this->time_goal));
        $this->set_goal=htmlspecialchars(strip_tags($this->set_goal));
        $this->rep_goal=htmlspecialchars(strip_tags($this->rep_goal));
        $this->notes=htmlspecialchars(strip_tags($this->notes));
        $this->modified=htmlspecialchars(strip_tags($this->modified));
    
        // bind values
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":workout_id", $this->workout_id);
        $stmt->bindParam(":exercise_id", $this->exercise_id);
        $stmt->bindParam(":step_number", $this->step_number);
        $stmt->bindParam(":weight_goal", $this->weight_goal);
        $stmt->bindParam(":time_goal", $this->time_goal);
        $stmt->bindParam(":set_goal", $this->set_goal);
        $stmt->bindParam(":rep_goal", $this->rep_goal);
        $stmt->bindParam(":notes", $this->notes);
        $stmt->bindParam(":modified", $this->modified);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>
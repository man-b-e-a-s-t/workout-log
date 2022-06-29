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
    
    // read products
    function read(){
        // select all query
        $query = "SELECT
                    id, user_id, name, workout_date, notes, created, modified
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name DESC";

        if ($this->id && $this->id != null) {
            // select one query
            $query = "SELECT
                        id, user_id, name, workout_date, notes, created, modified
                    FROM
                        " . $this->table_name . "
                    WHERE id = ?
                    LIMIT
                        0,1";
        }
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        if ($this->id && $this->id != null) {
        // bind id of product to be updated
            $stmt->bindParam(1, $this->id);
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
                    user_id=:user_id, name=:name, workout_date=:workout_date, notes=:notes, modified=:modified, created=:created";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->workout_date=htmlspecialchars(strip_tags($this->workout_date));
        $this->notes=htmlspecialchars(strip_tags($this->notes));
        $this->modified=htmlspecialchars(strip_tags($this->modified));
        $this->created=htmlspecialchars(strip_tags($this->created));
    
        // bind values
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":workout_date", $this->workout_date);
        $stmt->bindParam(":notes", $this->notes);
        $stmt->bindParam(":modified", $this->modified);
        $stmt->bindParam(":created", $this->created);
    
        // execute query
        if($stmt->execute()){
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
                    user_id = :user_id,
                    name = :name,
                    workout_date = :workout_date,
                    notes = :notes,
                    modified = :modified
                WHERE
                    id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->workout_date=htmlspecialchars(strip_tags($this->workout_date));
        $this->notes=htmlspecialchars(strip_tags($this->notes));
        $this->modified=htmlspecialchars(strip_tags($this->modified));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind new values
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':workout_date', $this->workout_date);
        $stmt->bindParam(':notes', $this->notes);
        $stmt->bindParam(':modified', $this->modified);
        $stmt->bindParam(':id', $this->id);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>
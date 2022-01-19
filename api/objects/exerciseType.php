<?php
class ExerciseType{
  
    // database connection and table name
    private $conn;
    private $table_name = "exerciseType";
  
    // object properties
    public $id;
    public $name;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
    // read products
    function read(){
        // select all query
        $query = "SELECT
                    id, name
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name DESC";

        if ($this->id && $this->id != null) {
            // select one query
            $query = "SELECT
                        id, name
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
                    name=:name";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
    
        // bind values
        $stmt->bindParam(":name", $this->name);
    
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
                    name = :name
                WHERE
                    id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind new values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':id', $this->id);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>
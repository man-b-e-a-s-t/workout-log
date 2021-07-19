<?php
class Database{
  
    // specify your own database credentials
    private $host = "jasonray.me";
    private $db_name = "workout_log";
    private $username = "workout_log_app";
    private $password = "zQxtxxjy9uW3xDw";
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>
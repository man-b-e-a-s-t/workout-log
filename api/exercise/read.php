<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/exercise.php';
  
// instantiate database and exercise object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$exercise = new Exercise($db);

// set ID property of record to read
$exercise->id = isset($_GET['id']) ? $_GET['id'] : null;

// query items
$stmt = $exercise->read();
$num = $stmt->rowCount();

// items array
$exercises_arr=array();
  
// check if more than 0 record found
if(!isset($_GET['id']) && $num>0){
    
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $arr_item=array(
            "id" => $id,
            "userId" => $user_id,
            "name" => $name,
            "exerciseTypeId" => $exercise_type_id,
            "notes" => html_entity_decode($notes),
            "created" => $created,
            "modified" => $modified
        );
  
        array_push($exercises_arr, $arr_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show exercise data in json format
    echo json_encode($exercises_arr);
    
} elseif(isset($_GET['id']) && $num==1){    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $exercises_arr=array(
            "id" => $id,
            "userId" => $user_id,
            "name" => $name,
            "exerciseTypeId" => $exercise_type_id,
            "notes" => html_entity_decode($notes),
            "created" => $created,
            "modified" => $modified
        );
    }

    // set response code - 200 OK
    http_response_code(200);
  
    // show exercise data in json format
    echo json_encode($exercises_arr);

} else {
  
    // set response code - 404 Not found
    // http_response_code(404);
  
    // tell the user no exercises found
    echo json_encode($exercises_arr);
}
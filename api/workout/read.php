<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/workout.php';
  
// instantiate database and workout object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$workout = new Workout($db);

// set ID property of record to read
$workout->id = isset($_GET['id']) ? $_GET['id'] : null;

// query items
$stmt = $workout->read();
$num = $stmt->rowCount();

// items array
$workouts_arr=array();
  
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
            "workoutDate" => $workout_date,
            "notes" => html_entity_decode($notes),
            "created" => $created,
            "modified" => $modified
        );
  
        array_push($workouts_arr, $arr_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show workout data in json format
    echo json_encode($workouts_arr);
    
} elseif(isset($_GET['id']) && $num==1){    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $workouts_arr=array(
            "id" => $id,
            "userId" => $user_id,
            "name" => $name,
            "workoutDate" => $workout_date,
            "notes" => html_entity_decode($notes),
            "created" => $created,
            "modified" => $modified
        );
    }

    // set response code - 200 OK
    http_response_code(200);
  
    // show workout data in json format
    echo json_encode($workouts_arr);

} else {
  
    // set response code - 404 Not found
    // http_response_code(404);
  
    // tell the user no workouts found
    echo json_encode($workouts_arr);
}
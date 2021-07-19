<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/exercise.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare exercise object
$exercise = new Exercise($db);
  
// get id of exercise to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of exercise to be edited
$exercise->id = $data->id;
  
// set exercise property values
$exercise->user_id = $data->user_id;
$exercise->name = $data->name;
$exercise->notes = $data->notes;
$exercise->modified = date('Y-m-d H:i:s');

// update the exercise
if($exercise->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Exercise was updated."));
}
  
// if unable to update the exercise, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update exercise."));
}
?>
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/exerciseType.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare exerciseType object
$exerciseType = new ExerciseType($db);
  
// get id of exerciseType to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of exerciseType to be edited
$exerciseType->id = $data->id;
  
// set exerciseType property values
$exerciseType->name = $data->name;

// update the exerciseType
if($exerciseType->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Exercise type was updated."));
}
  
// if unable to update the exerciseType, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update exercise type."));
}
?>
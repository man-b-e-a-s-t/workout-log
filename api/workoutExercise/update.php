<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/workoutExercise.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare workoutExercise object
$workoutExercise = new WorkoutExercise($db);
  
// get id of workoutExercise to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of workoutExercise to be edited
$workoutExercise->id = $data->id;
  
// set workoutExercise property values
$workoutExercise->user_id = $data->userId;
$workoutExercise->workout_id = $data->workoutId;
$workoutExercise->exercise_id = $data->exerciseId;
$workoutExercise->step_number = $data->stepNumber;
$workoutExercise->weight_goal = $data->weightGoal;
$workoutExercise->time_goal = $data->timeGoal;
$workoutExercise->set_goal = $data->setGoal;
$workoutExercise->rep_goal = $data->repGoal;
$workoutExercise->notes = $data->notes;
$workoutExercise->modified = date('Y-m-d H:i:s');

// update the workoutExercise
if($workoutExercise->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Workout exercise was updated."));
}
  
// if unable to update the workoutExercise, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update workoutExercise."));
}
?>
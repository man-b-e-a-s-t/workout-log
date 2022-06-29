<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate workoutExercise object
include_once '../objects/workoutExercise.php';
  
$database = new Database();
$db = $database->getConnection();
  
$workoutExercise = new WorkoutExercise($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->userId) &&
    !empty($data->name) &&
    !empty($data->workoutExerciseTypeId) &&
    !empty($data->notes)
){
  
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
    $workoutExercise->created = date('Y-m-d H:i:s');
  
    // create the workoutExercise
    if($workoutExercise->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Workout exercise was created."));
    }
  
    // if unable to create the workoutExercise, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create workoutExercise."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create workoutExercise. Data is incomplete."));
}
?>
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate workout object
include_once '../objects/workout.php';
include_once '../objects/workoutExercise.php';
  
$database = new Database();
$db = $database->getConnection();
  
$workout = new Workout($db);
  
// get posted data
$workout->id = file_get_contents("php://input");
// $data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($workout->id)
){
  
    // copy the workout
    if($workout->copy()){
        
        $new_workout_id = $db->lastInsertId();
        
        $workoutExercise = new WorkoutExercise($db);
        $workoutExercise->workout_id = $new_workout_id;
        
        // copy the workout exercises
        if ($workoutExercise->copy($workout->id)){
  
            // set response code - 201 copied
            http_response_code(201);
    
            // tell the user
            echo json_encode(array(
                "message" => "Workout was copied.",
                "newWorkoutId" => $new_workout_id
            ));
        }
    }
  
    // if unable to copy the workout, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to copy workout."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to copy workout. Data is incomplete."));
}
?>
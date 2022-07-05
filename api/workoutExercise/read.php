<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/workoutExercise.php';
  
// instantiate database and workoutExercise object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$workoutExercise = new WorkoutExercise($db);

// set ID property of record to read
$workoutExercise->id = isset($_GET['id']) ? $_GET['id'] : null;
$workoutExercise->workoutId = isset($_GET['workoutId']) ? $_GET['workoutId'] : null;
$workoutExercise->exerciseId = isset($_GET['exerciseId']) ? $_GET['exerciseId'] : null;

// query items
$stmt = $workoutExercise->read();
$num = $stmt->rowCount();

// items array
$workoutExercises_arr=array();
  
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
            "workoutId" => $workout_id,
            "exerciseId" => $exercise_id,
            "stepNumber" => $step_number,
            "weightGoal" => (float)$weight_goal,
            "timeGoal" => (int)$time_goal,
            "setGoal" => (int)$set_goal,
            "repGoal" => (int)$rep_goal,
            "notes" => html_entity_decode($notes),
            "created" => $created,
            "modified" => $modified
        );
  
        array_push($workoutExercises_arr, $arr_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show workoutExercise data in json format
    echo json_encode($workoutExercises_arr);
    
} elseif(isset($_GET['id']) && $num==1){    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $workoutExercises_arr=array(
            "id" => $id,
            "userId" => $user_id,
            "workoutId" => $workout_id,
            "exerciseId" => $exercise_id,
            "stepNumber" => $step_number,
            "weightGoal" => (float)$weight_goal,
            "timeGoal" => (int)$time_goal,
            "setGoal" => (int)$set_goal,
            "repGoal" => (int)$rep_goal,
            "notes" => html_entity_decode($notes),
            "created" => $created,
            "modified" => $modified
        );
    }

    // set response code - 200 OK
    http_response_code(200);
  
    // show workoutExercise data in json format
    echo json_encode($workoutExercises_arr);

} else {
  
    // set response code - 404 Not found
    // http_response_code(404);
  
    // tell the user no workoutExercises found
    echo json_encode($workoutExercises_arr);
}
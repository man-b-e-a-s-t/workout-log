<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/exerciseType.php';
  
// instantiate database and exerciseType object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$exerciseType = new ExerciseType($db);

// set ID property of record to read
$exerciseType->id = isset($_GET['id']) ? $_GET['id'] : null;

// query items
$stmt = $exerciseType->read();
$num = $stmt->rowCount();

// items array
$exerciseTypes_arr=array();
  
// check if more than 0 record found
if($num>1){
    
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
            "name" => $name
        );
  
        array_push($exerciseTypes_arr, $arr_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show exerciseType data in json format
    echo json_encode($exerciseTypes_arr);
    
} elseif($num==1){    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $exerciseTypes_arr=array(
            "id" => $id,
            "name" => $name
        );
    }

    // set response code - 200 OK
    http_response_code(200);
  
    // show exerciseType data in json format
    echo json_encode($exerciseTypes_arr);

} else {
  
    // set response code - 404 Not found
    // http_response_code(404);
  
    // tell the user no exerciseTypes found
    echo json_encode($exerciseTypes_arr);
}
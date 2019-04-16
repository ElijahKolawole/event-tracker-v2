<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/slot.php';
 
// instantiate database and slot object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$slot = new Slot($db);


// set ID property of record to read
$slot->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of slot to be edited
$slot->readOne();
 
if($slot->title!=null){
    // create array
    $slot_arr = array(
        "id" => $slot->$id,
        "event_id" => $slot->$event_id,
        "title" => $slot->$title,
        "description" => $slot->$description,
        "date" => $slot->$date,
        "min" => $slot->$min,
        "max" => $slot->$max,
        "starttime" => $slot->$starttime,
        "endtime" => $slot->$endtime,
        "created" => $slot->$created
    
    );
    
  // set response code - 200 OK
  http_response_code(200);
 
  // make it json format
  echo json_encode($slot_arr);
}

else{
  // set response code - 404 Not found
  http_response_code(404);

  // tell the user event does not exist
  echo json_encode(array("message" => "slot does not exist."));
}
?>
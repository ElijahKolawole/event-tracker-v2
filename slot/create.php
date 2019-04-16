<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate slot object
include_once '../objects/slot.php';
 
$database = new Database();
$db = $database->getConnection();
 
$slot = new Slot($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->event_id) &&
    !empty($data->title) &&
    !empty($data->description) &&
    !empty($data->date) 
   
    
   
  ){
 
// set slot property values
$slot->event_id = $data->event_id;
$slot->title = $data->title;
$slot->description = $data->description;
$slot->date= $data->date;
$slot->starttime = $data->starttime;
$slot->endtime = $data->endtime;
$slot->min= $data->min_position;
$slot->max= $data->max_position;
$slot->created = date('Y-m-d H:i:s');
 $slot->modified = modified('Y-m-d H:i:s');
// create the slot
if($slot->create()){
 
    // set response code - 201 created
    http_response_code(201);

    // tell the user
    echo json_encode(array("message" => "slot was created."));
}

// if unable to create the slot, tell the user
else{

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to create slot."));
}
}

// tell the user data is incomplete
else{

// set response code - 400 bad request
http_response_code(400);

// tell the user
echo json_encode(array("message" => "Unable to create event. Data is incomplete."));
}
?>
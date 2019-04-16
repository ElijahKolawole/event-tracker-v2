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
 
// set slot property values
$slot->event_id = $data->event_id;
$slot->title = $data->title;
$slot->description = $data->description;
$slot->date= $data->date;
$slot->starttime = $data->starttime;
$slot->endtime = $data->endtime;
$slot->min= $data->min;
$slot->max= $data->max;
$slot->created = date('Y-m-d H:i:s');
 
// create the slot
if($slot->create()){
    echo '{';
        echo '"message": "Slot was created."';
    echo '}';
}
 
// if unable to create the slot, tell the user
else{
    echo '{';
        echo '"message": "Unable to create slot."';
    echo '}';
}
?>
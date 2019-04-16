<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/slot.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare slot object
$slot = new Slot($db);
 
// get id of slot to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of slot to be edited
$slot->id = $data->id;
 
// set slot property values
$slot->title = $data->title;
$slot->description = $data->description;
$slot->date= $data->date;
$slot->min= $data->min;
$slot->max= $data->max;
$slot->starttime = $data->starttime;
$slot->endtime = $data->endtime;
 
// update the slot
if($slot->update()){
    echo '{';
        echo '"message": "Slot was updated."';
    echo '}';
}
 
// if unable to update the slot, tell the user
else{
    echo '{';
        echo '"message": "Unable to update slot."';
    echo '}';
}
?>
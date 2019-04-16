<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
 
// include database and object file
include_once '../config/database.php';
include_once '../objects/slot.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare slot object
$slot = new Slot($db);
 
// get slot id
$data = json_decode(file_get_contents("php://input"));
 
// set slot id to be deleted
$slot->id = $data->id;
 
// delete the slot
if($slot->delete()){
    echo '{';
        echo '"message": "Slot was deleted."';
    echo '}';
}
 
// if unable to delete the slot
else{
    echo '{';
        echo '"message": "Unable to delete object."';
    echo '}';
}
?>
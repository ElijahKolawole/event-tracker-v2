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

// if specific slot ID requested then show one slot
if(isset($_GET['id'])){

    // set ID property of slot to be edited
    $slot->id = isset($_GET['id']) ? $_GET['id'] : die();
    
    // read the details of slot to be edited
    $slot->readOne();
    
    // create array
    $slot_arr = array(
        "id" =>  $slot->id,
        "event_id" => $slot->event_id,
        "event_title" => $slot->event_title,
        "title" => $slot->title,
        "description" => $slot->description,
        "date" => $slot->date,
        "min" => $slot->min,
        "max" => $slot->max,
        "starttime" => $slot->starttime,
        "endtime" => $slot->endtime
    
    );
    
    // make it json format
    print_r(json_encode($slot_arr));


// if specific event ID requested
} elseif(isset($_GET['event_id'])) {


    // query slots
    $stmt = $slot->readOneEvent($_GET['event_id']);
    $num = $stmt->rowCount();
    
    // check if more than 0 record found
    if($num>0){
    
        // slots array
        $slots_arr=array();
        $slots_arr["records"]=array();
    
        // retrieve our table contents
        // fetch() is faster than fetchAll()
        // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
    
            $slot_item=array(
                "id" => $id,
                "event_id" => $event_id,
                "event_title" => $event_title,
                "title" => $title,
                "description" => $description,
                "date" => $date,
                "min" => $min,
                "max" => $max,
                "starttime" => $starttime,
                "endtime" => $endtime
                
            );
    
            array_push($slots_arr["records"], $slot_item);
        }
    
        echo json_encode($slots_arr);
    }
    
    
// if specific slot ID not requested then show all slots
    else{
        echo json_encode(
            array("message" => "No slots found.")
        );
    }
} else {


    // query slots
    $stmt = $slot->read();
    $num = $stmt->rowCount();
    
    // check if more than 0 record found
    if($num>0){
    
        // slots array
        $slots_arr=array();
        $slots_arr["records"]=array();
    
        // retrieve our table contents
        // fetch() is faster than fetchAll()
        // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
    
            $slot_item=array(
                "id" => $id,
                "event_id" => $event_id,
                "event_title" => $event_title,
                "title" => $title,
                "description" => $description,
                "date" => $date,
                "min" => $min,
                "max" => $max,
                "starttime" => $starttime,
                "endtime" => $endtime
                
            );
    
            array_push($slots_arr["records"], $slot_item);
        }
    
        echo json_encode($slots_arr);
    }
    
    else{
        echo json_encode(
            array("message" => "No slots found.")
        );
    }
}
?>
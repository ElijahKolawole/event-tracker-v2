<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/event.php';
 
// instantiate database and event object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$event = new Event($db);

// if specific event ID requested then show one event
if(isset($_GET['id'])){

    // set ID property of event to be edited
    $event->id = isset($_GET['id']) ? $_GET['id'] : die();
    
    // read the details of event to be edited
    $event->readOne();
    
    // create array
    $event_arr = array(
        "id" =>  $event->id,
        "organization_id" => $event->organization_id,
        "org_name" => $event->org_name,
        "title" => $event->title,
        "description" => $event->description,
        "email" => $event->email,
        "phone" => $event->phone,
        "public" => $event->public
    
    );
    
    // make it json format
    print_r(json_encode($event_arr));

// if specific organization ID requested
} elseif(isset($_GET['organization_id'])) {


    // query events
    $stmt = $event->readOneEvent($_GET['organization_id']);
    $num = $stmt->rowCount();
    
    // check if more than 0 record found
    if($num>0){
    
        // events array
        $events_arr=array();
        $events_arr["records"]=array();
    
        // retrieve our table contents
        // fetch() is faster than fetchAll()
        // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
    
            $event_item=array(
                "id" => $id,
                "organization_id" => $organization_id,
                "org_name" => $org_name,
                "title" => $title,
                "description" => $description,
                "email" => $email,
                "phone" => $phone,
                "public" => $public
                
            );
    
            array_push($events_arr["records"], $event_item);
        }
    
        echo json_encode($events_arr);
    }
    
    else{
        echo json_encode(
            array("message" => "No events found.")
        );
    }
} else {


    // query events
    $stmt = $event->read();
    $num = $stmt->rowCount();
    
    // check if more than 0 record found
    if($num>0){
    
        // events array
        $events_arr=array();
        $events_arr["records"]=array();
    
        // retrieve our table contents
        // fetch() is faster than fetchAll()
        // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
    
            $event_item=array(
                "id" => $id,
                "organization_id" => $organization_id,
                "org_name" => $org_name,
                "title" => $title,
                "description" => $description,
                "email" => $email,
                "phone" => $phone,
                "public" => $public
                
            );
    
            array_push($events_arr["records"], $event_item);
        }
    
        echo json_encode($events_arr);
    }
    
    else{
        echo json_encode(
            array("message" => "No events found.")
        );
    }
}
?>
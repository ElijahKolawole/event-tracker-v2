<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/slot.php';
 
// instantiate database and slot object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$slot = new Slot($db);
 
// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";
 
// query slots
$stmt = $slot->search($keywords);
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
            "title" => $title,
            "description" => html_entity_decode($description),
            "date" => $date,
            "min" => $min,
            "max" => $max,
            "starttime" => $starttime,
            "endtime" => $endtime,
            "event_id" => $event_id,
            "event_title" => $event_title,
            "organization_name" => $organization_name
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
?>
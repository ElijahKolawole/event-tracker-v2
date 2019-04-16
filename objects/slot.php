<?php
class Slot{
 
    // database connection and table name
    private $conn;
    private $table_name = "slots";
 
    // object properties
    public $id;
    public $event_id;
    public $title;
    public $description;
    public $date;
    public $starttime;
    public $endtime;
    public $created;
    public $min;
    public $max;



 
    public function __construct($db){
        $this->conn = $db;
    }
 
  function read(){

   /* $query = "SELECT s.title as job_title, s.starttime as starttime, s.endtime as endtime, s.min as min_position, s.max as max_position, s.description as job_description, o.name as org_name, e.id, e.organization_id, e.title, e.description, e.email, e.phone, e.created 
        FROM $this->table_name e 
        LEFT JOIN organizations o 
        ON e.organization_id = o.id
        LEFT JOIN slots s
        ON e.id = s.event_id
        ORDER BY e.created DESC "; */
    
    // query to read single record
  /*  $query =  "SELECT e.title as event_title, s.id, s.event_id, s.title, s.description, s.date, s.starttime, s.endtime, s.created, s.min, s.max 
    FROM $this->table_name s
    JOIN events e
    ON e.id = s.event_id
    ORDER BY s.created DESC "; */

      // prepare query statement
    //  $stmt = $this->conn->prepare( $query );

      // bind id of product to be updated
    //  $stmt->bindParam(1, $this->id);
  
      // execute query
    //  $stmt->execute();
  
      // get retrieved row
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
  
      // set values to object properties
    /*  $this->title = $row['title'];
      $this->description = $row['description'];
      $this->date = $row['date'];
      $this->starttime = $row['starttime'];
      $this->endtime = $row['endtime'];
      $this->min = $row['min'];
      $this->max = $row['max'];
  
      $this->created = $row['created'];
      $this->event_id = $row['event_id'];
      */
    //  return $stmt;
  
}




// create slot
function create(){
 

    // query to insert record
    $query = "INSERT INTO
                 $this->table_name 
            SET
                 title=:title, description=:description, date=:date, starttime=:starttime,endtime=:endtime,created=:created, min=:min, max=:max";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    //$this->event_id=htmlspecialchars(strip_tags($this->event_id));
    $this->title=htmlspecialchars(strip_tags($this->title));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->date=htmlspecialchars(strip_tags($this->date));
    $this->starttime=htmlspecialchars(strip_tags($this->starttime));
    $this->endtime=htmlspecialchars(strip_tags($this->endtime));
    $this->min=htmlspecialchars(strip_tags($this->min));
    $this->max=htmlspecialchars(strip_tags($this->max));
   // $this->created=htmlspecialchars(strip_tags($this->created));

    // bind values
    $stmt->bindParam(":event_id", $this->event_id);
    $stmt->bindParam(":event_title", $this->event_title);

    $stmt->bindParam(":title", $this->title);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":date", $this->date);
    $stmt->bindParam(":starttime", $this->starttime);
    $stmt->bindParam(":endtime", $this->endtime);
    $stmt->bindParam(":min", $this->min);
    $stmt->bindParam(":max", $this->max);
    $stmt->bindParam(":created", $this->created);
// execute query
if($stmt->execute()){
    return true;
}

return false;
 
}


// used when filling up the update product form
function readOne(){

  /*  $query = "SELECT s.title as job_title, s.starttime as starttime, s.endtime as endtime, s.min as min_position, s.max as max_position, s.description as job_description, o.name as org_name, e.id, e.organization_id, e.title, e.description, e.email, e.phone, e.created 
    FROM $this->table_name e 
    LEFT JOIN organizations o 
    ON e.organization_id = o.id
    LEFT JOIN slots s
    ON e.id = s.event_id
            WHERE
                e.id = ?
            LIMIT
                0,1"; */
    
    // query to read single record
  /*  $query =  "SELECT e.title as event_title, s.id, s.event_id, s.title, s.description, s.date, s.starttime, s.endtime, s.created, s.min, s.max 
    FROM $this->table_name s
    JOIN events e
    ON e.id = s.event_id
            WHERE
                s.id = ?
            LIMIT
                0,1"; */

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);

    // execute query
    $stmt->execute();

    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->event_title = $row['event_title'];

    // set values to object properties
    $this->title = $row['title'];
    $this->description = $row['description'];
    $this->date = $row['date'];
    $this->starttime = $row['starttime'];
    $this->endtime = $row['endtime'];
    $this->min = $row['min'];
    $this->max = $row['max'];
    $this->created = $row['created'];
    $this->event_id = $row['event_id'];



}


  // update the product
  function update(){
    
    // update query
    $query = "UPDATE $this->table_name 
                SET
                 title=:title, description=:description, date=:date, starttime=:starttime,endtime=:endtime,created=:created, min=:min, max=:max
                
            WHERE
                id = :id";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

   // sanitize
   $this->event_id=htmlspecialchars(strip_tags($this->event_id));
   $this->title=htmlspecialchars(strip_tags($this->title));
   $this->description=htmlspecialchars(strip_tags($this->description));
   $this->date=htmlspecialchars(strip_tags($this->date));
   $this->starttime=htmlspecialchars(strip_tags($this->starttime));
   $this->endtime=htmlspecialchars(strip_tags($this->endtime));
   $this->min=htmlspecialchars(strip_tags($this->min));
   $this->max=htmlspecialchars(strip_tags($this->max));
  // $this->created=htmlspecialchars(strip_tags($this->created));

   // bind values
   $stmt->bindParam(":id", $this->id);
   $stmt->bindParam(":title", $this->title);
   $stmt->bindParam(":description", $this->description);
   $stmt->bindParam(":date", $this->date);
   $stmt->bindParam(":starttime", $this->starttime);
   $stmt->bindParam(":endtime", $this->endtime);
   $stmt->bindParam(":min", $this->min);
   $stmt->bindParam(":max", $this->max);
  // $stmt->bindParam(":created", $this->created);


    // execute the query
    if($stmt->execute()){
        return true;
    }

    return false;
}


  // delete the product
  function delete(){
    
    // delete query
    $query = "DELETE FROM 
    $this->table_name 
    WHERE id = ?";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));

    // bind id of record to delete
    $stmt->bindParam(1, $this->id);

    // execute query
    if($stmt->execute()){
        return true;
    }

    return false;
    
}

// search products
function search($keywords){
    
    // select all query
    $query = "SELECT e.title as event_title, s.id, s.event_id, s.title, s.description, s.date, s.starttime, s.endtime, s.created, s.min, s.max 
    FROM $this->table_name s
    LEFT JOIN events e
    ON e.id = s.event_id
    
            WHERE
                s.title LIKE ? OR s.description LIKE ? OR s.id LIKE ?
            ORDER BY
                s.created DESC";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";

    // bind
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);

    // execute query
    $stmt->execute();

    return $stmt;
}

public function readPaging($from_record_num, $records_per_page){
    
    // select query
    $query = $query = "SELECT e.title as event_title, s.id, s.event_id, s.title, s.description, s.date, s.starttime, s.endtime, s.created, s.min, s.max 
    FROM $this->table_name s
    LEFT JOIN events e
    ON e.id = s.event_id

            ORDER BY s.created DESC
            LIMIT ?, ?";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind variable values
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

    // execute query
    $stmt->execute();

    // return values from database
    return $stmt;
}


// used for paging products
public function count(){
    $query = "SELECT COUNT(*) as total_rows 
    FROM $this->table_name";

    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['total_rows'];
}


}
?>
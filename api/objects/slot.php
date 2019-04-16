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
    public $min;
    public $max;
    public $starttime;
    public $endtime;
    public $created;

    // referenced properties
    
    public $event_name;
    public $organization_name;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
    
        // select all query
        $query = "SELECT
                    e.title as event_title, s.id, s.event_id, s.title, s.description, s.date, s.starttime, s.endtime, s.min, s.max, s.created
                FROM
                    " . $this->table_name . " s
                    LEFT JOIN
                        events e
                            ON s.event_id = e.id
                ORDER BY
                    s.created DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    function readOneEvent($eid){
    
        // select all query
        $query = "SELECT
                    e.title as event_title, s.id, s.event_id, s.title, s.description, s.date, s.starttime, s.endtime, s.min, s.max, s.created
                FROM
                    " . $this->table_name . " s
                    LEFT JOIN
                        events e
                            ON s.event_id = e.id
                WHERE
                    s.event_id = ?
                ORDER BY
                    s.created DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        //bind event id of slot to be read
        $stmt->bindParam(1, $eid);

        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // used when filling up the update product form
    function readOne(){
    
        // query to read single record
        $query = "SELECT
                    e.title as event_title, s.id, s.event_id, s.title, s.description, s.date, s.starttime, s.endtime, s.min, s.max, s.created
                FROM
                    " . $this->table_name . " s
                    LEFT JOIN
                        events e
                            ON s.event_id = e.id
                WHERE
                    s.id = ?
                LIMIT
                    0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->title = $row['title'];
        $this->description = $row['description'];
        $this->date = $row['date'];
        $this->starttime = $row['starttime'];
        $this->endtime = $row['endtime'];
        $this->min = $row['min'];
        $this->max = $row['max'];
        $this->event_id = $row['event_id'];
        $this->event_title = $row['event_title'];
    }



    // create product
    function create(){

    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    event_id=:event_id,title=:title, description=:description, date=:date, starttime=:starttime, endtime=:endtime, min=:min, max=:max, created=:created";
    
        // prepare query
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
        $this->created=htmlspecialchars(strip_tags($this->created));
    
        // bind values
        $stmt->bindParam(":event_id", $this->event_id);
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
    
    // update the product
    function update(){
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    title=:title, 
                    description=:description, 
                    date=:date, 
                    starttime=:starttime, 
                    endtime=:endtime,
                    min=:min,
                    max=:max
                WHERE
                    id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->date=htmlspecialchars(strip_tags($this->date));
        $this->starttime=htmlspecialchars(strip_tags($this->starttime));
        $this->endtime=htmlspecialchars(strip_tags($this->endtime));
        $this->min=htmlspecialchars(strip_tags($this->min));
        $this->max=htmlspecialchars(strip_tags($this->max));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind values
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":starttime", $this->starttime);
        $stmt->bindParam(":endtime", $this->endtime);
        $stmt->bindParam(":min", $this->min);
        $stmt->bindParam(":max", $this->max);
        $stmt->bindParam(":id", $this->id);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    // delete the product
    function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
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
        $query = "SELECT
                    e.title as event_title, o.name as organization_name, s.event_id, s.id, s.title, s.description, s.date, s.starttime, s.endtime, s.min, s.max, s.created
                FROM
                    " . $this->table_name . " s
                    LEFT JOIN
                        events e
                            ON s.event_id = e.id
                    LEFT JOIN
                        organizations o
                            ON e.organization_id = o.id
                WHERE
                    s.title LIKE ? OR s.description LIKE ? OR e.description LIKE ?
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

    // read products with pagination
    public function readPaging($from_record_num, $records_per_page){
    
        // select query
        $query = "SELECT
                    e.title as event_title, s.id, s.event_id, s.title, s.description, s.date, s.starttime, s.endtime, s.min, s.max, s.created
                FROM
                    " . $this->table_name . " s
                    LEFT JOIN
                        events e
                            ON s.event_id = e.id
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
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $row['total_rows'];
    }
}
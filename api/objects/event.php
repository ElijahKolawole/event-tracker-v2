<?php
class Event{
 
    // database connection and table name
    private $conn;
    private $table_name = "events";
 
    // object properties
    public $id;
    public $organization_id;
    public $title;
    public $description;
    public $email;
    public $phone;
    public $public;
    public $created;

    // referenced properties
    
    public $org_name;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
    
        // select all query
        $query = "SELECT
                    o.name as org_name, e.id, e.organization_id, e.title, e.description, e.email, e.phone, e.public, e.created
                FROM
                    " . $this->table_name . " e
                    LEFT JOIN
                        organizations o
                            ON e.organization_id = o.id
                ORDER BY
                    e.created DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    function readOneEvent($eid){
    
        // select all query
        $query = "SELECT
                    o.name as org_name, e.id, e.organization_id, e.title, e.description, e.email, e.phone, e.public, e.created
                FROM
                    " . $this->table_name . " e
                    LEFT JOIN
                        organizations o
                            ON e.organization_id = o.id
                WHERE
                    e.organization_id = ?
                ORDER BY
                    e.created DESC";
    
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
                    o.name as org_name, e.id, e.organization_id, e.title, e.description, e.email, e.phone, e.public, e.created
                FROM
                    " . $this->table_name . " e
                    LEFT JOIN
                        organizations o
                            ON e.organization_id = o.id
                WHERE
                    e.id = ?
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
        $this->email = $row['email'];
        $this->phone = $row['phone'];
        $this->public = $row['public'];
        $this->organization_id = $row['organization_id'];
        $this->org_name = $row['org_name'];
    }



    // create product
    function create(){

    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    organization_id=:organization_id, title=:title, description=:description, email=:email, phone=:phone, public=:public, created=:created";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->organization_id=htmlspecialchars(strip_tags($this->organization_id));
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->phone=htmlspecialchars(strip_tags($this->phone));
        $this->public=htmlspecialchars(strip_tags($this->public));
        $this->created=htmlspecialchars(strip_tags($this->created));
    
        // bind values
        $stmt->bindParam(":organization_id", $this->organization_id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":public", $this->public);
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
                    phone=:phone, 
                    public=:public
                WHERE
                    id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->phone=htmlspecialchars(strip_tags($this->phone));
        $this->public=htmlspecialchars(strip_tags($this->public));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind values
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":public", $this->public);
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
                    o.name as org_name, e.organization_id, e.id, e.title, e.description, e.email, e.phone, e.public, e.created
                FROM
                    " . $this->table_name . " e
                    LEFT JOIN
                        organizations o
                            ON e.organization_id = o.id
                WHERE
                    e.title LIKE ? OR e.description LIKE ? OR o.name LIKE ?
                ORDER BY
                    e.created DESC";
    
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
                    o.name as org_name, e.organization_id, e.id, e.title, e.description, e.email, e.phone, e.public, e.created
                FROM
                    " . $this->table_name . " e
                    LEFT JOIN
                        organizations o
                            ON e.organization_id = o.id
                ORDER BY e.created DESC
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
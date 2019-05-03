<?php
class Photo
{
    // access token, database connection and table name
    private $conn;
    private $tableName   = "photos";
    
    // object properties
    public $pID;
    public $uID;
    public $caption;
    public $picPath;
    public $creationDate;


    // constructor with $db as database connection
    public function __construct($_db)
    {
        $this->conn = $_db;
    }

    // read photos
    function read()
    {
        // select all query
        $query = "SELECT * FROM " . $this->tableName;
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

    // delete the photo
    function delete()
    {
        // delete query
        $query = "DELETE FROM " . $this->tableName . " WHERE p_id = ?";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->pID = htmlspecialchars(strip_tags($this->pID));
     
        // bind pID of record to delete
        $stmt->bindParam(1, $this->pID);
        
        // execute query
        $stmt->execute();
       
        if(!$stmt->rowCount())
            return false;
     
       return true;
         
    }

    // update the photo
    function update()
    {
     
        // update query
        $query = "UPDATE " . $this->tableName . " SET
                    caption        = :caption,
                    pic_path       = :pic_path
                WHERE
                    p_id = :p_id";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->pID     = htmlspecialchars(strip_tags($this->pID));
        $this->caption = htmlspecialchars(strip_tags($this->caption));
        $this->picPath = htmlspecialchars(strip_tags($this->picPath));
     
        // bind new values
        $stmt->bindParam(':caption', $this->caption);
        $stmt->bindParam(':pic_path', $this->picPath);
        $stmt->bindParam(':p_id', $this->pID);
        
        // execute query
        $stmt->execute();

        if(!$stmt->rowCount())
            return false;

        return true;
    }
}
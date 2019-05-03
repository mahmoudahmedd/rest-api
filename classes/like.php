<?php
/**
 *  @file    like.php
 *  @author  Mahmoud Ahmed Tawfik (@mahmoudahmedd)
 *  @date    03/05/2019
 *  @version 1.0
 */
class Like
{
    // access token, database connection and table name
    private $conn;
    private $tableName   = "likes";
    
    // object properties
    public $lID;
    public $uID;
    public $pID;
    public $creationDate;


    // constructor with $db as database connection
    public function __construct($_db)
    {
        $this->conn = $_db;
    }

    // get likes
    function get()
    {
        // select all query
        $query = "SELECT * FROM " . $this->tableName . " WHERE p_id = ?";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->pID = htmlspecialchars(strip_tags($this->pID));

        // bind pID of record to get
        $stmt->bindParam(1, $this->pID);
     
        // execute query
        $stmt->execute();

        return $stmt;
    }
}
<?php
/**
 *  @file    user.php
 *  @author  Mahmoud Ahmed Tawfik (@mahmoudahmedd)
 *  @date    03/05/2019
 *  @version 1.0
 */
class User
{
    // access token, database connection and table name
    private $conn;
    private $tableName   = "users";
    
    // object properties
    public $uID;
    public $userName;
    public $email;
    public $fullName;
    public $password;
    public $profilePicPath;
    public $accessToken;
    public $registerDate;

    public $authenticated = 0;

    // constructor with $db as database connection
    public function __construct($_db, $_accessToken)
    {
        $this->conn        = $_db;
        $this->accessToken = htmlspecialchars(strip_tags($_accessToken));

        // check if $_accessToken is valid
        $query = "SELECT * FROM " . $this->tableName . " WHERE access_token = '" . $this->accessToken . "'";

        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        $num   = $stmt->rowCount();

        // Check the number of rows that match the SELECT statement
        if($num)
            $this->authenticated = 1;
    }

    // read the user
    function read()
    {
        // select all query
        $query = "SELECT * FROM " . $this->tableName . " WHERE access_token = '" . $this->accessToken . "'";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

    // delete the user
    function delete()
    {
        // delete query
        $query = "DELETE FROM " . $this->tableName . " WHERE u_id = ? AND access_token = ?";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->uID = htmlspecialchars(strip_tags($this->uID));
     
        // bind uID of record to delete
        $stmt->bindParam(1, $this->uID);

        // bind access_token of record to delete
        $stmt->bindParam(2, $this->accessToken);
        
        // execute query
        $stmt->execute();
       
        if(!$stmt->rowCount())
            return false;
     
       return true;
         
    }

    // update the user
    function update()
    {
     
        // update query
        $query = "UPDATE " . $this->tableName . " SET
                    username         = :username,
                    email            = :email,
                    full_name        = :full_name,
                    password         = :password,
                    profile_pic_path = :profile_pic_path
                WHERE
                    u_id = :u_id
                    AND 
                    access_token = :access_token";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->userName       = htmlspecialchars(strip_tags($this->userName));
        $this->email          = htmlspecialchars(strip_tags($this->email));
        $this->fullName       = htmlspecialchars(strip_tags($this->fullName));
        $this->password       = htmlspecialchars(strip_tags($this->password));
        $this->profilePicPath = htmlspecialchars(strip_tags($this->profilePicPath));
     
        // bind new values
        $stmt->bindParam(':username', $this->userName);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':full_name', $this->fullName);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':profile_pic_path', $this->profilePicPath);
        $stmt->bindParam(':access_token', $this->accessToken);
        $stmt->bindParam(':u_id', $this->uID);
        $stmt->bindParam(':access_token', $this->accessToken);
        
        // execute query
        $stmt->execute();

        if(!$stmt->rowCount())
            return false;

        return true;
    }

    // register the user
    function register()
    {
     
        // query to insert record
        $query = "INSERT INTO " . $this->tableName . "
                SET
                    username=:username, 
                    email=:email, 
                    full_name=:full_name, 
                    password=:password, 
                    profile_pic_path=:profile_pic_path,
                    access_token=:access_token,
                    register_date=:register_date";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->userName       = htmlspecialchars(strip_tags($this->userName));
        $this->email          = htmlspecialchars(strip_tags($this->email));
        $this->fullName       = htmlspecialchars(strip_tags($this->fullName));
        $this->password       = htmlspecialchars(strip_tags($this->password));
        $this->profilePicPath = htmlspecialchars(strip_tags($this->profilePicPath));
     
        // bind values
        $stmt->bindParam(':username', $this->userName);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':full_name', $this->fullName);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':profile_pic_path', $this->profilePicPath);
        $stmt->bindParam(':access_token', $this->accessToken);
        $stmt->bindParam(':register_date', $this->registerDate);
     
        // execute query
        $stmt->execute();

        if(!$stmt->rowCount())
            return false;

        return true;
         
    }


}
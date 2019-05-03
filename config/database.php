<?php
/**
 *  @file    database.php
 *  @author  Mahmoud Ahmed Tawfik (@mahmoudahmedd)
 *  @date    03/05/2019
 *  @version 1.0
 */
class Database
{
    // specify your own database credentials
    private $HOST     = "localhost";
    private $DB_NAME  = "social_network_database";
    private $USERNAME = "root";
    private $PASSWORD = "";
    
    public  $conn;

    public function __construct() 
    {
        $this->conn = null;
    }

    // get the database connection
    public function getConnection()
    {
        try
        {
            $this->conn = new PDO("mysql:host=" . $this->HOST . ";dbname=" . $this->DB_NAME, $this->USERNAME, $this->PASSWORD);

            $this->conn->exec("set names utf8");
        }
        catch(PDOException $exception)
        {
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }

    public function __destruct() 
    {
        // now we're done; close it
        $this->conn = null;
    }
}
?>
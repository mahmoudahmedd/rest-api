<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// instantiate database and admin object
$db = (new Database())->getConnection();

// initialize object
$like = new Like($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

if(isset($data))
{
    // set like property values
    $like->pID = $data->pID;
}

// query likes
$stmt  = $like->get();
$num   = $stmt->rowCount();

// Check the number of rows that match the SELECT statement
if($num > 0)
{
    // the request has succeeded
    $data["status"] = "ok";

    // admin data
    $data["data"]   = array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
      
        $like = array
        (
            "l_id"          => $l_id,
            "u_id"          => $u_id,
            "p_id"          => $p_id,
            "creation_date" => $creation_date
        );


        array_push($data["data"], $like);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show likes data in json format
    echo json_encode($data);
}
else
{
    $data["status"]  = "fail";
    $data["message"] = "No likes found.";

	// set response code - 404 Not found
    http_response_code(404);
    
    // tell the user no likes found
    echo json_encode($data);
}

?>
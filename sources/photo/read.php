<?php
// instantiate database and admin object
$db = (new Database())->getConnection();

// initialize object
$photo = new Photo($db);

// query photos
$stmt  = $photo->read();
$num   = $stmt->rowCount();

// Check the number of rows that match the SELECT statement
if($num > 0)
{
    // the request has succeeded
    $data["status"] = "ok";
    // photos array
    $data["data"]   = array();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
      
        $photo_e = array
        (
            "p_id"           => $p_id,
            "u_id"           => $u_id,
            "caption"        => $caption,
            "pic_path"       => $pic_path,
            "creation_date " => $creation_date,
        );

        array_push($data["data"], $photo_e);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show photo data in json format
    echo json_encode($data);
}
else
{
    $data["status"]  = "fail";
    $data["message"] = "No photo found.";

	// set response code - 404 Not found
    http_response_code(404);
    
    // tell the user no photo found
    echo json_encode($data);
}

?>
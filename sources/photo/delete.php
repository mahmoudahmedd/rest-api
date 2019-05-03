<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// instantiate database object
$db = (new Database())->getConnection();
 
// initialize object
$photo = new Photo($db);
 
// get photo id
$data = json_decode(file_get_contents("php://input"));

if(isset($data))
{
	// set photo id to be deleted
	$photo->pID = $data->p_id;
}

// delete the photo
if($photo->delete())
{
	// the request has succeeded
    $data["status"]  = "ok";
    $data["message"] = "Photo was deleted.";

    // set response code - 200 ok
    http_response_code(200);
 
    // tell the photo
    echo json_encode($data);
}
else
{
 	$data["status"]      = "fail";
    $data["message"]     = "Photo wasn't deleted.";

    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the photo
    echo json_encode($data);
}
?>
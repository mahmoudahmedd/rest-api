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
 
// get id of photo to be edited
$data = json_decode(file_get_contents("php://input"));
 
if(isset($data))
{
	// set photo id to be edited
	$photo->pID = $data->p_id;

	// set photo property values
	$photo->caption  = $data->caption;
	$photo->picPath  = $data->pic_path;
}
 
// update the photo
if($photo->update())
{
	// the request has succeeded
    $data["status"]  = "ok";
    $data["message"] = "Photo was updated.";
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode($data);
}
else
{
	$data["status"]  = "fail";
    $data["message"] = "Unable to update photo.";

    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode($data);
}
?>
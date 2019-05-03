<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
if(!isset($_GET['access_token']))
    $_GET['access_token'] = '';

// instantiate database object
$db = (new Database())->getConnection();
 
// initialize object
$user = new User($db, $_GET['access_token']);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

if(isset($data))
{
    // set user property values
    $user->userName       = $data->username;
    $user->email          = $data->email;
    $user->fullName       = $data->full_name;
    $user->password       = $data->password;
    $user->profilePicPath = $data->profile_pic_path;
    $user->accessToken    = md5(time());
    $user->registerDate   = date('Y-m-d H:i:s');
}

// make sure data is not empty
if(
    !empty($user->userName) &&
    !empty($user->email)    &&
    !empty($user->fullName) &&
    !empty($user->password)
)
{
    // register the user
    if($user->register())
    {
        // the request has succeeded
        $data["status"]  = "ok";
        $data["message"] = "User was Registered.";
     
        // set response code - 200 ok
        http_response_code(200);
     
        // tell the user
        echo json_encode($data);
    }
    else
    {
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to register user."));
    }

}
else
{
    $data["status"]  = "fail";
    $data["message"] = "Unable to register user. Data is incomplete.";

    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode($data);
}
?>

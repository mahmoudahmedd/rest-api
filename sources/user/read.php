<?php
// instantiate database and admin object
$db = (new Database())->getConnection();

if(!isset($_GET['access_token']))
    $_GET['access_token'] = '';

// initialize object
$user = new User($db, $_GET['access_token']);

// query users
$stmt  = $user->read();
$num   = $stmt->rowCount();

// Check the number of rows that match the SELECT statement
if($num > 0 && $user->authenticated)
{
    // the request has succeeded
    $data["status"] = "ok";

    // admin data
    $data["data"]   = '';
 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // extract row
    // this will make $row['name'] to
    // just $name only
    extract($row);
  
    $admin = array
    (
        "u_id"             => $u_id,
        "username"         => $username,
        "email"            => $email,
        "full_name"        => $full_name,
        "password "        => $password,
        "profile_pic_path" => $profile_pic_path,
        "access_token "    => $access_token,
        "register_date"    => $register_date,
    );

    $data["data"] = $admin;
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show user data in json format
    echo json_encode($data);
}
else
{
    $data["status"]  = "fail";
    $data["message"] = "No user found.";

	// set response code - 404 Not found
    http_response_code(404);
    
    // tell the user no user found
    echo json_encode($data);
}

?>
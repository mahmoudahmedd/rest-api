<?php
// include database and core files
include_once '/config/database.php';
include_once '/config/core.php';

$data["api_version"] = $CONF['api_version'];

if(isset($_GET['a']) && isset($_GET['b']) && isset($pages[$_GET['a']]) && isset($actions[$_GET['b']])) 
{
	$page_name = $pages[$_GET['a']];
	$action    = $actions[$_GET['b']];

	// include object file
	include_once("/classes/{$page_name}.php");
	include_once("/sources/{$page_name}/{$action}.php");
} 
else 
{
    $data["status"]      = "fail";
    $data["message"]     = "Unsupported get request. Please read the API documentation.";

	// set response code - 404 Not found
    http_response_code(404);
    
    // tell the user no products found
    echo json_encode($data);
}
?>

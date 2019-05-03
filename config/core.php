<?php
// show error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// conf array
$CONF  = array();

// data array
$data  = array();

// The Installation URL
$CONF['url'] = 'http://localhost:8080';

// The API Version
$CONF['api_version'] = "1.0";


$pages     = array
				(
					'user'		=> 'user',
					'photo'		=> 'photo',
					'like'		=> 'like'
				);

$actions   = array
				(
					'read'		=> 'read',
					'update'	=> 'update',
					'delete'    => 'delete',
					'register'  => 'register',
					'get'       => 'get'
			    );
?>
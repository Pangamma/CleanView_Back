<?php
require 'config.php';

error_reporting ( 0 );

// Create connection
$connection = mysqli_connect ( DB_HOST, DB_USER, DB_PASS, DB_NAME );

$response = array ();

// Check connection
if (mysqli_connect_errno ( $connection )) {
	$response [Status] = "Error";
	$response [Message] = "Failed to connect to MySQL: " . mysqli_connect_error ();
} else {
	
	// read the post data
	$inputJSON = file_get_contents ( 'php://input' );
	
	// load json data
	$input = json_decode ( $inputJSON, TRUE );
	
	// Adding courses to the db
	$query = "INSERT INTO courses (name, school_id, year, quarter, section, sln) VALUES ('" . $input [name] . "','" . $input [school_id] . "','" . $input [year] . "', '" . $input [quarter] . "', '" . $input [section] . "', '" . $input [sln] . "')";
	
	mysqli_query ( $connection, $query );
	// end of adding courses
	
	mysqli_close ( $connection );
	
	$response [Status] = "OK";
}

echo json_encode ( $response );
?>
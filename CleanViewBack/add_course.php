<?php
require 'secure/config.php';

// Create connection
$connection = mysqli_connect ( DB_HOST, DB_USER, DB_PASS, DB_NAME );

// Check connection
if (mysqli_connect_errno ( $connection )) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error ();
} else {
	echo "Success";
}

// read the post data
$inputJSON = file_get_contents ( 'php://input' );

// load json data
$input = json_decode ( $inputJSON, TRUE );

// Adding courses to the db
$query = "INSERT INTO courses (name, school_id, year, quarter, section, sln) VALUES ('" . $input [name] . "','" . $input [school_id] . "','" . $input [year] . "', '" . $input [quarter] . "', '" . $input [section] . "', '" . $input [sln] . "')";

mysqli_query ( $connection, $query );
// end of adding courses

mysqli_close ( $connection );

?>
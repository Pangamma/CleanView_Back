<?php
	require_once ('secure/api.php');

	$api = new Api ();

	$courses = explode(',' , $_GET["classes"]);
	$user = $_SESSION["userJson"]->getUserId();
	foreach( $courses as $course ){
		$api->addEnrollment($course, $user);
	}
	die();
?>
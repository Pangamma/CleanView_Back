<?php
require ('api.php');

$rest = explode ( '/', $_SERVER ['REQUEST_URI'] );

if (isset ( $rest [3] )) {
	$api = new Api ();
	switch ($rest [3]) {
		case 'users' :
			$result;
			if (isset ( $rest [4] )) {
				$result = $api->getUserById ( $rest [4] );
			} else {
				$result = $api->getUsers ();
			}
			echo json_encode ( $result );
			
			break;
		
		case 'schools' :
			$result;
			if (isset ( $rest [4] )) {
				$result = $api->getSchoolById ( $rest [4] );
			} else {
				$result = $api->getSchools ();
			}
			echo json_encode ( $result );
			
			break;
		
		case 'courses' :
			$result;
			if (isset ( $rest [4] )) {
				$result = $api->getCourseById ( $rest [4] );
			} else {
				$result = $api->getCourses ();
			}
			echo json_encode ( $result );
			
			break;
	}
}

?>
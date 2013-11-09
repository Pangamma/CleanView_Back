<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>test usage</title>
    </head>
    <body>
		<?php
		require_once('api.php');
		$api = new Api();
		$courses = $api->getCourses();
		foreach($courses as $key => $val){
			echo $val->getName().'<br/>';
		}
		
//		$users = $api->getUsers();
//		foreach($users as $user){
//			echo $user->getUsername();
//		}
		
		?>
    </body>
</html>

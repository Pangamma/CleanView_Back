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
		$api->setDeleted(4,true);
		$event = $api->getEventById(4);
		echo json_encode($event);
		?>
    </body>
</html>

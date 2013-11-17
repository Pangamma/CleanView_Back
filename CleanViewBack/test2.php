<?php
require_once('secure/api.php');
$api = new Api();
if (!$api->isLoggedIn()){
	echo $api->login("planetman.hack@gmail.com", "banana");
}
echo $api->isLoggedIn();
$user = $api->getCurrentUser();
echo json_encode($user);
$userId = $user->getUserId();
$list = $api->getEventsByUserId($userId, 0, 5000);
foreach ($list as $key => $val){
	echo "<br/>".json_encode($val);
}

?>

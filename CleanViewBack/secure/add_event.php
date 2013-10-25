<?php
#####################################################################
# 	       D O C U M E N T _ S U M M A R Y							#
#####################################################################
# init_variables.php will be used for initilizing commonly used     #
# variables such as username or api keys. It might also initialize  #
# the database connection.											#
#####################################################################
// authenticate if possible
$dbConn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME,DB_PORT) or die('could not connect to database');
$user_id = -1;//something. We still need to figure out how we will have our user authenticate themselves in the database.
$title = isset($_POST['title']) ? mysqli_real_escape_string($_POST['title']) : 'no title';
$descrip = isset($_POST['description']) ? mysqli_real_escape_string($_POST['description']) : 'no description';
$typeid = isset($_POST['typeid']) ? mysqli_real_escape_string($_POST['typeid']) : 'misc';
$time = 0;//what time format should we use?
$posterid = mysqli_real_escape_string($user_id);//we defined this in the init_variables.php file. Kind of. 
$courseid = isset($_POST['courseid']) ? mysqli_real_escape_string($_POST['courseid']) : 'no title';

$query = "INSERT INTO `events` (`title`, `description`, `type_id`, `time`, `poster_id`, `course_id`, `deleted`)"
		."VALUES ('".$title."', '".$descrip."', ".$typeid.", ".$time.",".$posterid.",". $courseid .", b'0')";
$result = mysqli_query($dbConn, $query) or die(mysqli_error($dbConn));
//output results in JSON format.
echo mysqliToJson($result);
?>
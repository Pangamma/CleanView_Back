<?php
#####################################################################
# 	       D O C U M E N T _ S U M M A R Y							#
#####################################################################
// init_variables.php will be used for initilizing commonly used     
// variables such as username or api keys. It might also initialize  
// the database connection.											
#####################################################################
// authenticate if possible
$dbConn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME,DB_PORT) or die('could not connect to database');
$user_id = -1;//something. We still need to figure out how we will have our user authenticate themselves in the database.

?>

<?php
#####################################################################
# 	       D O C U M E N T _ S U M M A R Y							#
#####################################################################
# init_variables.php will be used for initilizing commonly used     #
# variables such as username or api keys. It might also initialize  #
# the database connection.											#
#####################################################################
// authenticate if possible
$dbConn = mysqli_connect(SQL_DB_HOST,SQL_DB_USER,SQL_DB_PASS,SQL_DB_NAME,SQL_DB_PORT) or die('could not connect to database');
$user_id = 0;//something. We still need to figure out how we will have our user authenticate themselves in the database.



?>
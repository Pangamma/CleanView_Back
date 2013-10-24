<?php
#####################################################################
#		D O C U M E N T _ S U M M A R Y	#
#####################################################################
# The config will contain a number of constants to be used by the	#
# rest of the software. 											#
#####################################################################

#####################################################################
# 		D A T A B A S E  _ S E T T I N G S		  					#
#####################################################################
define('DB_NAME','uwb_devdogs');
define('DB_HOST','localhost');
define('DB_USER','uwb');
define('DB_PASS','Seattle2013');
/* Example Use : 
If I want to retrieve a constant 'DB_NAME', I can use any of the following methods to echo it into output.
1) echo constant('DB_NAME');
2) echo ${DB_NAME};
3) echo DB_NAME; */
?>
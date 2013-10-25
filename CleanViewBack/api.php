<?php
#####################################################################
# 	       D O C U M E N T _ S U M M A R Y							#
#####################################################################
# The api will contain a number of methods to be used by the front	#
# end design team. config.php will specify constants or other		#
# variables that can be used with the software we are making. 		#
#####################################################################
#	I N C L U D E _ R E S O U R C E S								#
	require_once('secure/config.php');								#
	require_once('secure/init_variables.php');						#
#####################################################################
	switch(htmlspecialchars($_POST['action'])){
		case 'get_events':
			include_once('secure/get_events.php');break;
		case 'add_user':
			include_once('secure/add_user.php');break;
		case 'add_school':
		case 'add_course':
			include_once('secure/add_course.php');break;
		case 'add_event':
		case 'add_subscription':	//(subscriptiont to a course number.)
		default:
			echo ('acceptable values for action are : get_events');
			break;
	}
?>
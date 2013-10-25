<?php
#####################################################################
#			D O C U M E N T _ S U M M A R Y							#
#####################################################################
# Returns all events within the specified time frame that match the #
# given search parameters.											#
# parameters : ____________________________________________________ #
# start = (Unix Time) Start of when to pull events from.			#
# _________________________________________________________________ #
# end = (Unix Time) End of when to pull events from.				#
# _________________________________________________________________ #
# user_id  = student number                             	        #
# _________________________________________________________________ #
# courses = comma separated list of course numbers to grab data for #
# if no value is given, method will assume you want to show all of  #
# the courses for the given user. 									# 
# _________________________________________________________________ #
# types = comma separated list of eventtype_id numbers to show.     #
# If no type is given, method assumes you want to show all types of #
# events. 															#
#####################################################################
#
$start = $_POST['start'];
$end = $_POST['end'];
$user_id = $_POST['user_id'];
//create query.
$query = "SELECT * FROM `events` WHERE "
		."`time` >= '".mysqli_escape_string($dbConn, $start)
		."' AND `time` <= '".mysqli_escape_string($dbConn, $end)
		."' AND `user_id`='".mysqli_escape_string($dbConn, $user_id)."'";
mysqli_query($dbConn,$query) or die(mysqli_error($dbConn));


// do useful crap here. 
// get output
// convert output to JSON
// return the JSON to the requester. 
?>
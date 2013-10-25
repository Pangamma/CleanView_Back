<?php
#####################################################################
# 	       D O C U M E N T _ S U M M A R Y							#
#####################################################################
# defines important methods used throughout the back-end website.   #
#####################################################################
	
/*---------------------------------------------------------------------------
function : mysqliToJSON
usage : Input a mysqli_result object. 
returns : A JSON output that will contain all values from the mysql output.
 Sometimes a mysqli_result will return as a boolean. */
function mysqliToJson($results){
	if ($results instanceof boolean){
		return $results;//look up why this happens, I guess... 
	}
	$output = array();
	while($row = mysqli_fetch_row($results)){
			$rowValues = array();
			foreach($row as $cname => $value){
				$rowValues[$cname] = $value;
			}
			$output[] = $rowValues;
	}
	return json_encode($output);
}

?>

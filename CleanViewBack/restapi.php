<?php

/*
 * This class acts as a wrapper so that non-local programs can use our API.
 */
require_once('api.php');
class RestApi extends Api{
	/** takes in an action and a json string. 
	 * Make no attempts to validate data before passing variables to this 
	 * method. The method will carry the responsibility of sanitizing input.
	 * @param string $actionStr available types : ['add_event','add_user','add_course']
	 * @param string $jsonStr is an unparsed undecoded raw JSON string.
	 * **/
	function rawInput($actionStr = 'default',$jsonStr = '{}'){
		
	}
	function getEventById($jsonStr){
		$data = json_decode($jsonStr,false);
		$id = $data['event_id'];
		$event = parent::getEventById($id);
		if (isset($event)){
			return json_encode($event);
		}else{
			return Api::$error_prefix."Event not found by id: ".$id.".";
		}
	}
}
?>

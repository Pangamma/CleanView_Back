<?php

/*
 * This class acts as a wrapper so that non-local programs can use our API.
 */
require_once('api.php');
class RestApi{
	
	/** takes in an action and a json string. 
	 * Make no attempts to sanitize data before passing variables to this 
	 * method, this method will carry the responsibility for sanitizing input.
	 * @param string $actionStr available types : ['add_event','add_user','add_course']
	 * @param string $authJson is a json string containing username and password in the format { user:"username" , pass:"password"}
	 * @param string $paramsJson is an unparsed undecoded raw JSON string.
	 * **/
	function execute($actionStr = 'default' ,$authJson, $paramsJson){
		switch($actionStr){
			default:
				echo "invalid action";
		}
	}
	private function getEventById($jsonStr){
		$data = json_decode($jsonStr,false);
		$id = $data['event_id'];
		$event = parent::getEventById($id);
		if (isset($event)){
			return json_encode($event);
		}else{
			return Api::$e_prefix."Event not found by id: ".$id.".";
		}
	}
}
?>

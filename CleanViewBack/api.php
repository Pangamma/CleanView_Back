<?php
#####################################################################
# 	       D O C U M E N T _ S U M M A R Y							#
#####################################################################
# The api will contain a number of methods to be used by the front	#
# end design team. config.php will specify constants or other		#
# variables that can be used with the software we are making. 		#
#####################################################################
#	I N C L U D E _ R E S O U R C E S								#
	require_once('../config.php');           						#
	require_once('secure/init_variables.php');						#
#####################################################################
//<editor-fold defaultstate="collapsed" desc="Api">
class Api{
	private $dbConn;
	//--------------------------------------------------------------------------
	//constructor that makes the database connection using variables from config.
	function __construct(){
		$this->$dbConn = mysqli_connect(DB_HOST, DB_USER,DB_PASS,DB_NAME, DB_PORT);
	}
	/**
	 * @param int $courseid is the id of the 
	 * @param DateTime $dateTime time when item is due.
	 * @param string $title will be the caption
	 * @param string $description
	 * @param int $typeid the type of event type.
	 */
	function addEvent($courseid,$dateTime,$title = 'event',$description = 'event description',$typeid = 1){
		$query = "";
	}
}
//</editor-fold>
//<editor-fold defaultstate="collapsed" desc="Event Object">
class Event{
	private $courseId;
	private $dateTime;
	private $title = 'event';
	private $desc = 'event description';
	private $typeId = 1;
	/**
	 * Create a new event to be used to enter into 
	 * @param int $courseId
	 * @param DateTime $dateTime
	 * @param string $title
	 * @param string type $description
	 * @param int $typeid
	 */
	function __construct($courseId,$dateTime,$title,$description,$typeId){
		$this->courseId = $courseId;
		$this->dateTime = $dateTime;
		$this->title = $title;
		$this->desc = $description;
		$this->typeId = $typeId;
	}
	
	
}
//</editor-fold>
?>
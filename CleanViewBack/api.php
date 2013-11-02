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
	private static $tbl_Courses = 'courses';
	private static $tbl_Enrollments = 'enrollments';
    private static $tbl_Events = 'events';
	
    public static $error_prefix = 'Error : ';
	private $dbConn;
	//--------------------------------------------------------------------------
	//constructor that makes the database connection using variables from config.
	function __construct(){
		$this->$dbConn = mysqli_connect(DB_HOST, DB_USER,DB_PASS,DB_NAME, DB_PORT);
	}
	//<editor-fold defaultstate="collapsed" desc="Event Handling">
	/**
	 * @param int $courseid is the id of the 
	 * @param DateTime $dateTime time when item is due.
	 * @param string $title will be the caption
	 * @param string $description
	 * @param int $typeid the type of event type.
	 */
	function addEvent($courseid,$dateTime,$title = 'event',$description = 'event description',$typeid = 1){
	}
   /**
	 * @param int $eventId the id of the event in question.
	 * @return Event The event object if it exists | or null
	 */
	function getEventById($eventId){
		if (!isset($eventId)){ /*$this->lastError = "eventId passed to getEventById method was not set."; */ return null; }
		$query = "SELECT * FROM ".Api::$tbl_Events." WHERE `event_id`='".  mysqli_real_escape_string($eventId)."'";
		//failure is the fault of the developer. kill the entire program if a query fails.
		$mysqli_result = mysqli_query($dbConn, $query) or die(mysqli_error($dbConn));
		$mysqli_arr = mysqli_fetch_array($mysqli_result) or die(mysqli_error($dbConn));
		if (!isset($mysqli_arr)){return null;}else{ $row = mysqli_fetch_row($mysqli_arr) or die(mysqli_error($dbConn));}
		if (!isset($row)){return null;}else{ 
			// $courseId = -1, $typeId = -1,$dateTime = null,$title = 'event', $description = 'desc'){
			$event = new Event($row['course_id'], $row['type_id'], $row['time'], $row['title'], $row['description']);
			$event->setEventId($row['event_id']);
			return $event;
		}
		return null;//if not found.
	}
	//</editor-fold>
}
//</editor-fold>
//------------------------------------------------------------------------------
// S U B _ C L A S S E S _ G O _ B E N E A T H _ T H I S _ S E C T I O N 
//------------------------------------------------------------------------------
//<editor-fold defaultstate="collapsed" desc="Event Object">
class Event implements JsonSerializable{
	private $eventId = -1;
	private $courseId = -1;
	private $dateTime;
	private $title = 'event';
	private $desc = 'event description';
	private $typeId = 1;
	/**
	 * Create a new event Object to be used.
	 * @param int $courseid is the id of the 
	 * @param DateTime $dateTime time when item is due.
	 * @param string $title will be the caption
	 * @param string $description
	 * @param int $typeid the type of event type.
	 */
	function __construct( $courseId = -1, $typeId = -1,$dateTime = null,$title = 'event', $description = 'desc'){
		$this->courseId = $courseId;
		$this->dateTime = $dateTime;
		$this->title = $title;
		$this->desc = $description;
		$this->typeId = $typeId;
	}
	/** 
	 * 
	 * @param type $jsonStr should contain 
	 */
	public static function createEventFromJson($jsonStr){
		
	}
	function getCourseId(){
		return $this->courseId;
	}
	/** @param int courseId 
	 * @return Event for use in chain coding.**/
	function setCourseId($courseId){
		$this->courseId = $courseId;
		return $this;
	}
	/** @return int id (in the database) of the event. Will return -1 if it
	 * does not exist.	 */
	public function getEventId() {
		return $this->eventId;
	}
	/** @param int eventId 
	 * @return Event for use in chain coding.**/
	public function setEventId($eventId) {
		$this->eventId = $eventId;
		return $this;
	}
	/** 
	 * @return DateTime 
	 */
	public function getDateTime() {
		return $this->dateTime;
	}
	/** @param int courseId 
	 * @return Event for use in chain coding.**/
	public function setDateTime($dateTime) {
		$this->dateTime = $dateTime;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getDesc() {
		return $this->desc;
	}

	public function setDesc($desc) {
		$this->desc = $desc;
	}

	public function getTypeId() {
		return $this->typeId;
	}

	public function setTypeId($typeId) {
		$this->typeId = $typeId;
	}

	public function jsonSerialize() {
		$data = array();
		$data['event_id'] = $this->eventId;
		$data['course_id'] = $this->courseId;
		$data['time'] = $this->dateTime;
		$data['description'] = $this->desc;
		$data['type_id'] = $this->typeId;
		return $data;
	}
	
}
//</editor-fold>
?>
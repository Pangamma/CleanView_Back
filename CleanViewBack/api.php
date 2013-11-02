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
	require_once('event.php');										#
	require_once('school.php');										#
	require_once('user.php');										#
	require_once('course.php');										#
#####################################################################
//<editor-fold defaultstate="collapsed" desc="Api">
class Api{
	private static $tbl_Courses = 'courses';
	private static $tbl_Enrollments = 'enrollments';
    private static $tbl_Events = 'events';
    private static $tbl_Schools = 'schools';
    private static $tbl_Users = 'users';
    
	
    public static $error_prefix = 'Error : ';
	private $dbConn;
	//--------------------------------------------------------------------------
	//constructor that makes the database connection using variables from config.
	function __construct(){
		$this->dbConn = mysqli_connect(DB_HOST, DB_USER,DB_PASS,DB_NAME, DB_PORT);
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
	 *///fixed a weird sanitation glitch. (There has got to be a better and shorter way to sanitize our data. )
	function getEventById($eventId){
		if (!isset($eventId)){ /*$this->lastError = "eventId passed to getEventById method was not set."; */ return null; }
		$query = "SELECT * FROM ".Api::$tbl_Events." WHERE `event_id`='".  mysqli_real_escape_string($this->dbConn,$eventId)."'";
		//failure is the fault of the developer. kill the entire program if a query fails.
		$mysqli_result = mysqli_query($this->dbConn, $query) or die(mysqli_error($this->dbConn));
		$row = mysqli_fetch_array($mysqli_result) or die(mysqli_error($this->dbConn));
		if (isset($row)){ 
			// $courseId = -1, $typeId = -1,$dateTime = null,$title = 'event', $description = 'desc'){
			$event = new Event($row['course_id'], $row['type_id'], $row['time'], $row['title'], $row['description']);
			$event->setEventId($row['event_id']);
			return $event;
		}
		return null;//if not found.
	}
	function getSchoolById($schoolId) {
		if (! isset ( $schoolId )) {
			return null;
		}
		
		$query = "SELECT * FROM " . Api::$tbl_Schools . " WHERE `school_id`=" . mysqli_real_escape_string ( $this->dbConn, $schoolId );
		$mysqli_result = mysqli_query ( $this->dbConn, $query ) or die ( mysqli_error ( $this->dbConn ) );
		$row = mysqli_fetch_row ( $mysqli_result ) or die ( mysqli_error ( $this->dbConn ) );
		if (! isset ( $row )) {
			return null;
		} else {
			return School::createFromTableRow ( $row );
		}
	}
	function getCourseById($courseId) {
		if (! isset ( $courseId )) {
			return null;
		}
		
		$query = "SELECT * FROM " . Api::$tbl_Courses . " WHERE `course_id`=" . mysqli_real_escape_string ( $this->dbConn, $courseId );
		$mysqli_result = mysqli_query ( $this->dbConn, $query ) or die ( mysqli_error ( $this->dbConn ) );
		$row = mysqli_fetch_row ( $mysqli_result ) or die ( mysqli_error ( $this->dbConn ) );
		if (! isset ( $row )) {
			return null;
		} else {
			return Course::createFromTableRow ( $row );
		}
	}
	function getUserById($userId) {
		if (! isset ( $userId )) {
			return null;
		}
		
		$query = "SELECT * FROM " . Api::$tbl_Users . " WHERE `user_id`=" . mysqli_real_escape_string ( $this->dbConn, $userId );
		$mysqli_result = mysqli_query ( $this->dbConn, $query ) or die ( mysqli_error ( $this->dbConn ) );
		$row = mysqli_fetch_row ( $mysqli_arr ) or die ( mysqli_error ( $this->dbConn ) );
		if (! isset ( $row )) {
			return null;
		} else {
			return User::createFromTableRow ( $row );
		}
	}
	function getUsers() {
		$query = "SELECT * FROM " . Api::$tbl_Users;
		$mysqli_result = mysqli_query ( $this->dbConn, $query ) or die ( mysqli_error ( $this->dbConn ) );
		$usersList = array ();
		while ( $row = mysqli_fetch_row ( $mysqli_result ) ) {
			$usersList [] = User::createFromTableRow ( $row );
		}
		return $usersList;
	}
	function getCourses() {
		$query = "SELECT * FROM " . Api::$tbl_Courses;
		$mysqli_result = mysqli_query ( $this->dbConn, $query ) or die ( mysqli_error ( $this->dbConn ) );
		$coursesList = array ();
		while ( $row = mysqli_fetch_row ( $mysqli_result ) ) {
			$coursesList [] = Course::createFromTableRow ( $row );
		}
		return $coursesList;
	}
	function getSchools() {
		$query = "SELECT * FROM " . Api::$tbl_Schools;
		$mysqli_result = mysqli_query ( $this->dbConn, $query ) or die ( mysqli_error ( $this->dbConn ) );
		$schoolsList = array ();
		while ( $row = mysqli_fetch_row ( $mysqli_result ) ) {
			$schoolsList [] = School::createFromTableRow ( $row );
		}
		return $schoolsList;
	}
}
// </editor-fold>
?>

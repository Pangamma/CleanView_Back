<?php

#####################################################################
# 	       D O C U M E N T _ S U M M A R Y							#
#####################################################################
# The api will contain a number of methods to be used by the front	#
# end design team. config.php will specify constants or other		#
# variables that can be used with the software we are making. 		#
#####################################################################
#	I N C L U D E _ R E S O U R C E S								#
// require_once('../config.php');           						#
require_once('secure/init_variables.php');	  #
require_once('event.php');		  #
require_once('school.php');		  #
require_once('user.php');		  #
require_once('course.php');		  #
require_once('models/Table.php');
require_once('../config.php');	#
#####################################################################
class Api {
	private static $tbl_Courses = 'courses';
	private static $tbl_Enrollments = 'enrollments';
	private static $tbl_Events = 'events';
	private static $tbl_Schools = 'schools';
	private static $tbl_Users = 'users';
	
	public static $e_invalid_request = "Invalid Request.";
	public static $e_bad_query = "Something went wrong in the query";
	public static $e_prefix = 'Error : ';
	private $dbConn;

	//--------------------------------------------------------------------------
	//constructor that makes the database connection using variables from config.
	function __construct() {
		$this->dbConn = new Table(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
	}

	//<editor-fold defaultstate="collapsed" desc="add event">
	/**
	 * @param int $courseid is the id of the 
	 * @param DateTime $dateTime time when item is due.
	 * @param string $title will be the caption
	 * @param string $description
	 * @param int $typeid the type of event type.
	 */
	function addEventByParams($courseid, $dateTime, $title = 'event', $description = 'event description', $typeid = 1) {
		
	}
	/**
	 * Add a configured event object as a new object in the database.
	 * any previous event_id value will be ignored, so just create your event
	 * and then don't worry about the title.
	 * @param Event $event
	 */
	function addEventByObject($event) {
		if (!isset($event) || $event->getEventId() != -1){
			return "Event object is invalid.";
		}
		$query = "INSERT INTO `".Api::$tbl_Events."` (`title`, `description`, `type_id`, `time`, `course_id`) VALUES (':title', ':description', :type_id, ':time', :course_id)";
		$params = array(
			":title" => $event->getTitle(),
			":description" => $event->getDesc(),
			":type_id" => $event->getTypeId(),
			":time" => $event->getDateTime(),
			":eventId" => $event->getEventId(),
			":desc" => $event->getDesc(),
			":courseId" => $event->getCourseId(),
			":deleted" => ($event->isDeleted() ? 1 : 0)
		);
		
	}
	//</editor-fold>
	////<editor-fold defaultstate="collapsed" desc="update event">
	/**
	 * Pass in an event object with complete information. The event will be 
	 * updated into the database. Make sure the event ID is correct and set, 
	 * otherwise this will not work.
	 * @param Event $event
	 */
	function updateEventByObject(Event $event){
		if (!isset($event) || $event->getEventId() == -1){
			return "Event does not exist. You must create it before you can update it.";
		}
		$query = "UPDATE `".Api::$tbl_Events."` SET `title`=':title',"
			."description=':desc',type_id=:type_id,`time`=':time',"
			."course_id=:courseId,`deleted`=:deleted WHERE `event_id`=:eventId";
		$params = array(
			":eventId" => $event->getEventId(),
			":title" => $event->getTitle(),
			":desc" => $event->getDesc(),
			":type_id" => $event->getTypeId(),
			":time" => $event->getDateTime(),
			":courseId" => $event->getCourseId(),
			":deleted" => ($event->isDeleted() ? 1 : 0)
		);
		$results = $this->dbConn->execute($query, $params);
		if (!$results){
			return Api::$e_bad_query;
		}else{
			return "Success!";
		}
		
	}
	////</editor-fold>
	//<editor-fold defaultstate="collapsed" desc="getEventById">
	/**
	 * @param int $eventId the id of the event in question.
	 * @return Event The event object if it exists | or error message string.**/
	function getEventById($eventId) {
		if (!isset($eventId)) {
			//TODO: return proper errors like 403 and 400
			return Api::$e_invalid_request;
		}
		//unsure if query works unable to test
		$query = "SELECT * FROM " . Api::$tbl_Events . " WHERE event_id = :eventId";
		$queryParams = array(
			":eventId" => $eventId
		);
		$results = $this->dbConn->execute($query, $queryParams);
		if (!$results)
			return "Something went wrong in the query";
		if ($row = $results->fetch()) {
			$event = Event::createFromTableRow($row);
			return $event;
		}
		return "event not found"; //event not found
	}
	//</editor-fold>
	//<editor-fold defaultstate="collapsed" desc="getSchoolById">
	function getSchoolById($schoolId) {
		if (!isset($schoolId)) {
			return null;
		}

		$query = "SELECT * FROM " . Api::$tbl_Schools . " WHERE school_id= :schoolId";

		$params = array(
			":schoolId" => $schoolId
		);

		$results = $this->dbConn->execute($query, $params);

		if (!$results)
			return "Sometime went wrong in the query";

		if (!$row = $results->fetch()) {
			return null;
		} else {
			return School::$createFromTableRow($row);
		}
	}
	//</editor-fold>
	//<editor-fold defaultstate="collapsed" desc="getSchools">
	function getSchools() {
		$query = "SELECT * FROM " . Api::$tbl_Schools;
		$results = $this->dbConn->execute($query, $params);
		$schoolsList = array();
		while ($row = $results->fetch()) {
			$schoolsList [] = School::createFromTableRow($row);
		}
		return $schoolsList;
	}
	//</editor-fold>
	//<editor-fold defaultstate="collapsed" desc="getCourseById">
	function getCourseById($courseId) {
		if (!isset($courseId)) {
			return null;
		}

		$query = "SELECT * FROM " . Api::$tbl_Courses . " WHERE course_id= :courseId";
		$params = array(
			":courseId" => $courseId
		);

		$results = $this->dbConn->execute($query, $params);

		if (!$results)
			return "Sometime went wrong in the query";

		if (!$row = $results->fetch()) {
			return null;
		} else {
			return Course::createFromTableRow($row);
		}
	}
	//</editor-fold>
	//<editor-fold defaultstate="collapsed" desc="getCourses">
	function getCourses() {
		$query = "SELECT * FROM " . Api::tbl_Courses;
		$results = $this->dbConn->execute($query, $params);
		$coursesList = array();
		while ($row = $results->fetch()) {
			$coursesList [] = Course::createFromTableRow($row);
		}
		return $coursesList;
	}
	//</editor-fold>
	//<editor-fold defaultstate="collapsed" desc="getUserById">
	function getUserById($userId) {
		if (!isset($userId)) {
			return null;
		}

		$query = "SELECT * FROM " . Api::$tbl_Users . " WHERE user_id= :userId";
		$params = array(
			":userId" => $userId
		);

		$results = $this->dbConn->execute($query, $params);

		if (!$results)
			return "Sometime went wrong in the query";

		if (!$row = $results->fetch()) {
			return null;
		} else {
			return User::createFromTableRow($row);
		}
	}
	//</editor-fold>
	//<editor-fold defaultstate="collapsed" desc="getUsers">
	function getUsers() {
		$query = "SELECT * FROM " . Api::$tbl_Users;
		$results = $this->dbConn->execute($query, $params);
		$usersList = array();
		while ($row = $results->fetch()) {
			$usersList [] = User::createFromTableRow($row);
		}
		return $usersList;
	}
	//</editor-fold>
	
	
	function addCourse($courseJson) {
		if (!isset($courseJson)) {
			return null;
		}
	
		$query = "INSERT INTO ".Api :: $tbl_Courses." (name, school_id, year, quarter, section, sln) VALUES (:name, :school_id, :year, :quarter, :section, :sln)";
		$params = array(
				":name" => $courseJson ['name'],
				":school_id" => $courseJson ['school_id'],
				":year" => $courseJson ['year'],
				":quarter" => $courseJson ['quarter'],
				":section" => $courseJson ['section'],
				":sln" => $courseJson ['sln'],
		);
		
		$this->dbConn->execute($query, $params);
	}
	
	function deleteCourse($courseId) {
		if (!isset($courseId)) {
			return null;
		}

		$query = "DELETE FROM " . Api::$tbl_Courses . " WHERE course_id= :courseId";
		$params = array(
			":courseId" => $courseId
		);

		$this->dbConn->execute($query, $params);
	}
	
	function editCourse($courseJson) {
		if (!isset($courseJson)) {
			return null;
		}
	
		$query = "UPDATE ".Api :: $tbl_Courses." SET (name=:name, school_id=:school_id, year=:year, quarter=:quarter, section=:section, sln=:sln) WHERE course_id= :course_id";
		$params = array(
				":name" => $courseJson ['name'],
				":school_id" => $courseJson ['school_id'],
				":year" => $courseJson ['year'],
				":quarter" => $courseJson ['quarter'],
				":section" => $courseJson ['section'],
				":sln" => $courseJson ['sln'],
				":course_id" => $courseJson ['course_id']
		);
		
		$this->dbConn->execute($query, $params);
	}
}
?>
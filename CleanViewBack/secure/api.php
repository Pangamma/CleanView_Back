<?php

#####################################################################
# 	       D O C U M E N T _ S U M M A R Y							#
#####################################################################
# The api will contain a number of methods to be used by the front	#
# end design team. config.php will specify constants or other		#
# variables that can be used with the software we are making. 		#
#####################################################################
#	I N C L U D E _ R E S O U R C E S								#
require_once('../config.php');	#//relative to file calling it...?
require_once('event.php');		  #
require_once('school.php');		  #
require_once('user.php');		  #
require_once('course.php');		  #
require_once('models/Table.php');
#####################################################################
class Api {
	private static $TBL_COURSES = 'courses';
	private static $TBL_ENROLLMENTS = 'enrollments';
	private static $TBL_EVENTS = 'events';
	private static $TBL_SCHOOLS = 'schools';
	private static $TBL_USERS = 'users';
	private static $TBL_USER_GROUPS = "user_groups";
	public static $E_INVALID_REQUEST = "Invalid Request.";
	public static $E_BAD_QUERY = "Something went wrong in the query";
	public static $E_PREFIX = 'Error : ';
	private /*Table*/ $dbConn;
	private /*boolean*/$isLoggedIn; function isLoggedIn(){return $this->isLoggedIn;}
	private /*User*/ $user;
	private $isConnected = false;//current user who is logged in.

	//--------------------------------------------------------------------------
	//constructor that makes the database connection using variables from config.
	/**
	 * @param boolean $connectInConstructor automatically connect to the database?
	 * This should be left as true unless you know what you are doing. 
	 * We might even want to remove it. Idk. Still trying to decide.
	 */
	function __construct($connectInConstructor = true) {
		session_start();
		if ($connectInConstructor){
			$this->connectToDatabase();
			//can we count on session data, or do we need to recalculate our values?
			$this->isLoggedIn = $this->loadPreExistingLogin();
		}
	}
	//<editor-fold defaultstate="collapsed" desc="login/logout">
	function connectToDatabase(){
		$this->dbConn = new Table(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
		$this->isConnected = true;
	}
	/**
	 * loads in login data from session data if it exists. If it does not exist,
	 * method will check for cookie data if it matches what is found in the db.
	 * @return boolean whether API was able to use pre-existing login data to
	 * automatically log-in as the current user.
	 */
	function loadPreExistingLogin(){
		$isLoggedIn = (isset($_SESSION['loggedin']) && $_SESSION['loggedin']);
		if (!$isLoggedIn){
			//session data is out. Do they have cookie data we can use?
			if (isset($_COOKIE['user']) && isset($_COOKIE['pass'])){
				//assume that if they had a cookie, they selected "rememberme"
				//in a past transaction.
				return ($this->login($_COOKIE['user'],$_COOKIE['pass'],true,true) == true);
			}
		}else{
			//if logged in, assume this data is stored in a session already.
			if (isset($_SESSION['userJson'])){
				$this->user = User::createFromJson($_SESSION['userJson']);
				if ($this->user != null){
					return true;
				}
			}else{
				echo $_SESSION['userJson'];
				//make them reauthenticate... 
				$_SESSION['loggedin'] = false;
				if (isset($_COOKIE['user']) && isset($_COOKIE['pass'])){
					return ($this->login($_COOKIE['user'],$_COOKIE['pass'],true,true) === true);
				}else{
					return false;
				}
			}
		}
		return false;
	}
	/** 
	 * pass in the username and password for the user to be logged in. 
	 * @param string $user username
	 * @param string $pass password 
	 * @param boolean $rememberMe false by default. If set to true, it will store username and a login hash to a cookie so that
	 * @param boolean $preHashed false by default. only set to true if you are logging in from values stored in a user's cookie.
	 * it may be loaded as a saved login later.
	 * @return boolean|string
	 */
	function login($user,$pass,$rememberMe = false,$preHashed = false){
//		if (!isset($user) || !isset($pass)){return false;}
//		$query = "SELECT * FROM ".Api::$TBL_USERS." WHERE `username`=':user'";
//		$queryParams = array(":user" => $user);
//		$results = $this->dbConn->execute($query, $queryParams);
		
		$results = $this->dbConn->execute("SELECT * FROM `users`");
		if (!$results)
			echo "Something went wrong in the query";
		$row = $results->fetch();
		if ($row) {
			$salt = $row['salt'];
				$hash = ($preHashed) ? $pass : hash("sha256",$pass.$salt,false);
				if ($row['password_hash'] == $hash){
					$this->isLoggedIn = true;
					$this->user = User::createFromTableRow($row);
					$_SESSION['loggedin'] = true;				
					$_SESSION['username'] = $row['username'];
					$_SESSION['userJson'] = json_encode($this->user);
					//so they do not have to keep logging into our site.
					if ($rememberMe){
						setcookie("user",$user);
						setcookie("pass",$row['password_hash']);
					}
					return true;
				}
				return false;
		}
		return false;
		//how do we know if there are NO results?
	}
	function logout(){
		$_SESSION['loggedin'] = false;
		$_SESSION['userJson'] = null;				
		$_SESSION['username'] = null;
		//so they do not have to keep logging into our site.
		setcookie("user",null);
		setcookie("pass",null);
		$this->isLoggedIn = false;
		$this->user = null;
	}
	//</editor-fold>
	//<editor-fold defaultstate="collapsed" desc="add event">
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
		$query = "INSERT INTO `".Api::$TBL_EVENTS."` (`title`, `description`, `type_id`, `time`, `course_id`) VALUES (':title', ':description', :type_id, ':time', :course_id)";
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
		$query = "UPDATE `".Api::$TBL_EVENTS."` SET `title`=':title',"
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
			return Api::$E_BAD_QUERY;
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
			return Api::$E_INVALID_REQUEST;
		}
		//unsure if query works unable to test
		$query = "SELECT * FROM " . Api::$TBL_EVENTS . " WHERE event_id = :eventId";
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
	//<editor-fold defaultstate="collapsed" desc="getEvents">
	function getEvents($userId, $startTime = null, $endTime = null, $courseIds = null, $eventTypeIds = null){
		
	}
	//</editor-fold>
	//<editor-fold defaultstate="collapsed" desc="getSchoolById">
	function getSchoolById($schoolId) {
		if (!isset($schoolId)) {
			return null;
		}

		$query = "SELECT * FROM " . Api::$TBL_SCHOOLS . " WHERE school_id= :schoolId";

		$params = array(
			":schoolId" => $schoolId
		);

		$results = $this->dbConn->execute($query, $params);

		if (!$results)
			return "Sometime went wrong in the query";

		if (!$row = $results->fetch()) {
			return null;
		} else {
			return School::createFromTableRow($row);
		}
	}
	//</editor-fold>
	//<editor-fold defaultstate="collapsed" desc="getSchools">
	function getSchools() {
		$query = "SELECT * FROM " . Api::$TBL_SCHOOLS;
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

		$query = "SELECT * FROM " . Api::$TBL_COURSES . " WHERE course_id= :courseId";
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
	/**
	 * 
	 * @return Course[]
	 */
	function getCourses() {
		$query = "SELECT * FROM " . Api::$TBL_COURSES;
		$results = $this->dbConn->execute($query);
		$coursesList = array();
		while ($row = $results->fetch()) {
			$coursesList [] = Course::createFromTableRow($row);
		}
		return $coursesList;
	}
	
	/**
	 *
	 * @return Course[]
	 */
	function searchCoursesByNameOrTitle($search_query) {
		$query = "SELECT * FROM " . Api::$TBL_COURSES. " WHERE `name` LIKE concat('%',:search_query,'%') OR `title` LIKE concat('%',:search_query,'%')";
		
		$params = array(
				":search_query" => $search_query
		);
		
		$results = $this->dbConn->execute($query, $params);
		$coursesList = array();
		while ($row = $results->fetch()) {
			$coursesList [] = Course::createFromTableRow($row);
		}
		return $coursesList;
	}
	
	function searchSchoolByName($search_query) {
		$query = "SELECT * FROM " . Api::$TBL_SCHOOLS. " WHERE `name` LIKE concat('%',:search_query,'%')";
	
		$params = array(
				":search_query" => $search_query
		);
	
		$results = $this->dbConn->execute($query, $params);
		$schoolsList = array();
		while ($row = $results->fetch()) {
			$schoolsList [] = School::createFromTableRow($row);
		}
		return $schoolsList;
	}
	
	//</editor-fold>
	//<editor-fold defaultstate="collapsed" desc="getUserById">
	function getUserById($userId) {
		if (!isset($userId)) {
			return null;
		}

		$query = "SELECT * FROM " . Api::$TBL_USERS . " WHERE user_id= :userId";
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
	/** 
	 * 
	 * @return User[] array of user objects.
	 */
	function getUsers() {
		$query = "SELECT * FROM " . Api::$TBL_USERS;
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
	
		$query = "INSERT INTO ".Api :: $TBL_COURSES." (name, school_id, year, quarter, section, sln) VALUES (:name, :school_id, :year, :quarter, :section, :sln)";
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

		$query = "DELETE FROM " . Api::$TBL_COURSES . " WHERE course_id= :courseId";
		$params = array(
			":courseId" => $courseId
		);

		$this->dbConn->execute($query, $params);
	}
	
	function editCourse($courseJson) {
		if (!isset($courseJson)) {
			return null;
		}
	
		$query = "UPDATE ".Api :: $TBL_COURSES." SET (name=:name, school_id=:school_id, year=:year, quarter=:quarter, section=:section, sln=:sln) WHERE course_id= :course_id";
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
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
	require_once('./secure/init_variables.php');						#
	require_once('./event.php');										#
	require_once('./models/table.php');
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
		//this should prorably be done with composition
		$this->dbConn = new Table($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
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
		if (!isset($eventId)){ /*$this->lastError = "eventId passed to getEventById method was not set."; */ 
			//TODO: return proper errors like 403 and 400
			return "invaild request"; 
		}
		
		//unsure if query workds unable to test
		$query = "SELECT * FROM events WHERE event_id = :eventId";
		
		$queryParams = array(
				":eventId" => $eventId
		);

		$results = $this->dbConn->execute($query, $queryParams);

		if(!$results){
			//error kill process
			return "Sometime went wrong in the query";
		}
		echo $results->rowCount();
		//we fetch because eventIds must be unique
		if($eventData = $results->fetch(PDO::FETCH_ASSOC)){
			$event = new Event($eventData['course_id'], $eventData['type_id'], $eventData['time'], $eventData['title'], $eventData['description']);
			$event->setEventId($eventData['event_id']);
			return $event;
		}

		return "event not found"; //event not found

	}
	//</editor-fold>
}
//</editor-fold>
?>
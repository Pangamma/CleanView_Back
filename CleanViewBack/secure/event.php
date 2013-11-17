<?php
require_once('rowobject.php');
class Event implements RowObject{
	private $eventId = -1;
	private $courseId = -1;
	private $time;
	private $title = 'event';
	private $desc = 'event description';
	private $typeId = 1;
	private $deleted = 0;
	/**
	 * Create a new event Object to be used.
	 * @param int $courseid is the id of the
	 * @param int $courseid is the id of the event.
	 * @param int $time UNIX time when event is due.
	 * @param string $title will be the caption
	 * @param string $description
	 * @param int $typeid the type of event type.
	 * @param boolean $deleted true/false. Is the event visible to users?
	 */
	function __construct($courseId, $time, $title, $description, $eventId = -1, $typeId = 0, $deleted = 0){
		$this->eventId = $eventId;
		$this->courseId = $courseId;
		$this->time = $time;
		$this->title = $title;
		$this->desc = $description;
		$this->typeId = $typeId;
		$this->deleted = $deleted;
		
	}
	public static function createFromJson($json) {
		return new self ( $json ['course_id'], $json ['time'], $json['title'],$json ['description'],$json ['event_id'], $json ['type_id'] ,$json['deleted'] );
	}
	public static function createFromTableRow($row) {
		return new self ( $row ['course_id'], $row ['time'], $row['title'],$row ['description'],$row ['event_id'], $row ['type_id'] ,$row['deleted'] );
	}
	//<editor-fold defaultstate="collapsed" desc="accessors">
	function getCourseId(){
		return $this->courseId;
	}
	/** @param int courseId
	 * @return \Event for use in chain coding.**/
	function setCourseId($courseId){
		$this->courseId = $courseId;
		return $this;
	}
	/** @return int id (in the database) of the event. Will return -1 if it
	 * does not exist.	 */
	public function getEventId() {
		return $this->eventId;
	}
	/**
	 * @return DateTime
	 */
	public function getDateTime() {
		$dateTime = new DateTime();
		$dateTime->setTimestamp($this->time);
		return $dateTime;
	}	
	/**
	 * @return int number of seconds based on unix time.
	 */
	public function getUnixTime() {
		return $this->time;
	}
	/** @param DateTime $dateTime
	 * @return \Event for use in chain coding.**/
	public function setDateTimeByObject($dateTime) {
		$this->time = $dateTime->getTimestamp();
		return $this;
	}
	/** 
	 * Set the time and date of this item's start time.
	 * @param int $year YYYY
	 * @param int $month MM
	 * @param int $day DD
	 * @param int $hour HH 24 hour format
	 * @param int $minute MM
	 * @return \Event for use in chain coding. 
	 */
	public function setDateTime(int $year,int $month,int $day,int $hour,int $minute) {
		$date = new DateTime();
		$date->setDate($year, $month, $day);
		$date->setTime($hour, $minute, 0);
		$this->time = $date->getTimestamp();
		return $this;
	}
	public function getTitle() {
		return $this->title;
	}
	/**
	 * set the name of this event.
	 * @param string $title
	 * @return \Event for use in chain coding.
	 */
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}

	public function getDesc() {
		return $this->desc;
	}
	/**
	 * set description of event.
	 * @param string $desc
	 * @return Event for use in chain coding.
	 */
	public function setDesc($desc) {
		$this->desc = $desc;
		return $this;
	}
	/** 
	 * @param boolean $bool
	 * @return Event
	 */
	public function setDeleted($bool) {
		$this->deleted = $bool;
		return $this;
	}
	public function isDeleted() {
		return ($this->deleted == 1);
	}
	public function getTypeId() {
		return $this->typeId;
	}
	/**
	 * 
	 * @param int $typeId
	 * @return Event 
	 */
	public function setTypeId($typeId) {
		$this->typeId = $typeId;
		return $this;
	}
	//</editor-fold>
	public function jsonSerialize() {
		$data = array();
		$data['event_id'] = $this->eventId;
		$data['course_id'] = $this->courseId;
		$data['time'] = $this->time;
		$data['description'] = $this->desc;
		$data['type_id'] = $this->typeId;
		$data['deleted'] = $this->deleted;
		return $data;
	}

}

?>
<?php
require_once('rowobject.php');
class Event implements RowObject{
	private $eventId = -1;
	private $courseId = -1;
	private $dateTime;
	private $title = 'event';
	private $desc = 'event description';
	private $typeId = 1;
	private $deleted = 0;
	/**
	 * Create a new event Object to be used.
	 * @param int $courseid is the id of the
	 * @param int $courseid is the id of the event.
	 * @param DateTime $dateTime time when item is due.
	 * @param string $title will be the caption
	 * @param string $description
	 * @param int $typeid the type of event type.
	 * @param boolean $deleted true/false. Is the event visible to users?
	 */
	function __construct($eventId, $courseId, $dateTime, $title, $description, $typeId = 0, $deleted = 0){
		$this->eventId = $eventId;
		$this->courseId = $courseId;
		$this->dateTime = $dateTime;
		$this->title = $title;
		$this->desc = $description;
		$this->typeId = $typeId;
		$this->deleted = $deleted;
		
	}
	public static function createFromJson($json) {
		return new self ($json ['event_id'], $json ['course_id'], $json ['time'], $json['title'],$json ['description'], $json ['type_id'] ,$json['deleted'] );
	}
	public static function createFromTableRow($row) {
		return new self ($row ['event_id'], $row ['course_id'], $row ['time'], $row['title'],$row ['description'], $row ['type_id'] ,$row['deleted'] );
	}
	//<editor-fold defaultstate="collapsed" desc="accessors">
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
	/** @param DateTime $dateTime
	 * @return Event for use in chain coding.**/
	public function setDateTimeByObject($dateTime) {
		$this->dateTime = $dateTime;
		return $this;
	}/**
	public function setDateTime(int $year,int $month,int $day,int $hour,int $minute) {
		$date =new DateTime();
		$date->setDate($year, $month, $day);
		$this->dateTime = $dateTime;
	}
	**/
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
	public function setDeleted($bool) {
		$this->deleted = $bool;
	}
	public function isDeleted() {
		return ($this->deleted == 1);
	}
	public function getTypeId() {
		return $this->typeId;
	}

	public function setTypeId($typeId) {
		$this->typeId = $typeId;
	}
	//</editor-fold>
	public function jsonSerialize() {
		$data = array();
		$data['event_id'] = $this->eventId;
		$data['course_id'] = $this->courseId;
		$data['time'] = $this->dateTime;
		$data['description'] = $this->desc;
		$data['type_id'] = $this->typeId;
		$data['deleted'] = $this->deleted;
		return $data;
	}

}

?>
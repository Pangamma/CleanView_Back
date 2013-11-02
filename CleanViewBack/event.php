<?php

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

?>
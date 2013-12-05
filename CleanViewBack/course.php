<?php
require_once('rowobject.php');
class Course implements RowObject {
	private $courseId;
	private $schoolId;
	private $title;
	private $name;
	private $section;
	private $year;
	private $quarter;
	private $instructor;
	private $sln;
	
	function __construct($courseId, $schoolId, $title, $name, $section, $year, $quarter, $instructor) {
		$this->courseId = $courseId;
		$this->schoolId = $schoolId;
		$this->title = $title;
		$this->name = $name;
		$this->section = $section;
		$this->year = $year;
		$this->quarter = $quarter;
		$this->instructor = $instructor;
	}
	
	
	public static function createFromJson($json) {
		return new self ( $json ['courseId'], $json ['schoolId'], $json ['title'], $json ['name'], $json ['section'], $json ['year'], $json ['quarter'], $json ['instructor'], $json ['sln'] );
	}
	
	public static function createFromTableRow($row) {
		return new self ( $row ['course_id'], $row ['school_id'], $row ['title'], $row ['name'], $row ['section'], $row ['year'], $row ['quarter'], $row ['instructor'] );
	}
	
	public function jsonSerialize() {
		$data = array ();
		$data ['course_id'] = $this->courseId;
		$data ['school_id'] = $this->schoolId;
		$data ['title'] = $this->title;
		$data ['name'] = $this->name;
		$data ['section'] = $this->section;
		$data ['year'] = $this->year;
		$data ['quarter'] = $this->quarter;
		$data ['instructor'] = $this->instructor;
		$data ['sln'] = $this->sln;//we're throwing this out, remember?
		
		return $data;
	}
	//<editor-fold defaultstate="collapsed" desc="access">
	public function getCourseId() {
		return $this->courseId;
	}

	public function setCourseId($courseId) {
		$this->courseId = $courseId;
	}

	public function getSchoolId() {
		return $this->schoolId;
	}

	public function setSchoolId($schoolId) {
		$this->schoolId = $schoolId;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getSection() {
		return $this->section;
	}

	public function setSection($section) {
		$this->section = $section;
	}

	public function getYear() {
		return $this->year;
	}

	public function setYear($year) {
		$this->year = $year;
	}

	public function getQuarter() {
		return $this->quarter;
	}

	public function setQuarter($quarter) {
		$this->quarter = $quarter;
	}

	public function getInstructor() {
		return $this->instructor;
	}

	public function setInstructor($instructor) {
		$this->instructor = $instructor;
	}

	public function getSln() {
		return $this->sln;
	}

	public function setSln($sln) {
		$this->sln = $sln;
	}

		//</editor-fold>
}

?>

<?php
class Course implements JsonSerializable {
	private $courseId;
	private $schoolId;
	private $title;
	private $name;
	private $section;
	private $year;
	private $quarter;
	private $instructor;
	private $sln;
	
	function __construct($courseId, $schoolId, $title, $name, $section, $year, $quarter, $instructor, $sln) {
		$this->courseId = $courseId;
		$this->schoolId = $schoolId;
		$this->title = $title;
		$this->name = $name;
		$this->section = $section;
		$this->year = $year;
		$this->quarter = $quarter;
		$this->instructor = $instructor;
		$this->sln = $sln;
	}
	
	
	public static function createFromJson($json) {
		return new self ( $json [courseId], $json [schoolId], $json [title], $json [$name], $json [section], $json [year], $json [quarter], $json [instructor], $json [sln] );
	}
	
	public static function createFromTableRow($row) {
		return new self ( $row [0], $row [1], $row [2], $row [3], $row [4], $row [5], $row [6], $row [7], $row [8] );
	}
	
	public function jsonSerialize() {
		$data = array ();
		$data ['courseID'] = $this->courseId;
		$data ['school_id'] = $this->schoolId;
		$data ['title'] = $this->title;
		$data ['name'] = $this->name;
		$data ['section'] = $this->section;
		$data ['year'] = $this->year;
		$data ['quarter'] = $this->quarter;
		$data ['instructor'] = $this->instructor;
		$data ['sln'] = $this->sln;
		
		return $data;
	}
	
}

?>

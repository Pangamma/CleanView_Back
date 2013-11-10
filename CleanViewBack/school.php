<?php
require_once('rowobject.php');
class School implements RowObject {
	private $schoolId;
	private $name;
	private $city;
	private $state;
	private $country;


	function __construct($schoolId,$name, $city, $state, $country) {
		$this->schoolId = $schoolId;
		$this->name = $name;
		$this->city = $city;
		$this->state = $state;
		$this->country = $country;
	}


	public static function createFromJson($json) {
		
		return new self ($json ['schoolId'], $json ['name'], $json ['city'], $json ['state'], $json ['country'] );
	}


	public static function createFromTableRow($row) {
	
		return new self ($row ['school_id'], $row ['name'], $row ['city'], $row ['state'], $row ['country'] );
	}
	
	public function jsonSerialize() {
		$data = array ();
		$data ['school_id'] = $this->schoolId;
		$data ['name'] = $this->name;
		$data ['city'] = $this->city;
		$data ['state'] = $this->state;
		$data ['country'] = $this->country;

		return $data;
	}
	
	//<editor-fold defaultstate="collapsed" desc="access">
	public function getSchoolId (){
		return $this ->schoolId;
	}
	
	public function setSchoolId($schoolId) {
		$this->schoolId = $schoolId;
	}
	
	public function getName (){
		return $this ->name;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	public function getCity (){
		return $this ->city;
	}
	
	public function setCity($city) {
		$this->city = $city;
	}
	
	public function getState (){
		return $this ->state;
	}
	
	public function setState($state) {
		$this->city = $state;
	}
	
	public function getCountry (){
		return $this ->country;
	}
	
	public function setCountry($country) {
		$this->country = $country;
	}
}

?>

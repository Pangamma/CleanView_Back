<?php
class School implements JsonSerializable {
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
		
		return new self ($json [schoolId], $json [$name], $json [city], $json [state], $json [country] );
	}


	public static function createFromTableRow($row) {
	
		return new self ($row [0], $row [1], $row [2], $row [3], $row [4] );
	}
	
	public function jsonSerialize() {
		$data = array ();
		$data ['school_id'] = $this->schoolId;
		$data ['name'] = $this->name;
		$data ['city'] = $this->city;
		$data ['state'] = $this->state;
		$data ['contry'] = $this->country;

		return $data;
	}
}

?>
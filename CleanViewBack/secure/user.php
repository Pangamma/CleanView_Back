<?php
require_once('rowobject.php');
class User implements RowObject {
	private $userId;
	private $firstName;
	private $lastName;
	private $email;
	function __construct($userId, $firstName, $lastName, $email) {
		$this->userId = $userId;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
	}
	/** 
	 * Will return a new object if the input is valid, or null if it isn't.
	 * @param string $jsonStr
	 * @return null|\self
	 */
	public static function createFromJson($jsonStr) {
		$json = json_decode($jsonStr,true);
		if (
				!isset($json['user_id']) 
				|| !isset($json ['first_name']) 
				|| !isset($json['last_name']) 
				|| !isset($json['email'])
		){
			return null;
		}else{
			return new self ( $json ['user_id'], $json ['first_name'], $json ['last_name'], $json ['email']);
		}
	}
	/** 
	 * Will return a new object if the input is valid, or null if it isn't.
	 * @param type $row
	 * @return null|\self
	 */
	public static function createFromTableRow($row) {
		if (!isset($row ['user_id']) || !isset($row ['first_name']) || !isset($row['last_name']) || !isset($row['email'])){
			return null;
		}else{
			return new self ($row ['user_id'], $row ['first_name'], $row ['last_name'], $row ['email']);
		}
	}


	public function jsonSerialize() {
		$data = array ();
		$data ['user_id'] = $this->userId;
		$data ['first_name'] = $this->firstName;
		$data ['last_name'] = $this->lastName;
		$data ['email'] = $this->email;

		return $data;
	}
	//<editor-fold defaultstate="collapsed" desc="accessors">
	public function getUserId() {
		return $this->userId;
	}
	public function setUserId($userId) {
		$this->userId = $userId;
	}
	public function getFirstName() {
		return $this->firstName;
	}
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}
	public function getLastName() {
		return $this->lastName;
	}
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}
}

?>

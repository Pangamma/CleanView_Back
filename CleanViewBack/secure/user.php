<?php
require_once('rowobject.php');
class User implements RowObject {
	private $userId;
	private $firstName;
	private $lastName;
	private $email;
	private $username;

	function __construct($userId, $firstName, $lastName, $email, $username) {
		$this->userId = $userId;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		$this->username = $username;
	}
	public static function createFromJson($json) {
		return new self ( $json ['userId'], $json ['firstName'], $json ['lastName'], $json ['email'], $json ['username']);
	}
	
	public static function createFromTableRow($row) {
	
		return new self ($row ['user_id'], $row ['first_name'], $row ['last_name'], $row ['email'], $row ['username'] );
	}


	public function jsonSerialize() {
		$data = array ();
		$data ['user_id'] = $this->userId;
		$data ['first_name'] = $this->firstName;
		$data ['last_name'] = $this->lastName;
		$data ['email'] = $this->email;
		$data ['username'] = $this->username;

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

	public function getUsername() {
		return $this->username;
	}

	public function setUsername($username) {
		$this->username = $username;
	}
}

?>

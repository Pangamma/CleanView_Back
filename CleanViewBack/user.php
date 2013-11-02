<?php
class User implements JsonSerializable {
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
		return new self ( $json [userId], $json [firstName], $json [lastName], $json [$email], $json [username]);
	}
	
	public static function createFromTableRow($row) {
	
		return new self ($row [0], $row [1], $row [2], $row [3], $row [4] );
	}


	public function jsonSerialize() {
		$data = array ();
		$data ['userID'] = $this->userId;
		$data ['firstName'] = $this->firstName;
		$data ['lastName'] = $this->lastName;
		$data ['email'] = $this->email;
		$data ['username'] = $this->username;

		return $data;
	}
}

?>
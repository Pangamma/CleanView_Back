<?php
require_once('rowobject.php');
class User implements RowObject {
	private $userData = array();

	function __construct($userId, $firstName, $lastName, $email, $username, $pass, $salt, $hash) {
		$userData["user_id"] 		= $userId;
		$userData["first_name"]	= $firstName;
		$userData["last_name"] 	= $lastName;
		$userData["email"]			= $email;
		$userData["username"]		= $username;
		
		//sudo constructor overloading
		$userData["hash"] = ( $hash ) ? $hash : hash("sha256",$pass.$salt,false);
		$userData["salt"] = ( $salt ) ? $salt : uniqid().uniqid();
	}


	/**
	*		delete user
	*		removes user from table
	*/
	public function deleteUser () {
		//stub
	}

	/**
	*	Update user
	*	@param	{userObject}	new user object
	*	values that evaluate falsy will be left as old
	*/
	public function updateUser ( $user ) {
		//iterate over this because objects cannot be called with [] notation
		foreach ($this as $key => $value ) {
			if ( $user[$key] ) $value = $user[$key];
		}

		return $this;
	}

	public static function createFromJson($json) {
		return new self ( $json ['userId'], $json ['firstName'], $json ['lastName'], $json ['email'], $json ['username'], $json['pass'], $json['salt']);
	}
	
	public static function createFromTableRow($row) {
		return new self ($row ['user_id'], $row ['first_name'], $row ['last_name'], $row ['email'], $row ['username'], $row['pass'], $row['salt']);
	}


	//instead of saving each element as a property of the object saving a private associative array with the data inside
	public function jsonSerialize() {
		//salt should never be exposed
		$data = array ();
		$data['user_id'] = $this->userId;
		$data['first_name'] = $this->firstName;
		$data['last_name'] = $this->lastName;
		$data['email'] = $this->email;
		$data['username'] = $this->username;
		$data["hash"] = $this->hash;
		return $data;
	}

	public function arraySerilaize() { 
		$output = array();
		foreach ( $this as $key => $value ) { //do these loops need to be done? is it possible to treat this as an array outside the object
			$output[$key] = $value;
		}
		return $output;
	}

	public function tableSerialize() {
		$data = array();
		foreach ( $userData as $key => $value ) {
			$data[":".$key] = $value;
		}
		return data;
	}
	//<editor-fold defaultstate="collapsed" desc="accessors">
	public function getUserId() {
		return $userData["user_id"];
	}
	public function setUserId($userId) {
		return $userData["user_id"] = $userId;
	}
	public function getFirstName() {
		return $userData["first_name"];
	}
	public function setFirstName($firstName) {
		return $userData["first_name"] = $firstName;
	}
	public function getLastName() {
		return $userData["last_name"];
	}
	public function setLastName($lastName) {
		return $userData["last_name"] = $lastName;
	}

	public function getEmail() {
		return $userData["email"];
	}

	public function setEmail($email) {
		return $userData["email"] = $email;
	}

	public function getUsername() {
		return $userData["username"];
	}

	public function setUsername($username) {
		return $userData["username"] = $username;
	}

	public function setHash($hash) { 
		return $userData["hash"] = $hash;
	}

	public function getHash() {
		return $userData["hash"];
	}
}

?>

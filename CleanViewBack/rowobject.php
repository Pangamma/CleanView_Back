<?php
/**
 * allows us to easily add new row objects for mysql.
 */
interface RowObject extends JsonSerializable{
	
	/**
	 * 
	 * @param {string} $row make the object from a mysqli result object.
	 */
	public static function createFromTableRow($row);
	/**
	 * 
	 * @param string $json a string array of parameters used to create the object.
	 */
	public static function createFromJson($json);
}

?>

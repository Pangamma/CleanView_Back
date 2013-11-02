	<?php
	class Table{
			private $db;

			/**
			*	Table model
			*	all interactions with DB should go through here
			*	@param	{string}	$DB_HOST
			* @param	{stirng}	$DB_USER
			* @param	{string}	$DB_PASS
			*	@param	{string}	[$DB_NAME]
			* @param	{string}	[$DB_PORT]
			*	@constructor 	
			*/
			public function Table($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME){
				$this->DB_HOST = $DB_HOST;
				$this->DB_USER = $DB_USER;
				$this->DB_PASS = $DB_PASS;
				$this->DB_NAME = $DB_NAME;

				//TODO: this is an untested connection 
				try{
					$this->db = new PDO("mysql:dbname=".$DB_NAME.";host=".$DB_HOST, $DB_USER, $DB_PASS);
					$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				} catch (PDOException $e) {
					echo 'Connection failed: ' . $e->getMessage();
			    exit;
				}
			}

			//TODO: write crud operations


			/**
			*	executes query
			*	@param	{string}	query
			*	@param	{array}		params	assotiatve array of parameters
			*	@return	{PDOStatement|boolean}	results		PDO if no error else false
			*/
			public function execute($query, $params){
				try{
					$statment = $this->db->prepare($query);
					$statment->execute($params);

					return new Result($statment);
				} catch (PDOException $ex) {
					echo 'Query failed: ' . $ex->getMessage();
					return false;
				}
			}
	}

	class Result{

		private $data;

		/**
		*	Result wraper
		*	@param	{PDOStatment}	resutl to wrap
		*	@constructor
		*/
		public function Result($data){
			$this->data = $data;
		}

		/**
		*	fetch
		*	returns single row
		*	@param	{string}	[type] optional type of return object	
		*	@return {row}	row object
		*/
		public function fetch(){
			//TODO: support diffrent return types
			return $this->data->fetch(PDO::FETCH_BOTH);
		}
	}
	?>

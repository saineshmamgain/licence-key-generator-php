<?php
	/*
	 * Database File
	 */
	require_once 'constants.php';

	class Connection{
		private $conn;

		public function __construct(){
			$this->conn=new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4',DB_USER,DB_PASS);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
		}

		public function getSettings(){
			return $this->_settings();
		}

		private function _settings(){
			$query="SELECT * FROM `key_settings` WHERE status=1 LIMIT 1";
			try{
				$result=$this->conn->query($query);
			}catch(PDOException $ex){
				echo $ex->getMessage().'<br/><br/>';
				echo $query;
				die;
			}

			return $result->fetch(PDO::FETCH_ASSOC);
		}
	}

?>

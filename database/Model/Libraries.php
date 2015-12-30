<?php
require '../database/ConnectionDB/dbConnection.php';

class Libraries{
	
	private $db;
	public static $instance;
	
	public function __construct(){
		self::$instance = $this;
		$this->db = new Connection();
		$this->db->ini_parser();
		$this->db = $this->db->dbConnect();
	}
	
	public static function get() {
		if (self::$instance === null) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	public function QuickSearch($params){
	
		// it might need another insertion
	
		$st = $this->db->prepare("SELECT * FROM libraries WHERE Name LIKE (?)");
		$st->bindParam(1, $params);
	
	
		if($st->execute()){
			return $st->get_result();
		}
		else {
			echo 'Values did NOT insert correctly';
		}
	}
	
	public function Search(array $params){
	
		// it might need another insertion
	
		$st = $this->db->prepare("SELECT * FROM libraries WHERE `Name`=?,`Address`=?,`Telephone`=?,`Fax`=?");
		$st->bindParam(1, $params[0]);
		$st->bindParam(2, $params[1]);
		$st->bindParam(3, $params[2]);
		$st->bindParam(4, $params[3]);
	
	
		if($st->execute()){
			return $st->get_result();
		}
		else {
			echo 'Values did NOT insert correctly';
		}
	}
	
	
	
}
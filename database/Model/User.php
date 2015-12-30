<?php
//require $_SERVER['DOCUMENT_ROOT'].'/Ekpalib/database/ConnectionDB/dbConnection.php';

class User{
	
	private $db;
	
	public function __construct(){
		//$this->db = new Connection();
		$this->db = new Connection();
		$this->db->ini_parser();
		$this->db = $this->db->dbConnect();
	}
	
	public function Login($username, $password){
		if(!empty($username) && !empty($password)){
			$st = $this->db->prepare("select * from user where User=? and Password=?");
			$st->bindParam(1, $username);
			$st->bindParam(2, $password);
			$st->execute();
			
			if($st->rowCount() == 1){
				
				return "User found";
			}
			else{
				return "No user found. Please try again";
			}
		}
		else {
			 return "Please fill all the values!";
		}
	}
	
	public function RegisterUser(array $params){
		
		// it might need another insertion
		
		$st = $this->db->prepare("INSERT INTO user (User, Password, Name, Surname, Phone_Number, Email, academicID, academicPass) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		$st->bindParam(1, $params[0]);
		$st->bindParam(2, $params[1]);
		$st->bindParam(3, $params[2]);
		$st->bindParam(4, $params[3]);
		$st->bindParam(5, $params[4]);
		$st->bindParam(6, $params[5]);
		$st->bindParam(7, $params[6]);
		$st->bindParam(8, $params[7]);
		
		
		if($st->execute()){
			//echo 'Values were inserted';
			return 'registered';
		}
		else {
			echo 'Values did NOT insert correctly';
		}
	}
	 
}
<?php
include 'dbConnection.php';

class User{
	
	private $db;
	
	public function __construct(){
		$this->db = new Connection();
		$this->db = $this->db->dbConnect();
	}
	
	public function Login($username, $password){
		if(!empty($username) && !empty($password)){
			$st = $this->db->prepare("select * from user where User=? and Password=?");
			$st->bindParam(1, $username);
			$st->bindParam(2, $password);
			$st->execute();
			
			if($st->rowCount() == 1){
				//$message = array($username,$password);
				//$this->db->dbClose();
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
		
		
		$st = $this->db->prepare("select * from user where User=? and Password=?");
		$st->bindParam(1, $username);
		$st->bindParam(2, $password);
		$st->execute();
	}
	 
}
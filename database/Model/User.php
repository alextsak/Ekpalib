<?php


class User{
	
	private $db;
	
	public function __construct(){
		
		$pdo = Connection::instance();
		$this->db = $pdo->dbConnect();
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
	
	public function get_user_transactions($username){
	
		$query = 'SELECT MaterialID, Approved FROM academiccommunitymembers_makesrequestfor_material where User=?';
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $username);
		if($stmt->execute()){
			if($stmt->rowCount() > 0){
				return $stmt;
			}
		}
		else {
			return $stmt->errorInfo();
		}
	}
	
	public function get_user_transactions_approved($username){
	
		$query = 'SELECT MaterialID, StartDate, EndDate FROM academiccommunitymembers_makesrequestfor_material where User=? and Approved=1';
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $username);
		if($stmt->execute()){
			if($stmt->rowCount() > 0){
				return $stmt;
			}
		}
		
		return $stmt;
		
	}
	
	public function get_user_transactions_received($username){
		
		$query = 'SELECT MaterialID, StartDate, EndDate FROM academiccommunitymembers_makesrequestfor_material where User=? and Approved=2';
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $username);
		if($stmt->execute()){
			if($stmt->rowCount() > 0){
				return $stmt;
			}
		}
		
		return $stmt;
		
	}
	
	public function get_user_history($username){
	
		$query = 'SELECT MaterialID, received, returned FROM history where User=?';
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $username);
		if($stmt->execute()){
			if($stmt->rowCount() > 0){
				return $stmt;
			}
		}
		
		return $stmt;
		
	}
	 
}
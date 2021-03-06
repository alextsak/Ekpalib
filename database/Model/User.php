<?php
/**
 * 
 * Class dealing with the user requests
 * 
 * 
 *
 */

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
				return "Τα στοιχεία είναι εσφαλμένα. Προσπαθήστε ξανά.";
			}
		}
		else {
			 return "Συμπληρώστε όλα τα πεδία!";
		}
	}
	
	public function RegisterUser(array $params){

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
			
			return 'registered';
		}
		else {
			echo 'Values did NOT insert correctly';
		}
	}
	
	public function get_user_transactions($username){
	/**
	 * Retrieve's all the recent transactions for the user ( approved or not approved from the librarian )
	 * 
	 */
		
		$query = 'SELECT MaterialID, Approved, EndDate FROM academiccommunitymembers_makesrequestfor_material where User=? and (Approved=0 or Approved=1)';
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $username);
		if($stmt->execute()){
			return $stmt;
		}
		echo $stmt->errorInfo();
	}
	
	public function get_user_transactions_all($username){
		/**
		 * Retrieve's all the recent transactions for the user 
		 *
		 */
		$query = 'SELECT MaterialID, Approved FROM academiccommunitymembers_makesrequestfor_material where User=?';
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $username);
		if($stmt->execute()){
			return $stmt;
		}
		echo $stmt->errorInfo();
	}
	
	public function get_user_transactions_not_approved($username){
		/**
		 * Retrieve's all the recent transactions for the user that are not approved
		 *
		 */
		$query = 'SELECT MaterialID, StartDate, EndDate FROM academiccommunitymembers_makesrequestfor_material where User=? and Approved=0';
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $username);
		if($stmt->execute()){
			return $stmt;
		}
		echo $stmt->errorInfo();
	}
	
	public function get_user_transactions_approved($username){
		/**
		 * Retrieve's all the recent transactions for the user that are approved
		 *
		 */
		$query = 'SELECT MaterialID, StartDate, EndDate FROM academiccommunitymembers_makesrequestfor_material where User=? and Approved=1';
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $username);
		if($stmt->execute()){
			return $stmt;
		}
		echo $stmt->errorInfo();
	}
	
	public function get_user_transactions_received($username){
		/**
		 * Retrieve's all the active transactions for the user 
		 * By this we mean that the user has received the material from the library 
		 */
		
		$query = 'SELECT MaterialID, StartDate, EndDate FROM academiccommunitymembers_makesrequestfor_material where User=? and Approved=2';
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $username);
		if($stmt->execute()){
			return $stmt;
		}
		echo $stmt->errorInfo();
	}
	
	public function get_user_history($username){
	
		/**
		 * Retrieve's user's history
		 *
		 */
		
		$query = 'SELECT MaterialID, received, returned FROM history where User=?';
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $username);
		if($stmt->execute()){
			return $stmt;
		}
		echo $stmt->errorInfo();
	}
	
	public function get_endDate($username, $materialID){
		/**
		 * Retrieve's the end date for a material for a specific user
		 * This is required for the expansion request
		 */
		
		$query = 'SELECT EndDate FROM academiccommunitymembers_makesrequestfor_material where User=? and MaterialID=?';
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $username);
		$stmt->bindParam(2, $materialID);
		if($stmt->execute()){
			return $stmt;
		}
		echo $stmt->errorInfo();
	}
	 
}
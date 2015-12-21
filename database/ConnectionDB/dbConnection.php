<?php
/*** Create a connection to the database with PDO using class Connection ***/
class Connection{

	
	private $hostname; /* MySQL server name */
	private $username; /* MySQL username */
	private $dbname;   /* MySQL database name */
	private $password; /* MySQL password */
	private $dbh; /* PDO Handler */
	
	/*public function get_hostname() {
		return $this->hostname;
	}
	public function set_hostname($hostname) {
		$this->hostname = $hostname;
	}
	public function get_username() {
		return $this->username;
	}
	public function set_username($username) {
		$this->username = $username;
	}
	public function get_password() {
		return $this->password;
	}
	public function set_password($password) {
		$this->password = $password;
	}
	public function get_dbname() {
		return $this->dbname;
	}
	public function set_dbname($dbname) {
		$this->dbname = $dbname;
	}*/

	
	
	public function ini_parser(){
		// Parse from configuration.ini file
		
		$path = $_SERVER['DOCUMENT_ROOT'] . '/Ekpalib' . '/configurations' . '.ini';
		$ini_array = parse_ini_file($path);
		$this->hostname = $ini_array['server'];
		$this->username = $ini_array['username'];
		$this->dbname = $ini_array['dbname'];
		$this->password = $ini_array['password'];
		
	}
	public function dbConnect(){
		try {
			$this->dbh = new PDO("mysql:host=$this->hostname;dbname=$this->dbname", $this->username, $this->password);
			$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			/*** echo a message saying we have connected ***/
			//echo 'Connected to database';
			return $this->dbh;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			die();
		}
	}
	
	public function dbClose(){
		$this->dbh = null;
	}

}



?>
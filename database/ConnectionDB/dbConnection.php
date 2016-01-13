<?php
/*** Create a connection to the database with PDO using class Connection ***/
class Connection{

	
	private $hostname; /* MySQL server name */
	private $username; /* MySQL username */
	private $dbname;   /* MySQL database name */
	private $password; /* MySQL password */
	private $dbh; /* PDO Handler */

	
	public static $instance;
	
	public function __construct(){}
	
	public static function getInstance() {
		if (self::$instance === null) {
			self::$instance = new self();
		}
		return self::$instance;
	}
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
			$this->dbh = new PDO("mysql:host=$this->hostname;dbname=$this->dbname", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			/*** echo a message saying we have connected ***/
			echo 'Connected to database';
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
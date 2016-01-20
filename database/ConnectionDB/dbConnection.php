<?php
/*** Create a connection to the database with PDO using class Connection ***/
class Connection{

	
	private static $hostname; /* MySQL server name */
	private static $username; /* MySQL username */
	private static $dbname;   /* MySQL database name */
	private static $password; /* MySQL password */
	//private $db;

	protected static $_instance = null;
	 
	public static function instance() {
	 
		if ( !isset( self::$_instance ) ) {
	 		self::$_instance = new Connection();
	 	}
	 
	 	return self::$_instance;
	}
	
	protected function __construct(){
		Connection::ini_parser();
	}

	static function ini_parser(){
		// Parse from configuration.ini file
		
		$path = $_SERVER['DOCUMENT_ROOT'] . '/Ekpalib' . '/configurations' . '.ini';
		$ini_array = parse_ini_file($path);
		self::$hostname = $ini_array['server'];
		self::$username = $ini_array['username'];
		self::$dbname = $ini_array['dbname'];
		self::$password = $ini_array['password'];
		
	}
	public function dbConnect(){
		$conn = null;
		try {
			$conn  = new PDO("mysql:host=".self::$hostname.";" . "dbname=" . self::$dbname, self::$username, self::$password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));;
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// The following are for debugging purposes...
			
			//$message = 'connected';
			//echo "<script>error_messages('$message');</script>";
			
			return $conn;
		}
		catch(PDOException $e)
		{
			
			$message = $e->getMessage();
			echo "<script>error_messages('$message');</script>";
			die();
		}
		
	}
	

	
	/*public function getDb() {
		if ($this->db instanceof PDO) {
			return $this->db;
		}
	}*/
	

}



?>
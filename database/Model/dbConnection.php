<?php
/*** Create a connection to the database with PDO using class Connection ***/
class Connection{

	/*** mysql hostname ***/
	private $hostname = 'localhost';

	/*** mysql username ***/
	private $username = 'ipaktwebs';

	private $dbname = 'Ekpalib';
	/*** mysql password ***/
	private $password = '19ipaktwebs93';

	private $dbh;
	
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
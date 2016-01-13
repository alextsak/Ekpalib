<?php
class Article{

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
	
	public function getArticleCategories(){
	
		$query = 'select distinct(category) 
			      from articles, material
				  where material.MaterialID = articles.MaterialID ';
		
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			?>
		    	<option><?php echo $row['category']?></option>
		    <?php
		}
	}	
}
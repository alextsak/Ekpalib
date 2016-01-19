<?php
class Article{

	private $db;

	public function __construct(){
	
		$pdo = Connection::instance();
		$this->db = $pdo->dbConnect();
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
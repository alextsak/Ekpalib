<?php
//require './database/ConnectionDB/dbConnection.php';

class Material{

	private $db;
	public static $instance;
	
	public function __construct(){
		self::$instance = $this;
		//$this->db = Connection::getInstance();
		$this->db = new Connection();
		$this->db->ini_parser();
		$this->db = $this->db->dbConnect();
	}
	
	public static function get() {
		if (self::$instance === null) {
			self::$instance = new Material();
		}
		return self::$instance;
	}
	
	public function QuickSearch($params){
	
		// it might need another insertion
	
		$st = $this->db->prepare("SELECT * FROM books WHERE title LIKE (?)");
		$st->bindParam(1, $params);
	
	
		if($st->execute()){
			return $st->get_result();
		}
		else {
			echo 'Values did NOT insert correctly';
		}
	}
	
	public function Search(array $params){
	
		// it might need another insertion
	
		$st = $this->db->prepare("SELECT * FROM books WHERE `isbn`=?,`author`=?,`title`=?,`publisher`=?,`category`=? ");
		$st->bindParam(1, $params[0]);
		$st->bindParam(2, $params[1]);
		$st->bindParam(3, $params[2]);
		$st->bindParam(4, $params[3]);
		$st->bindParam(5, $params[4]);
	
	
		if($st->execute()){
			return $st->get_result();
		}
		else {
			echo 'Values did NOT insert correctly';
		}
	}
	
	public function add_to_upper_cart($genre) {
		$query = 'select * from ' . $genre . ' where MaterialID IN (';
		foreach($_SESSION['cart'] as $id => $value) {
			$query.=$id.",";
		}
		$query=substr($query, 0, -1).") order by title ASC";
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
			?>
				<li>
					
				</li>
				<li role="separator" class="divider"></li>
			<?php 	
			}
		}
	}
	
	
	public function create_mycart($genre) {
		$query = 'select * from ' . $genre . ' where MaterialID IN (';
		foreach($_SESSION['cart'] as $id => $value) {
			$query.=$id.",";
		}
		$query=substr($query, 0, -1).") order by title ASC";
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		if($stmt->rowCount()>0)
		{
			?><thead>
		         		<tr>
		         			<th><?php echo 'Τίτλος';?></th>
		         	      					<th><?php echo 'Κατηγορία';?></th>
		         	      					<th><?php echo 'Συγγραφέας(εις)';?></th>
		         	      					<th><?php echo 'ISBN';?></th>
		         	      					<th><?php echo 'Βιβλιοθήκη';?></th>
		         	      					<th><?php echo 'Διαθεσιμότητα';?></th>
		         	      					<th><?php echo 'Επιλογές'?></th>
		         	   	</tr>
		         	  </thead>
		         	  <?php 
		                while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		                {
		                   ?>
		  					<tbody>
			                   	<tr>
				                   	<td><?php echo $row['title']; ?></td>
				                   	<td><?php echo $row['category']; ?></td>
				                    <td><?php echo $row['author']; ?></td>
				                   	<td><?php echo $row['isbn']; ?></td>
				                   	<td>Science Library</td>
			                 		<td><?php echo $row['availability']; ?></td>
									<td>
										<button class="btn btn-primary btn-sm" type="button" onclick="detailsbook(<?php echo $row['MaterialID'];?>)"><span class="glyphicon glyphicon-info-sign"></span></button>
								&nbsp | &nbsp<button class="btn btn-warning btn-sm" type="button"><span class="glyphicon glyphicon-new-window"></span></button>
										
									</td>
			                   </tr>
		                   </tbody>
		                   <?php
		                }
		      }
		
	}
	
	public function query_data_to_cart($materialID, $genre) {
		if(!empty($materialID)){
			$query = 'select * from ' . $genre . ' where MaterialID=?';
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(1, $materialID);
			$stmt->execute();
			if($stmt->rowCount() != 0) {
				while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {

					if(intval($row['availability']) == 0) {
						$message = "This Material is not available.";
						return $message;
							
					} 
					else {
						$_SESSION['cart'][$row['MaterialID']]=array(
								"title" => $row['title'],
								"category" => $row['category'],
								"author" => $row['author'],
								"ISBN" => $row['isbn'],
								"Library" => 'Science Library',
								"availability" => $row['availability']
						);
						return "ok";
					}
					
					 
				}
				
			}
			else {
				$message="This material id is invalid!";
				return $message;
			}
				
				
		}
	}
	
	
	public function results_view($query,$term)
    {
         $stmt = $this->db->prepare($query);
       
         $term = '%'.$term.'%';
         $stmt->bindParam(1,$term);
        
         $stmt->execute();
        
         if($stmt->rowCount()>0)
         {
         	?><thead>
         		<tr>
         			<th><?php echo 'Τίτλος';?></th>
         	      					<th><?php echo 'Κατηγορία';?></th>
         	      					<th><?php echo 'Συγγραφέας(εις)';?></th>
         	      					<th><?php echo 'ISBN';?></th>
         	      					<th><?php echo 'Βιβλιοθήκη';?></th>
         	      					<th><?php echo 'Διαθεσιμότητα';?></th>
         	      					<th><?php echo 'Προσθήκη στο Καλάθι';?></th>
         	      					<th><?php echo 'Επιλογές'?></th>
         	   	</tr>
         	  </thead>
         	  <?php 
                while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {
                   ?>
  					<tbody>
	                   	<tr>
		                   	<td><?php echo $row['title']; ?></td>
		                   	<td><?php echo $row['category']; ?></td>
		                    <td><?php echo $row['author']; ?></td>
		                   	<td><?php echo $row['isbn']; ?></td>
		                   	<td>Science Library</td>
	                 		<td><?php echo $row['availability']; ?></td>
	                 		<?php $url_path = $_SERVER['QUERY_STRING'];
        						$url_path = '?' .  $url_path;
        						if(strpos( $url_path, '&action')){
        							$last_amber = strrpos( $url_path, '&action');
        							$last_word = substr( $url_path, $last_amber);
        							$url_path = substr( $url_path, 0, $last_amber);
        							
        						}
        						
        						
        						?>
	                 		<td><a href="<?php echo $url_path."&action=add&materialID=" . $row['MaterialID']?>"><span class="glyphicon glyphicon-shopping-cart"></span>
							</a></td>
		                   	
							<td>
								<button class="btn btn-primary btn-sm" type="button" onclick="detailsbook(<?php echo $row['MaterialID'];?>)"><span class="glyphicon glyphicon-info-sign"></span></button>
								&nbsp | &nbsp<button class="btn btn-warning btn-sm" type="button"><span class="glyphicon glyphicon-new-window"></span></button>
										
							</td>
	                   </tr>
                   </tbody>
                   <?php
                }
         }
         else
         {
                ?>
                <tr>
                <td>Nothing here...</td>
                </tr>
                <?php
         }
  
 	}
 
 public function query_easy_search($term, $genre, $keyword) {
	if(!empty($term)) {
		
		$query = 'select * from '  . $genre . ' where ' . $keyword . ' LIKE ' . '?';
		return $query;
	}
 }
 
 	
 public function paging($query,$records_per_page)
 {
        $starting_position=0;
        if(isset($_GET["page_no"]))
        {
             $starting_position=($_GET["page_no"]-1)*$records_per_page;
        }
        $query2=$query." limit $starting_position,$records_per_page";
        
        return $query2;
 }
 
 public function paginglink($query,$term,$records_per_page)
 {
  
        $url_path = $_SERVER['QUERY_STRING'];
        $url_path = '?' .  $url_path;
        
        //check the url_path to avoid duplicate page number
        // if we find the character & eliminate everything after it 
       	if(strpos( $url_path, '&page_no')){
        	$last_amber = strrpos( $url_path, '&page_no');
        	$last_word = substr( $url_path, $last_amber);
        	$self = substr( $url_path, 0, $last_amber);
       	}
       	else {
       		$self = $url_path;
       	}
  		//echo $self;
        $stmt = $this->db->prepare($query);
        $term = '%'.$term.'%';
        $stmt->bindParam(1,$term);
        $stmt->execute();
  
        $total_no_of_records = $stmt->rowCount();
  
        if($total_no_of_records > 0)
        {
            ?><tr><td colspan="8" style="text-align: left; "><?php
            $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
            $current_page=1;
            if(isset($_GET["page_no"]))
            {
               $current_page=$_GET["page_no"];
            }
            if($current_page!=1)
            {
               $previous =$current_page-1;
               echo "<a href='".$self."&page_no=1'>Πρώτο</a>&nbsp;&nbsp;";
               echo "<a href='".$self."&page_no=".$previous."'>Προηγούμενο</a>&nbsp;&nbsp;";
            }
            for($i=1;$i<=$total_no_of_pages;$i++)
            {
            	if($i==$current_page)
            	{
                	echo "<strong><a href='".$self."&page_no=".$i."' style='color:red;text-decoration:none'>".$i."</a></strong>&nbsp;&nbsp;";
            	}
            	else
            	{
                	echo "<a href='".$self."&page_no=".$i."'>".$i."</a>&nbsp;&nbsp;";
            	}
   			}
   			if($current_page!=$total_no_of_pages)
   			{
        		$next=$current_page+1;
        		echo "<a href='".$self."&page_no=".$next."'>Επόμενο</a>&nbsp;&nbsp;";
       		 	echo "<a href='".$self."&page_no=".$total_no_of_pages."'>Τελευταίο</a>&nbsp;&nbsp;";
   			}
   		?></td></tr><?php
  		}
  
 }
	
//}


	public function fetch_material_details($material_id, $genre){
	
		$query = 'SELECT * FROM ' . $genre . ' where MaterialID=?';
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $material_id);
		$stmt->execute();
		if($stmt->rowCount() == 1){
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		return -1;
	}
	
	
	
}

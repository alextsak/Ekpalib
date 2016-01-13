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
	
	function get_categories($material){
		
		if($material == "all")
			$query = 'SELECT DISTINCT category from material';
		else
			$query = 'SELECT DISTINCT(category) 
					  FROM '.$material.',material 
					  where material.MaterialID = '.$material.'.MaterialID';
			
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		if($stmt->rowCount()>0)
			return $stmt;
		return -1;
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
				
				$library = $this->get_material_library($row['MaterialID']);
				$lib_name = '';
				if($library != -1) {
					$lib_name = $library['Name'];
				}
				?>
				<tr>
					<td>
						<?php echo $row['title']; ?>
					</td>
					<td><a href="javascript:detailsLibrary(<?php echo $lib_name; ?>)"><?php echo $lib_name; ?></a></td>
					<td>
						<?php echo $row['isbn']; ?>
					</td>
					<td>
					<form method="post" action="<?php echo $_SERVER['REQUEST_URI']?>">
        					
							<button type="submit" name="removeBtn" class="btn btn-link">
								<span class="glyphicon glyphicon-remove-circle" style="
							    font-size: large;"></span>
							</button>
        					 <input name="id_to_remove" type="hidden" value="<?php echo $row['MaterialID'];?>"/>
        					
        				</form>
						
					</td>
				</tr>					
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
						
						$library = $this->get_material_library($row['MaterialID']);
						$lib_name = '';
						if($library != -1) {
							$lib_name = $library['Name'];
						}
						
						$_SESSION['cart'][$row['MaterialID']]=array(
								"id"	=> $row['MaterialID'],
								"title" => $row['title'],
								"category" => $row['category'],
								"author" => $row['author'],
								"ISBN" => $row['isbn'],
								"Library" => $lib_name,
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
         if(is_array($term)){
         	$i = 1;
         	// inside this for we use bindValue rather than bindParam because the variable is being unsetted in every iteration
         	// So bindParam -> binds the variable to the statement, not the value
         	// bindValue -> binds the value of the variable
         	for($c=0;$c<count($term);$c++)
            {
         		if($term[$c]!="" && $term[$c]!="all"){
         			$t = '%'.$term[$i-1].'%';
         			
         			$stmt->bindValue($i,$t);
         			$i++;
         		}
         	}
         
         }else {
         	$term = '%'.$term.'%';
         	$stmt->bindParam(1,$term);
         }
         $stmt->execute();
        
         if($stmt->rowCount()>0){
         	?><thead>
         		<tr>
         			<th><?php echo 'Τίτλος';?></th>
         	      					<th><?php echo 'Κατηγορία';?></th>
         	      					<th><?php echo 'Βιβλιοθήκη';?></th>
         	      					<th><?php echo 'Διαθεσιμότητα';?></th>
         	      					<th><?php echo 'Ημέρες Δανεισμού';?></th>
         	      					<th><?php echo 'Προσθήκη στο Καλάθι';?></th>
         	      					<th><?php echo 'Επιλογές'?></th>
         	   	</tr>
         	  </thead>
         	  <?php 
                 while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                	?>
	                   	<tr>
		                   	<td><?php echo $row['title']; ?></td>
		                   	<td><?php echo $row['category']; ?></td>
		                   	<td><a href="javascript:detailsLibrary(<?php echo $row['Name']; ?>)"><?php echo $row['Name']; ?></a></td>
	                 		<td><?php echo $row['availability']; ?></td>
	                 		<td><?php echo $row['available_days']; ?></td>
	                 		<?php $url_path = $_SERVER['QUERY_STRING'];
        						$url_path = '?' .  $url_path;
        						if(strpos( $url_path, '&action')){
        							$last_amber = strrpos( $url_path, '&action');
        							$last_word = substr( $url_path, $last_amber);
        							$url_path = substr( $url_path, 0, $last_amber);
        							
        						}
        						
        						
        						?>
	                 		<td><a href="<?php echo $url_path."&action=add&materialID=" . $row['MaterialID']?>"><span class="glyphicon glyphicon-shopping-cart"  style="font-size:larger;"></span>
							</a></td>
		                   	
							<td style="width:120px;">
								<button class="btn btn-primary btn-sm" type="button" onclick="detailsbook(<?php echo $row['MaterialID'];?>)">
									<span class="glyphicon glyphicon-info-sign" ></span>
								</button>
								&nbsp | &nbsp
								<button class="btn btn-warning btn-sm" type="submit" onclick="addToCart(<?php echo $row['MaterialID'];?>)">
									<span class="glyphicon glyphicon-new-window"></span>
								</button>
								
										
							</td>
	                   </tr>
                   <?php
                }
         }
         else{
                ?>
                <tr>
                <td>Nothing here...</td>
                </tr>
                <?php
         }
  
 	}
 
 public function query_easy_search($term, $genre, $keyword,$category) {
	
	$query = 'select distinct(material.MaterialID),title,category,libraries.Name,availability,available_days 
		      from '  . $genre . ', material,libraries_has_material,libraries,material_has_author,author
			  where material.MaterialID = libraries_has_material.MaterialID and
			  libraries_has_material.idLibraries = libraries.idLibraries and 
			  material.MaterialID = material_has_author.MaterialID and
			  material_has_author.idAuthor = author.idAuthor and
			  material.MaterialID =  ' .$genre.'.MaterialID ';
	
	
	if($keyword == "Name")
		$query.= ' and  author.' . $keyword . ' LIKE ' . '?' ; 
	else
		$query.= ' and  ' . $keyword . ' LIKE ' . '?' ;
	
		
	if($genre == "articles")
		$query.= ' and  category LIKE '.'?';
	return $query;
	
 }
 
 public function get_material_library($material_id){
 
 	$query = 'select libraries.Name, libraries.idLibraries
 		from material,libraries_has_material,libraries
 		where material.MaterialID = ? and libraries_has_material.MaterialID = material.MaterialID
 		and libraries_has_material.idLibraries=libraries.idLibraries';
 
 	$stmt = $this->db->prepare($query);
 	$stmt->bindParam(1, $material_id);
 	$stmt->execute();
 	if($stmt->rowCount()>0){
 		return $stmt->fetch(PDO::FETCH_ASSOC);
 	}
 	return -1;
 }

 public function fetch_material_details($material_id, $genre){
 
 	$query = 'SELECT * FROM material,material_has_author,author,' . $genre . ' 
			  where material.MaterialID = material_has_author.MaterialID and
			  material_has_author.idAuthor = author.idAuthor and 
			  material.MaterialID = '.$genre.'.MaterialID 
			  and material.MaterialID=?';
 	
 	$stmt = $this->db->prepare($query);
 	$stmt->bindParam(1, $material_id);
 	$stmt->execute();
 	if($stmt->rowCount() > 0){
 		return $stmt;
 	}
 	return -1;
 }
 
 public function advancedSearch($type,$category,$keyword,$author,$publisher,$isbn,$library){
 
 	
 	$query = 'select *
				from material,material_has_author,author,libraries_has_material,libraries ';
					
					
	if($type!="all")
		$query.=' , '.$type.' ';
	
	
	$query.='where material.MaterialID = material_has_author.MaterialID and
			  material_has_author.idAuthor = author.idAuthor and
			  material.MaterialID = libraries_has_material.MaterialID and
			  libraries_has_material.idLibraries = libraries.idLibraries ';
				
	if($type!="all")
		$query.=' and material.MaterialID = '.$type.'.MaterialID';
		
		
 	$query.=' and category LIKE '.'?';
 	
 	if($library!="all")
 		$query.=' and libraries.Name LIKE '.'?';
 	
 	if($keyword!="")
 		$query.=' and title LIKE '.'?';
 	
 	if($author!="")
 		$query.=' and author.Name LIKE '.'?';
 	
 	if($publisher!="")
 		$query.=' and books.publisher LIKE '.'?';
 	
 	if($isbn!="")
 		$query.=' and books.isbn LIKE '.'?';
 	
 	/* echo $query; */
 	return $query;
 }
 
 /**************************************** LOAN REQUEST AND CONFIRMATION **************************************************/
 public function confirmLoan($idArray, $user){
 	// insert the material_id and the user_id to history table
 	if(!empty($idArray) && !empty($user)){
 		$query = 'INSERT INTO academiccommunitymembers_makesrequestfor_material(User, MaterialID, StartDate, EndDate, Approved) VALUES (?, ?, NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY), 1)';
 		
		$stmt = $this->db->prepare($query);
		$flag = 0;
		foreach($idArray as $material_id){
			$stmt->bindParam(1, $user);
			$stmt->bindParam(2, intval($material_id));
			if($stmt->execute()) {
				$flag = 1;
			} else {
				return "problem";
		}
		
			
			/*$err = $sth->errorInfo();
			$err;
			return $err;*/
		}
		if($flag == 1) {
			return "inserted";
		}
		
 	} 
 	else {
 		return "empty";
 	}
 	
 
 
 }
 

 
 
 /****************************************** START OF PAGINATION ***********************************************/
 	
 public function paging($query,$records_per_page)
 {
        $starting_position=0;
        if(isset($_GET["page_no"]))
        {
             $starting_position=($_GET["page_no"]-1)*$records_per_page;
        }   
        $query2=$query." limit $starting_position,$records_per_page ";
        
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
 		if(is_array($term)){
         	$i = 1;
         	for($c=0;$c<count($term);$c++)
            {
            	if($term[$c]!="" && $term[$c]!="all"){
         			$t = '%'.$term[$i-1].'%';
         			$stmt->bindValue($i,$t);
         			$i++;
         		}
         	}
         }else {
         	$term = '%'.$term.'%';
         	$stmt->bindParam(1,$term);
         }
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
	
 /****************************************** END OF PAGINATION ***********************************************/


	
	
	
	
}

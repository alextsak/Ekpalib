<?php
//require './database/ConnectionDB/dbConnection.php';

class Material{

	private $db;
	
	
	public function __construct(){
	
		$pdo = Connection::instance();
		$this->db = $pdo->dbConnect();
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
	
	public function get_material_by_id($materialID){
	
		// Fetch the basic details for this material
			$query = 'select * from material where MaterialID=?';
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(1, $materialID);
			$stmt->execute();
			
			if($stmt->rowCount() > 0) {
				return $stmt;
			}
			else {
				return "Το υλικό δεν βρέθηκε.";
			}
	}
	
	function get_categories($material){
		
		if($material == "all")
			$query = 'SELECT DISTINCT(category) from material';
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
		/*$query = 'select * from ' . $genre . ' where MaterialID IN (';
		foreach($_SESSION['cart'] as $id => $value) {
			$query.=$id.",";
		}*/
		
		
		//$query=substr($query, 0, -1).") order by title ASC";
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
	
	
	
	public function update_upper_cart(){
		
		foreach($_SESSION['cart'] as $key=>$value){
			
			?>
				<tr>
					<td>
						<?php echo $_SESSION['cart'][$key]['title']; ?>
					</td>
					<td><a href="javascript:detailsLibrary(<?php echo  $_SESSION['cart'][$key]['lib_id']; ?>)"><?php echo  $_SESSION['cart'][$key]['library']; ?></a></td>
					<td>
						<?php echo $_SESSION['cart'][$key]['category']; ?>
					</td>
					<td>
					<form method="post" action="<?php echo $_SERVER['REQUEST_URI']?>">
        					
							<button type="submit" name="removeBtn" class="btn btn-link">
								<span class="glyphicon glyphicon-remove-circle" style="
							    font-size: large;"></span>
							</button>
        					 <input name="id_to_remove" type="hidden" value="<?php echo $_SESSION['cart'][$key]['id'];?>"/>
        					
        			</form>
						
					</td>
				</tr>					
			<?php 	
		
		}
		
	}
	
	public function materialBelongsToTable($materialID){
	
		$books = 'SELECT * from books where materialID = ?';
		$articles = 'SELECT * from articles where materialID = ?';
		$magazines = 'SELECT * from magazines where materialID = ?';
		
		$stmt = $this->db->prepare($books);
		$stmt->bindParam(1, $materialID);
		$stmt->execute();
		if($stmt->rowCount()>0)
			return "books";
		
		$stmt = $this->db->prepare($articles);
		$stmt->bindParam(1, $materialID);
		$stmt->execute();
		if($stmt->rowCount()>0)
			return "articles";
		
		$stmt = $this->db->prepare($magazines);
		$stmt->bindParam(1, $materialID);
		$stmt->execute();
		if($stmt->rowCount()>0)
			return "magazines";
	}
	
	
	public function add_to_cart($materialID) {
		if(!empty($materialID)){
			
			// Fetch the basic details for this material
			$query = 'select * from material where MaterialID=?';
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(1, $materialID);
			$stmt->execute();
			
			if($stmt->rowCount() != 0) {
				while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {

					// check if this material is available
					if(intval($row['availability']) == 0) {
						$message = "This Material is not available.";
						return $message;
							
					} 
					else {
						
						// if the material is available find where it belongs
						$library = $this->get_material_library($row['MaterialID']);
						$lib_name = '';
						if($library != -1) {
							$lib_name = $library['Name'];
							$lib_id = $library['idLibraries'];
						}
						
						$_SESSION['cart'][$row['MaterialID']]=array(
								"id"			=> $row['MaterialID'],
								"title" 		=> $row['title'],
								"category" 		=> $row['category'],
								"library" 		=> $lib_name,
								"lib_id" 		=> $lib_id,
								"availability" 	=> $row['availability'],
								"available_days" => $row['available_days']
								
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
         			<th style="text-align:center;"><?php echo 'Τίτλος';?></th>
         	      					<th style="text-align:center;"><?php echo 'Κατηγορία';?></th>
         	      					<th style="text-align:center;"><?php echo 'Βιβλιοθήκη';?></th>
         	      					<th style="text-align:center;"><?php echo 'Διαθεσιμότητα';?></th>
         	      					<th style="text-align:center;"><?php echo 'Ημέρες Δανεισμού';?></th>
         	      					<th style="text-align:center;"><?php echo 'Προσθήκη στο Καλάθι';?></th>
         	      					<th style="text-align:center;"><?php echo 'Επιλογές'?></th>
         	   	</tr>
         	  </thead>
         	  <?php 
                 while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                	?>
	                   	<tr>
		                   	<td style="text-align:center;"><?php echo $row['title']; ?></td>
		                   	<td style="text-align:center;"><?php echo $row['category']; ?></td>
		                   	<td style="text-align:center;"><a href="javascript:detailsLibrary(<?php echo $row['idLibraries'];?>)"><?php echo $row['Name']; ?></a></td>
	                 		<td style="text-align:center;"><?php echo $row['availability']; ?></td>
	                 		<td style="text-align:center;"><?php echo $row['available_days']; ?></td>
	                 		<?php $url_path = $_SERVER['QUERY_STRING'];
        						$url_path = '?' .  $url_path;
        						if(strpos( $url_path, '&action')){
        							$last_amber = strrpos( $url_path, '&action');
        							$last_word = substr( $url_path, $last_amber);
        							$url_path = substr( $url_path, 0, $last_amber);
        							
        						}
        						
        						
        						?>
	                 		<td style="text-align:center;"><a href="<?php echo $url_path."&action=add&materialID=" . $row['MaterialID']?>"><span class="glyphicon glyphicon-shopping-cart"  style="font-size:larger;"></span>
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
 
 public function query_easy_search($term, $genre, $keyword, $category) {
	
	$query = 'select distinct(material.MaterialID),title,category,libraries.Name,libraries.idLibraries,availability,available_days 
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

 public function fetch_material_details($materialID){
 	
 	// firstly determine the genre of the materialID given, e.g Book, Article etc...
 	$genre = $this->materialBelongsToTable($materialID);
 	//echo $materialID;
 	//$genre = "books";
 	$query = 'SELECT * FROM material,material_has_author,author,' . $genre . ' 
			  where material.MaterialID = material_has_author.MaterialID and
			  material_has_author.idAuthor = author.idAuthor and 
			  material.MaterialID = '.$genre.'.MaterialID 
			  and material.MaterialID=?';
 	
 	$stmt = $this->db->prepare($query);
 	$stmt->bindParam(1, $materialID);
 	$stmt->execute();
 	if($stmt->rowCount() > 0){
 		return $stmt;
 		
 	}
 	return -1;
 }
 
 public function get_authors_of_material($materialID){
 	
 	$query = 'SELECT Name, Surname FROM material_has_author, author WHERE 
						material_has_author.idAuthor = author.idAuthor 
						and material_has_author.MaterialID =?';
 	
 	$stmt = $this->db->prepare($query);
 	$stmt->bindParam(1, $materialID);
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
 public function autoApprove($material_id){
 /* Dummy function to auto approve requests for materials with over 50 unit in availability,
  * for presentation purposes */
 	if (!empty($material_id)){
 		$query = 'UPDATE academiccommunitymembers_makesrequestfor_material SET Approved=1 WHERE MaterialID=? and (SELECT availability FROM material WHERE MaterialID=?) >= 50';
 		$stmt = $this->db->prepare($query);
 		$flag = 0;
 		$stmt->bindValue(1, intval($material_id));
 		$stmt->bindValue(2, intval($material_id));
 		if($stmt->execute()) {
 			$flag = 1;
 			return "ok";
 		}
 		else {
 			return "error";
 		}
 	}
 	else {
 		return "empty argument";
 	}
 }
 
 public function confirmLoan($idArray, $user){
 	// insert the material_id and the user_id to history table
 	if(!empty($idArray) && !empty($user)){
 		$query = 'INSERT INTO academiccommunitymembers_makesrequestfor_material(User, MaterialID, StartDate, EndDate, Approved) VALUES (?, ?, NOW(), DATE_ADD(NOW(), INTERVAL (SELECT available_days FROM material WHERE MaterialID=?) DAY), 0)';
 		
		$stmt = $this->db->prepare($query);
		$flag = 0;
		foreach($idArray as $material_id){
			//$interval = $_SESSION['cart'][$material_id]['available_days'];
			$stmt->bindValue(1, $user);
			$stmt->bindValue(2, intval($material_id));
			$stmt->bindValue(3, intval($material_id));
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
			$this->autoApprove($material_id);
			return "inserted";
		}
		
 	} 
 	else {
 		return "empty";
 	}
 	
 
 
 }
 

 public function request_expansion($username, $materialID, $days){
 	
	if(!empty($username) && !empty($materialID) && !empty($days)){
		$query = "UPDATE academiccommunitymembers_makesrequestfor_material SET EndDate = DATE_ADD(EndDate,INTERVAL ? DAY) WHERE User=? and MaterialID=?";	
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $days);
		$stmt->bindParam(2, $username);
		$stmt->bindParam(1, $materialID);
		if($stmt->execute()) {
			return "Η επέκταση έγινε με επιτυχία";
		} 
		return "Πρόβλημα επέκτασης";
		
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

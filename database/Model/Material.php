<?php
// Class for handling material requests...

class Material{

	private $db;
	
	
	public function __construct(){
	
		$pdo = Connection::instance();
		$this->db = $pdo->dbConnect();
	}
	

	public function QuickSearch($params){
	
		$st = $this->db->prepare("SELECT * FROM books WHERE title LIKE (?)");
		$st->bindParam(1, $params);
	
	
		if($st->execute()){
			return $st->get_result();
		}
		else {
			echo 'Values did NOT insert correctly';
		}
	}
	
	public function getArticleCategories(){ 
	
		$query = 'select distinct(category) from articles, material where material.MaterialID = articles.MaterialID '; 
		$stmt = $this->db->prepare($query); 
		$stmt->execute();
		
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)) { 
			?> <option><?php echo $row['category']?></option> <?php 
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
	
	
	
	public function get_categories($material){
		/**
		 * Get all the categories for a material(Σύγγραμα, Άρθρο, Περιοδικό) chosen by the user at the advanced search page
		 * 
		 */
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
	/**
	 * If the upper cart has nothing the create it and add the items
	 * 
	 */
		
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
					<td><a href="javascript:detailsLibrary(<?php echo $lib_name; ?>)" style="text-decoration: none; font-weight:bold; color:#6699CC;"><?php echo $lib_name; ?></a></td>
					<td>
						<?php echo $row['isbn']; ?>
					</td>
					<td >
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
		/**
		 * Update's the upper cart every time an item is added
		 * 
		 */
		foreach($_SESSION['cart'] as $key=>$value){
			
			?>
				<tr class="cart-items">
					<td style="color:white">
						<?php echo $_SESSION['cart'][$key]['title']; ?>
					</td>
					<td><a href="javascript:detailsLibrary(<?php echo  $_SESSION['cart'][$key]['lib_id']; ?>)" style="text-decoration: none; font-weight:bold; color:#6699CC;"><?php echo  $_SESSION['cart'][$key]['library']; ?></a></td>
					<td style="color:white">
						<?php echo $_SESSION['cart'][$key]['category']; ?>
					</td>
					<td style="text-align: center;">
					<form method="post" action="<?php echo $_SERVER['REQUEST_URI']?>">
        					
							<button type="submit" name="removeBtn" class="btn btn-danger btn-xs">
								<span class="glyphicon glyphicon-remove" style="
							    font-size: large;"></span>
							</button>
        					 <input id="upper-cart-id" name="id_to_remove" type="hidden" value="<?php echo $_SESSION['cart'][$key]['id'];?>"/>
        					
        			</form>
						
					</td>
				</tr>					
			<?php 	
		
		}
		
	}
	
	public function materialBelongsToTable($materialID){
	/**
	 * Determine's whether a material belongs to one of the 3 tables (articles, books, magazines)
	 * 
	 */
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
		/**
		 * Create's the session variable cart and add's the id of the item as an identifier
		 * 
		 */
		
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
    	/**
    	 * Create's the vies for the result's 
    	 * 
    	 */
         $stmt = $this->db->prepare($query);
         if(is_array($term)){
         	$i = 1;
         	// inside this for we use bindValue rather than bindParam because the variable is being unsetted in every iteration
         	// So bindParam -> binds the variable to the statement, not the value
         	// bindValue -> binds the value of the variable
         	for($c=0;$c<count($term);$c++)
            {
            	
            	if($term[$c]!="" && $term[$c]!="all"){
         			$t = '%'.$term[$c].'%';
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
         	  <tbody>
         	  <?php 
                 while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                	?>
	                   	<tr>
		                   	<td style="text-align:center;"><?php echo $row['title']; ?></td>
		                   	<td style="text-align:center;"><?php echo $row['category']; ?></td>
		                   	<td style="text-align:center;"><a href="javascript:detailsLibrary(<?php echo $row['idLibraries'];?>)" style="text-decoration: none; font-weight:bold; color:#6699CC;"><?php echo $row['Name']; ?></a></td>
	                 		<td style="text-align:center;"><?php echo $row['availability']; ?></td>
	                 		<td style="text-align:center;"><?php echo $row['available_days']; ?></td>
	                 		
	                 		<td style="text-align:center;">
	                 			<button class="btn btn-default btn-sm" type="button" onclick="addToCart(<?php echo $row['MaterialID'];?>,'<?php echo $row['title'];?>')">
									<span class="glyphicon glyphicon-shopping-cart"></span> 
								</button>
	                 		  
							</td>
		                   	
							<td style="width:120px;text-align:center;">
								<button class="btn btn-primary btn-sm" type="button" onclick="detailsbook(<?php echo $row['MaterialID'];?>, '<?php echo get_title();?>')"
								style="background-color: rgb(153, 43, 0); border-color: rgb(153, 43, 0);">
									<span class="glyphicon glyphicon-info-sign" ></span>
								</button>	
							</td>
	                   </tr>
	                   </tbody>
                   <?php
                }
         }
         else{
                ?>
                <tr>
                <td>Δεν βρέθηκαν εγγραφές :( ...</td>
                </tr>
                </tbody>
                <?php
         }
  
 	}
 
 public function query_easy_search($term, $genre, $keyword, $category) {
	/**
	 * 
	 * Construct's the query for the easy search
	 * 
	 */
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
 /**
  * Retrieve's library info where the material given, belongs
  * 
  */
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
 	/**
 	 * Retrieve's more specific details for the material
 	 * 
 	 */
 	
 	// firstly determine the genre of the materialID given, e.g Book, Article etc...
 	$genre = $this->materialBelongsToTable($materialID);
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
 	/**
 	 * 
 	 * Retrieve's the author's of the given material
 	 */
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
 
 	/**
 	 * Construct's the query for the advanced search 
 	 * 
 	 */
 	$query = 'select * from material,material_has_author,author,libraries_has_material,libraries ';
									
	if($type!="all")
		$query.=' , '.$type.' ';
	
	if($publisher!="" || $isbn!="")
		$query.=',books ';
		
	$query.='where 
			 material.MaterialID = material_has_author.MaterialID and
			 material_has_author.idAuthor = author.idAuthor and
			 material.MaterialID = libraries_has_material.MaterialID and
			 libraries_has_material.idLibraries = libraries.idLibraries ';
	
	if($publisher!="" || $isbn!="")
		$query.=' and material.MaterialID = books.MaterialID ';
	
		
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
 public function autoApprove($username,$material_id){
 /* Dummy function to auto approve requests for materials with over 50 unit in availability,
  * for presentation purposes */
 	if (!empty($material_id) && !empty($username)){
 		$query = 'UPDATE academiccommunitymembers_makesrequestfor_material SET Approved=1 WHERE MaterialID=? and (SELECT availability FROM material WHERE MaterialID=?) >= 50';
 		$stmt = $this->db->prepare($query);
 		$flag = 0;
 		$stmt->bindValue(1, intval($material_id));
 		$stmt->bindValue(2, intval($material_id));
 		if($stmt->execute()) {
 			$flag = 1;
 			$this->reduceAvailability($username,$material_id);
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
 
 public function autoReceive($username,$material_id){
 	/* Dummy function to auto receive the materials with over 100 unit in availability,
 	 * for presentation purposes */
 	if (!empty($material_id) && !empty($username)){
 		$query = 'UPDATE academiccommunitymembers_makesrequestfor_material SET Approved=2 WHERE MaterialID=? and (SELECT availability FROM material WHERE MaterialID=? and Approved=1) >= 100';
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
 
 public function remove_request($username,$material_id){
 	// Remove the user request with given ID
 	if (!empty($material_id) && !empty($username)){
 		$this->increaseAvailability($username,$material_id);
 		$query = 'DELETE FROM academiccommunitymembers_makesrequestfor_material WHERE User=? and MaterialID=?';
 		$stmt = $this->db->prepare($query);
 		$flag = 0;
 		$stmt->bindparam(1, $username);
 		$stmt->bindValue(2, intval($material_id));
 		if($stmt->execute()) {
 			$flag = 1;
 			return "ok";
 		}
 		else {
 			return "Η διαγραφή της αίτησης δεν είναι δυνατή.";
 		}
 	}
 	else {
 		return "empty argument";
 	}
 }
 
 public function reduceAvailability($username,$material_id){
 	/* Function to reduce the availability of a material */
 	if (!empty($material_id) && !empty($username)){
 		$query = 'UPDATE material SET material.availability=material.availability-1 WHERE MaterialID=? and (SELECT Approved FROM academiccommunitymembers_makesrequestfor_material WHERE User=? and MaterialID=?)>0';
 		$stmt = $this->db->prepare($query);
 		$flag = 0;
 		$stmt->bindValue(1, intval($material_id));
 		$stmt->bindparam(2, $username);
 		$stmt->bindValue(3, intval($material_id));
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
 
 public function increaseAvailability($username,$material_id){
 	/* Function to reduce the availability of a book */
 	if (!empty($material_id) && !empty($username)){
 		$query = 'UPDATE material SET material.availability=material.availability+1 WHERE MaterialID=? and (SELECT Approved FROM academiccommunitymembers_makesrequestfor_material WHERE User=? and MaterialID=?)>0';
 		$stmt = $this->db->prepare($query);
 		$flag = 0;
 		$stmt->bindValue(1, intval($material_id));
 		$stmt->bindparam(2, $username);
 		$stmt->bindValue(3, intval($material_id));
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
 
 public function confirmLoan($idArray, $user, $days_array){
 	// insert the material_id, user_id and the days he wishes to loan the material 
 	
 	if(!empty($idArray) && !empty($user)){
 		$query = 'INSERT INTO academiccommunitymembers_makesrequestfor_material(User, MaterialID, StartDate, EndDate, Approved) VALUES (?, ?, NOW(), DATE_ADD(NOW(), INTERVAL ? DAY), 0)';
 		
		$stmt = $this->db->prepare($query);
		$flag = 0;
		for($i=0; $i<count($idArray); $i++) {
			
			try {
				$stmt->bindValue(1, $user);
				$stmt->bindValue(2, intval($idArray[$i]));
				$stmt->bindValue(3, intval($days_array[$i]));
				$stmt->execute();
				$flag = 1;
				$this->autoApprove($user,intval($idArray[$i]));
				$this->autoReceive($user,intval($idArray[$i]));
			} catch (PDOException $e) {
				return "request_denied";
			}
		}
		if($flag == 1) {
			return "inserted";
		}
		
 	} 
 	else {
 		return "empty";
 	}
 }
 

 public function request_expansion($username, $materialID, $days){
 	/**
 	 * Add's the expansion dates. The system accepts the request immediatelly because we don't include a librarian yet
 	 * 
 	 */
	if(!empty($username) && !empty($materialID) && !empty($days)){
		$query = "UPDATE academiccommunitymembers_makesrequestfor_material SET EndDate = DATE_ADD(EndDate,INTERVAL ? DAY) WHERE User=? and MaterialID=?";	
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(1, intval($days));
		$stmt->bindParam(2, $username);
		$stmt->bindValue(3, intval($materialID));
		if($stmt->execute()) {
			return "ok";
		} 
		return "error";
		
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

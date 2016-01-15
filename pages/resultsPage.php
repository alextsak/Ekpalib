<?php
error_reporting(E_ALL);
if(isset($_POST['advancedSearch'])){
	$material = new Material();
	$query = $material->advancedSearch($_POST['radio'],
			$_POST['category'],
			$_POST['keyword'],
			$_POST['author'],
			$_POST['publisher'],
			$_POST['isbn'],
			$_POST['library']);
	
	$terms = array( $_POST['category'],$_POST['library'],
			$_POST['keyword'],$_POST['author'],
			$_POST['publisher'],$_POST['isbn']);
	
	$_SESSION['last_query'] = $query;
	$_SESSION['last_terms'] = $terms;
	
}
else {
	if(isset($_POST['searchbooks'])){
		$material = new Material();
		$query = $material->query_easy_search($_POST['term'], $_POST['genre'],
				$_POST['keyword'],$_POST['category']);
		$terms = array( $_POST['term'],$_POST['category']);
		
		$_SESSION['last_query'] = $query;
		$_SESSION['last_terms'] = $terms;
	}
	
	
	
	
}






?>

<div>
<?php //echo $_SERVER['REQUEST_URI'];?>
	<div>
		<h3 id="reasultsHeader">Αποτελέσματα Αναζήτησης</h3>
	
	</div>

	
	<hr class="style-seven">
	<div>
		<div class="table-responsive">  
	    	<table id="results-grid" class="table ">
	    	<tbody>
	    	<?php
	    	
	    	//$material = new Material();
	    	$material = Material::get();
	    	$records_per_page=5;
	    	$newquery = $material->paging($_SESSION['last_query'],$records_per_page);
	    	$material->results_view($newquery, $_SESSION['last_terms']);
	    	$material->paginglink($_SESSION['last_query'],$_SESSION['last_terms'],$records_per_page);
	    	
	    		/*if(isset($_POST['advancedSearch'])){
	    			$material = new Material();
	    			$records_per_page=5;
	    			$query = $material->advancedSearch($_POST['radio'],
	    											   	$_POST['category'],
	    												$_POST['keyword'],
	    												$_POST['author'],
	    												$_POST['publisher'],
	    												$_POST['isbn'],
	    												$_POST['library']);
	    			$newquery = $material->paging($query,$records_per_page);
	    			$terms = array( $_POST['category'],$_POST['library'],
	    					$_POST['keyword'],$_POST['author'],
	    					$_POST['publisher'],$_POST['isbn']);
	    			
	    			
	    			$material->results_view($newquery, $terms);
	    			$material->paginglink($query,$terms,$records_per_page);
	    		}else{
	    			if(isset($_POST['searchbooks'])){
	    				$_SESSION['genre'] = $_POST['genre'];
	    				
	    				$material = new Material();
	    				$records_per_page=5;
	    				
	    				$query = $material->query_easy_search($_POST['term'], $_POST['genre'],
	    						$_POST['keyword'],$_POST['category']);
	    				$newquery = $material->paging($query,$records_per_page);
	    				
	    				$terms = array( $_POST['term'],$_POST['category']);
	    				$material->results_view($newquery, $terms);
	    				$material->paginglink($query,$terms,$records_per_page);
	    			}
	    			
	    			
	    			
	    			
	    		}*/
	 		?> 
			</tbody>	
			</table>
			<script type="text/javascript">
				function addToCart(id){
					//console.log("book id: " + id);
					//console.log(window.location.href);
					$.ajax({
						  url: window.location.href,
						  type: "POST", //send it through get method
						  data:{action : "add", materialID : id},
						  success: function(response) {
							  location.reload(true);
							  closeModal();
						  },
						  error: function(xhr) {
						    //Do Something to handle error
						  }
						});
					}
			</script>
		
			<?php
			if(!isset($_SESSION['username'])) {
				?>
				<a href="?page=login_signup" id="confirmLoan-Button" type="button" class="btn btn-default">Επιβεβαίωση Δανεισμού
				<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			<?php }
			/*elseif(isset($_SESSION['username']) && !isset($_SESSION['cart'])) {
				$message = "Παρκαλώ εισάγετε αντικείμενα στο καρότσι σας";
				echo "<script>error_messages('$message');</script>";
			}*/
			else {
				
				?>
				<input class="btn btn-primary" id="confirmLoan-Button" href="?page=confirmLoan" alt="submit" value="Επιβεβαίωση Δανεισμού">
				<span class="glyphicon glyphicon-chevron-right"></span>
			<?php 
			}
			?> 
		</div>
		
   	</div>
</div>

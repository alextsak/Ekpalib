<?php
error_reporting(E_ALL);


if(isset($_POST['searchbooks'])){
	$_SESSION['genre'] = 'books';
	$_SESSION['term'] = $_POST['term'];
	
	if($_POST['keyword'] == 'key'){
		$_SESSION['keyword'] = 'title';
	} else {
		$_SESSION['keyword'] = $_POST['keyword'];
	}
}

?>

<div>
<?php //echo $_SERVER['REQUEST_URI'];?>
	<div>
		<h3 id="reasultsHeader">Αποτελέσματα Αναζήτησης</h3>
		<?php  if(isset($message)){ 
            echo "<h3 style=\"color:red;\">$message</h3>"; 
        	}  
        ?>
	</div>

	
	<hr class="style-seven">
	<div>
		<div class="table-responsive">  
	    	<table id="results-grid" class="table table-striped">
	    	<tbody>
	    	<?php
	    		if(isset($_POST['searchbooks'])){
		       		$material = new Material();
		       		$records_per_page=5;
		       		
		       		$query = $material->query_easy_search($_SESSION['term'], $_SESSION['genre'],$_SESSION['keyword']);
		       		$newquery = $material->paging($query,$records_per_page);
		       		$material->results_view($newquery, $_SESSION['term']);
		       		$material->paginglink($query,$_SESSION['term'],$records_per_page);
	    		}
	    		if(isset($_POST['advancedSearch'])){
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
	    		}
	 		?> 
			</tbody>	
			</table>
		</div>
		<div>
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
			
			?><a href="?page=confirmLoan" id="confirmLoan-Button" type="button" class="btn btn-default">Επιβεβαίωση Δανεισμού
			<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
			
		<?php 
		}
		?> 
			
		</div>
   	</div>
</div>

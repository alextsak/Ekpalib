<?php
error_reporting(E_ALL);
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
	    	<table id="results-grid" class="table ">
	    	<tbody>
	    	<?php
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
	    			
	    			
	    			
	    			
	    		}
	 		?> 
			</tbody>	
			</table>
		
		
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
				<a class="pull-right hidden-xs" href="?page=confirmLoan" id="confirmLoan-Button">Επιβεβαίωση Δανεισμού
				<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			<?php 
			}
			?> 
		</div>
		
   	</div>
</div>

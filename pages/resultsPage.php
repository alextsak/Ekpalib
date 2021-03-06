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
	if(isset($_POST['searchbooks']) || isset($_POST['searcharticles']) || isset($_POST['searchmagazines'])){
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

	<div>
		<h3 id="reasultsHeader">Αποτελέσματα Αναζήτησης</h3>
	
	</div>

	
	<hr class="style-seven">
	<div>
		<div class="table-responsive">  
	    	<table id="results-grid" class="table ">
	    	
	    	<?php
	    	
	    	$material = new Material();
	    	//$material = Material::get();
	    	$records_per_page=5;
	    	$newquery = $material->paging($_SESSION['last_query'],$records_per_page);
	    	$material->results_view($newquery, $_SESSION['last_terms']);
	    	$material->paginglink($_SESSION['last_query'],$_SESSION['last_terms'],$records_per_page);
	    	
	    		
	 		?> 
				
			</table>
			<?php
			if(!isset($_SESSION['username'])) {
				?>
				<a href="?page=login_signup" id="confirmLoan-Button" type="button" class="btn btn-default">Επιβεβαίωση Δανεισμού
				<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			<?php }
			
			else {
				
				?>
				<a class="btn btn-primary"  href="?page=confirmLoan" id="confirmLoan-Button">Επιβεβαίωση Δανεισμού
					<span class="glyphicon glyphicon-chevron-right"></span> 
				</a>
			<?php 
			}
			?> 
		</div>
		
   	</div>

</div>

<script>

function addToCart(id, title){
/**
 * addToCart send's an ajax request to add an item to cart
 * Duplicate variable determines if the user tries to add an item that already exists in the cart
 */
	var duplicate = 0;
	$("tr.cart-items").each(function() {
        var upper_id = $(this).find("#upper-cart-id").val();
        
         if(upper_id == id){
        	duplicate = 1;
			return false; 
          }
         
	});
		
	if(duplicate == 1){
		
		var message = "Το αντικείμενο " + " << " + title + " >> " + " περιέχεται ήδη στο καλάθι σας!";
		error_messages(message);
		if ( $('#details-material-modal').is(':visible') ) {
			closeModal();
		}
	}
	else {
			$.ajax({
				  url: window.location.href,
				  type: "POST", 
				  data:{action : "add", materialID : id},
				  success: function(response) {
					location.reload(true);
				  },
				  error: function(xhr) {
				    
				  }
				});

	}
		
}




$("#confirmLoan-Button").on("click", function (e) {
	   e.preventDefault(); 
	   	if($("#cart i").html() == "( 0 )"){
		  
		   var message = "Παρακαλώ γεμίστε πρώτα το καλάθι σας";
		   error_messages(message);

		} 
	   	else if($(this).attr('href') == "?page=login_signup"){
		   	
		   window.location.href = "?page=login_signup";
		}
		else {
			
			window.location.href = "?page=confirmLoan";
			
		}
	});

</script>

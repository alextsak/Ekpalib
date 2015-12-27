<?php
//session_start(); 
error_reporting(E_ALL);
include_once './database/Model/Material.php';

if(isset($_POST['searchbooks'])){


	$_SESSION['genre'] = 'books';
	$_SESSION['term'] = $_POST['term'];


	if($_POST['keyword'] == 'key'){
		$_SESSION['keyword'] = 'title';
	} else {
		$_SESSION['keyword'] = $_POST['keyword'];
	}
}


if(isset($_GET['action']) && $_GET['action']=="add"){

	$materialID=intval($_GET['materialID']);

	if(!isset($_SESSION['cart'][$materialID])){

		/* make query to database and set the session accordingly */
		$material = new Material();
		$material->query_data_to_cart($materialID, $_SESSION['genre']);
	}

}



?>

<div>
	<div>
		<h3 id="reasultsHeader">Search Results</h3>
		<?php  if(isset($message)){ 
            echo "<h3 style=\"color:red;\">$message</h3>"; 
        	}  
        ?>
	</div>
	<div>
		<table id="sidebar-table">
			<?php 
			echo "<h4>My Cart</h4>";
			if(isset($_SESSION['cart'])){
				$material = new Material();
				$material->add_to_sidebar_cart($_SESSION['genre']);
			}
			else { 
          
        		echo "<p>Your Cart is empty. Please add some products.</p>"; 
          	} 
			
			
			
			?>
		</table>
	
	</div>
	<div style="border-style: solid; border-top: thick double #000000;"></div>
	<div >
    	<table id="results-grid">
    	<?php   		
       		$material = new Material();
       		$records_per_page=5;
       		
       		$query = $material->query_easy_search($_SESSION['term'], $_SESSION['genre'],$_SESSION['keyword']);
       		$newquery = $material->paging($query,$records_per_page);
       		$material->dataview($newquery, $_SESSION['term']);
       		$material->paginglink($query,$_SESSION['term'],$records_per_page);
 		?> 
			
		</table>
		<div>
			<a href="?page=confirmLoan"   id="confirmLoan-Button" type="button" class="btn btn-default">Confirm Loan
      			<span class="glyphicon glyphicon-chevron-right"></span> 
    		</a>
		</div>
   	</div>
</div>

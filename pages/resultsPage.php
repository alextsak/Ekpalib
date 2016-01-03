<?php
//session_start(); 
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
	<div >
    	<table id="results-grid">
    	<?php   		
       		$material = new Material();
       		$records_per_page=5;
       		
       		$query = $material->query_easy_search($_SESSION['term'], $_SESSION['genre'],$_SESSION['keyword']);
       		$newquery = $material->paging($query,$records_per_page);
       		$material->results_view($newquery, $_SESSION['term']);
       		$material->paginglink($query,$_SESSION['term'],$records_per_page);
 		?> 
			
		</table>
		<div>
			<a href="?page=confirmLoan" id="confirmLoan-Button" type="button" class="btn btn-default">Επιβεβαίωση Δανεισμού
      			<span class="glyphicon glyphicon-chevron-right"></span> 
    		</a>
		</div>
   	</div>
</div>

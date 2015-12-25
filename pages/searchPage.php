<?php
session_start(); 
error_reporting(E_ALL);
include_once './database/Model/Material.php';

if(isset($_POST['searchbutton'])){
	$_SESSION['term'] = $_POST['term'];
	$_SESSION['genre'] = 'books';
	$_SESSION['keyword'] = $_POST['keyword'];
	if($_SESSION['keyword'] == 'FT*'){
		$_SESSION['keyword'] = 'title';
	}
}

?>

<div>
	<div>
		<h3 id="reasultsHeader">Search Results</h3>
	</div>
	<div >
    	<table>
    	<?php 
			      
			       
			       
			       		
			       		$material = new Material();
			       		$records_per_page=5;
			       		
			       		$query = $material->create_query($_SESSION['term'], $_SESSION['genre'],$_SESSION['keyword']);
			       		$newquery = $material->paging($query,$records_per_page);
			       		$material->dataview($newquery, $_SESSION['term']);
			       		$material->paginglink($query,$_SESSION['term'],$records_per_page);
			       
			     
			       ?> 
			
		</table>
   	</div>
	
</div>
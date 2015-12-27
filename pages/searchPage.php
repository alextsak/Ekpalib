<?php
session_start(); 
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


?>
<script type="text/javascript">
console.log("document.URL : "+document.URL);
console.log("document.location.href : "+document.location.href);
console.log("document.location.origin : "+document.location.origin);
console.log("document.location.hostname : "+document.location.hostname);
console.log("document.location.host : "+document.location.host);
console.log("document.location.pathname : "+document.location.pathname);
</script>
<div>
	<div>
		<h3 id="reasultsHeader">Search Results</h3>
	</div>
	<div >
    	<table id="results-grid">
    	<?php   		
       		$material = new Material();
       		$records_per_page=5;
       		
       		$query = $material->create_query($_SESSION['term'], $_SESSION['genre'],$_SESSION['keyword']);
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

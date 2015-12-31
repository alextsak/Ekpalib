<?php 
//session_start();
error_reporting(E_ALL);
if(isset($_POST['empty_cart'])){
	foreach($_SESSION['cart'] as $key => $val) {
		unset($_SESSION['cart'][$key]);
	}
	if(count($_SESSION['cart']) == 0) {
		unset($_SESSION['cart']);
	}
}
?>


<div>
	<div>
		<h3 id="reasultsHeader">Επιβεβαίωση Δανεισμού</h3>
		<form method="post" action="?page=searchPage"> 
		<button type="submit" class="btn btn-primary" name="empty_cart">Καθαρισμός Καροτσιού</button> 
		</form> 		 
		
	</div>
	<div >
    	<table>
			
			
			<?php 
        			$material = new Material();
        			$material->create_mycart($_SESSION['genre']);
       		 ?> 
		</table>
		<div>
			<a href="?page=confirmLoan" id="confirmLoan-Button" type="button" class="btn btn-default">Δανεισμός
      			<span class="glyphicon glyphicon-chevron-right"></span> 
    		</a>
		</div>
   	</div>
</div>
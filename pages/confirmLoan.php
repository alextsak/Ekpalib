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
<style>
#searchContainer{
	margin-bottom:30px;
	border: 1px solid black;
	border-radius: 10px;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	height:200px;
	border-style: double
}
</style>

<h4 style="margin-left:400px;text-decoration: underline;margin-bottom: 25px;">Αναζήτηση βιβλίων, περιοδικών και άρθρων</h4>

<div id="searchContainer" class="col-xs-12">
		<table>
			<?php 
        			$material = new Material();
        			$material->create_mycart($_SESSION['genre']);
       		 ?> 
		</table>
</div>


	<!-- <div>
		<h3 id="reasultsHeader">Επιβεβαίωση Δανεισμού</h3>
		<form method="post" action="?page=searchPage"> 
		<button type="submit" class="btn btn-primary" name="empty_cart">Καθαρισμός Καροτσιού</button> 
		</form> 		 
		
	</div> -->
	<!-- <div >
    	
		<div>
			<a href="?page=confirmLoan" id="confirmLoan-Button" type="button" class="btn btn-default">Δανεισμός
      			<span class="glyphicon glyphicon-chevron-right"></span> 
    		</a>
		</div>
   	</div> -->

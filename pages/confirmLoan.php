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

#loan-Button{
    position: relative;
    float: right;
}

</style>

<h3 style="margin-left:450px;">Επιβεβαίωση Δανεισμού</h3>
<hr class="style-seven">
<div>
		<table>
		<tbody>
			<?php 
        			$material = new Material();
        			$material->create_mycart($_SESSION['genre']);
       		 ?> 
       	</tbody>
		</table>
		
		<div class="checkbox" style="position: relative;left: 450px;top: 30px;">
		  <label>
		  	<input id="terms" type="checkbox" value=""><a href="#"> Αποδοχέχομαι τους όρους δανεισμού</a>
		  </label>
		</div>
		
		<div>
			<a href="#" id="loan-Button" type="button" class="btn btn-default">Δανεισμός
      			<span class="glyphicon glyphicon-chevron-right"></span> 
    		</a>
		</div>
		
</div>
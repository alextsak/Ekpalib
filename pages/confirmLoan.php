<?php 
//session_start();
error_reporting(E_ALL);


if(isset($_SESSION['cart'])){
	$id_array = array();
	
	foreach ($_SESSION['cart'] as $item_array) {
		foreach($item_array as $key=>$value){
			if($key == "id"){
				array_push($id_array, $value);
			}
		}
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
		  	<input id="terms" type="checkbox" value=""><a href="#"> Αποδέχομαι τους όρους δανεισμού</a>
		  </label>
		</div>
		
		<div>
			<a href="javascript:loan_request('<?php echo htmlspecialchars(json_encode($id_array)); ?>','<?php echo htmlspecialchars($_SESSION['username']); ?>');" id="loan-Button" type="button" class="btn btn-default">Δανεισμός
      			<span class="glyphicon glyphicon-chevron-right"></span> 
    		</a>
		</div>
		<div>
	
		
		</div>
		
</div>
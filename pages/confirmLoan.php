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
<?php if(isset($_SESSION['cart'])){ ?>
<h3 style="margin-left:450px;">Επιβεβαίωση Δανεισμού</h3>
<hr class="style-seven">
<div>
		<div class="table-responsive">  
	    	<table class="table" id="confirmLoan-grid">
				<thead>
		         	<tr>
		         		<th><?php echo 'Τίτλος';?></th>
         	      		<th><?php echo 'Κατηγορία';?></th>
         	      		<th><?php echo 'Βιβλιοθήκη';?></th>
         	      		<th><?php echo 'Διαθεσιμότητα';?></th>
         	      		<th><?php echo 'Ημέρες Δανεισμού';?></th>
         	      		<th><?php echo 'Επιλογές'?></th>
		         	</tr>
		        </thead>
		        <tbody>
				<?php 
	        			
	        				
	        				$id_array = array();
	        				
	        				foreach ($_SESSION['cart'] as $item_array) {
	        					foreach($item_array as $key=>$value){
	        						if($key == "id"){
	        							array_push($id_array, $value);
	        						}
	        					}
	        				}
	        				foreach($_SESSION['cart'] as $key=>$value){
	        					 
	        					?><tr>
	        						<td><?php echo $_SESSION['cart'][$key]['title']; ?></td>
	        						<td><?php echo $_SESSION['cart'][$key]['category']; ?></td>
	        						<td><a href="javascript:detailsLibrary(<?php echo $_SESSION['cart'][$key]['library']; ?>)"><?php echo $_SESSION['cart'][$key]['library']; ?></a></td>
	        						<td><?php echo $_SESSION['cart'][$key]['availability']; ?></td>
	        						<td><?php echo $_SESSION['cart'][$key]['available_days']; ?></td>
	        						<td style="width:120px;">
	        						<button class="btn btn-primary btn-sm" type="button" onclick="detailsbook(<?php echo $_SESSION['cart'][$key]['id'];?>)">
	        							<span class="glyphicon glyphicon-info-sign" ></span>
	        						</button>
	        						&nbsp | &nbsp
	        						<button class="btn btn-warning btn-sm" type="button">
	        							<span class="glyphicon glyphicon-new-window" ></span>
	        						</button>
	        						</td>
	        					</tr>
	        					<?php 
	        				}
	        				
	        			
	        			
	       		?> 
       			</tbody>
		</table>
		<div class="checkbox" >
		  <label style="position: relative;left: 40%;">
		  	<input id="terms" type="checkbox" value=""><a href="#"> Αποδέχομαι τους όρους δανεισμού</a>
		  </label>
		  <a href="javascript:loan_request('<?php echo htmlspecialchars(json_encode($id_array)); ?>','<?php echo htmlspecialchars($_SESSION['username']); ?>');" id="loan-Button" type="button" class="btn btn-default">Δανεισμός
      			<span class="glyphicon glyphicon-chevron-right"></span> 
    		</a>
		</div>
	</div>
</div>

<?php 
}
else {
?>
<h4 style="margin-left:450px;">Το καλάθι σας είναι άδειο</h3>
<h5 style="margin-left:450px;">Παρακαλώ επιστρέψτε στην <a href="index.php">Αρχική</a> ή στην Προηγούμενη Σελίδα σας από το μονοπάτι</h5>

<?php }?>

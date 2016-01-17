<?php

// take the user and ask question to the database for his history
$username = $_SESSION['username'];
$user = new User();
$user_results = $user->get_user_transactions($username);
$user_results_history = $user->get_user_history($username);
?>

<div>
	<div>
		<h3 id="reasultsHeader">Πρόσφατες Αιτήσεις</h3>
 	</div>
 	
 	<hr class="style-seven">
	<div class="table-responsive"> 
    	<table class="table" id="results-grid">
    	<tbody>
    		<thead>
         		<tr>
         			<th><?php echo 'Τίτλος';?></th>
         	      	<th><?php echo 'Κατηγορία';?></th>
         	      	<th><?php echo 'Συγγραφέας(εις)';?></th>
         	      	<th><?php echo 'ISBN';?></th>
         	      	<th><?php echo 'Βιβλιοθήκη';?></th>
      				<th><?php echo 'Hμέρα Δανεισμού';?>
      				<th><?php echo 'Hμέρα Επιστροφής';?>
         	      	<th><?php echo 'Επιλογές'?></th>
         	   	</tr>
         	 </thead>
    		<?php 
    			if($user_results == "No data found"){
    				?>
                	<tr>
                		<td><?php echo "Δεν υπάρχουν πρόσφατοι δανεισμοί";?></td>
                	</tr>
                <?php	

    			}
    			else {
    				while($row = $user_results){
    					
    					$material = new Material();
    					$library = $material->get_material_library($row['MaterialID']);
    					$lib_name = '';
    					if($library != -1) {
    						$lib_name = $library['Name'];
    					}
    					
    					
    				}

    			}
    		?>
   		</tbody>
 		</table>
 	</div>
 	
 	<div>
		<h3 id="reasultsHeader">Δανεισμοί</h3>
 	</div>
 	
 	<hr class="style-seven">
	<div class="table-responsive"> 
    	<table class="table" id="results-grid">
    	<tbody>
    		<thead>
         		<tr>
         			<th><?php echo 'Τίτλος';?></th>
         	      	<th><?php echo 'Κατηγορία';?></th>
         	      	<th><?php echo 'Συγγραφέας(εις)';?></th>
         	      	<th><?php echo 'ISBN';?></th>
         	      	<th><?php echo 'Βιβλιοθήκη';?></th>
      				<th><?php echo 'Hμέρα Δανεισμού';?>
      				<th><?php echo 'Hμέρα Επιστροφής';?>
         	      	<th><?php echo 'Επιλογές'?></th>
         	   	</tr>
         	 </thead>
    		<?php 
    			if($user_results == "No data found"){
    				?>
                	<tr>
                		<td><?php echo "Δεν υπάρχουν πρόσφατοι δανεισμοί";?></td>
                	</tr>
                <?php	

    			}
    			else {
    				while($row = $user_results_history){
    					
    					$material = new Material();
    					$library = $material->get_material_library($row['MaterialID']);
    					$lib_name = '';
    					if($library != -1) {
    						$lib_name = $library['Name'];
    					}
    					
    					
    				}

    			}
    		?>
   		</tbody>
 		</table>
 	</div>
 	
</div>
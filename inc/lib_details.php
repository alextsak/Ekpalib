<?php 
require_once '../database/ConnectionDB/dbConnection.php';
require_once '../database/Model/Libraries.php';
$lib_id = $_POST['id'];
$lib_id = (int)$lib_id;
$libraries = new Libraries();
$libs = $libraries->get_library_details($lib_id);
$row=$libs->fetch(PDO::FETCH_ASSOC);
?>


<?php ob_start(); ?>
<style>

.align-desc * {
    vertical-align: middle;
}



</style>
<div class="modal fade library-details-modal" id="library-details-modal" tabindex="-1"
	role="dialog" aria-labelledby="details-material-modal" aria-hidden="true">
	<div class="modal-dialog" >
		<div class="modal-content" style="background-color: #520000;width:700px;">
		    <div class="modal-header">
		        <h3 ><?php echo $row['Name'] ?></h3>
		    </div>
		    <div class="modal-body" style="background-color: #5B2A2A;margin: 10px; border-radius: 10px;">
		        <div class="tabbable"> 
			        <ul class="nav nav-tabs" style="background-color:#B8742D;">
			        	<li class="active" ><a href="#tab1" data-toggle="tab"style="color:white;">Προσωπικό</a></li>
			        	<li><a href="#tab2" data-toggle="tab"style="color:white">Γενικές Πληροφορίες</a></li>
			        	<li><a href="#tab3" data-toggle="tab"style="color:white">Συλλογή</a></li>
			        	<li><a href="#tab4" data-toggle="tab"style="color:white">Υπηρεσίες</a></li>
			        	<li><a href="#tab5" data-toggle="tab"style="color:white">Ιστοσελίδα</a></li>
			        </ul>
			        
			        <div class="tab-content" >
			        	<div class="tab-pane active" id="tab1" style="color:white;margin-top: 10px;">
			            	<?php echo nl2br ( $row['faculty']  )?>
			        	</div>
			        	<div class="tab-pane" id="tab2" style="color:white;margin-top: 10px;">
			        		<?php echo nl2br( $row['information']) ?>
			        	</div>
			        	<div class="tab-pane" id="tab3" style="color:white;margin-top: 10px;">
			        		<?php echo nl2br($row['collection']) ?>
			        	</div>
			        	<div class="tab-pane" id="tab4" style="color:white;margin-top: 10px;">
			        		<?php echo nl2br($row['services']) ?>
			        	</div>
			        	<div class="tab-pane" id="tab5" style="color:white;margin-top: 10px;">
			        		<?php echo nl2br($row['services']) ?>
			        	</div>
			        </div>
		        </div>
		   </div>
		   <div class="modal-footer">
		         <button id="modal-button" class="btn btn-default"  onclick="closeModal()">Κλείσιμο</button>
		   </div>
		</div>
	</div>
</div>
<script type="text/javascript">

	function closeModal(){
		jQuery('#library-details-modal').modal('hide');
		setTimeout(function(){
			jQuery('#library-details-modal').remove();
			jQuery('.modal-backdrop').remove();
			},500);
		}




</script>

<?php echo ob_get_clean(); ?>

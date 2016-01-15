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
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-header">
		    <button class="close" type="button" aria-label="Close"  onclick="closeModal()">
					<span aria-hidden="true">&times;</span>
				</button>
		        <h3 style="color:black"><?php echo $row['Name'] ?></h3>
		    </div>
		    <div class="modal-body">
		        <div class="tabbable"> 
			        <ul class="nav nav-tabs">
			        	<li class="active"><a href="#tab1" data-toggle="tab">Προσωπικό</a></li>
			        	<li><a href="#tab2" data-toggle="tab">Γενικές Πληροφορίες</a></li>
			        	<li><a href="#tab3" data-toggle="tab">Συλλογή</a></li>
			        	<li><a href="#tab4" data-toggle="tab">Υπηρεσίες</a></li>
			        </ul>
			        
			        <div class="tab-content">
			        	<div class="tab-pane active" id="tab1">
			            	<?php echo $row['faculty'] ?>
			        	</div>
			        	<div class="tab-pane" id="tab2">
			        		<?php echo $row['information'] ?>
			        	</div>
			        	<div class="tab-pane" id="tab3">
			        		<?php echo $row['collection'] ?>
			        	</div>
			        	<div class="tab-pane" id="tab4">
			        		<?php echo $row['services'] ?>
			        	</div>
			        </div>
		        </div>
		   </div>
		   <div class="modal-footer">
		         <button class="btn btn-default"  onclick="closeModal()">Κλείσιμο</button>
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

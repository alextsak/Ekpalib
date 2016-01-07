<?php 
require_once '../database/ConnectionDB/dbConnection.php';
require_once '../database/Model/Libraries.php';
$lib_id = $_POST['id'];
$lib_id = (int)$lib_id;
$libraries = new Libraries();
$libs = $libraries->get_library_details($lib_id);
?>


<?php ob_start(); ?>
<style>

.align-desc * {
    vertical-align: middle;
}

</style>
<div class="modal fade" id="library-details-modal" >
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-header">
		        <h3>'Ονομα βιβλιοθηκης</h3>
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
			            	Data 1
			        	</div>
			        	<div class="tab-pane" id="tab2">
			        		<p>Data 2</p>
			        	</div>
			        	<div class="tab-pane" id="tab3">
			        		<p>Data 3</p>
			        	</div>
			        	<div class="tab-pane" id="tab4">
			        		<p>Data 4</p>
			        	</div>
			        </div>
		        </div>
		   </div>
		   <div class="modal-footer">
		         <a href="#" class="btn btn-primary" onclick="closeModal();">Close</a>
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

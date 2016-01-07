<?php 
require_once '../database/ConnectionDB/dbConnection.php';
require_once '../database/Model/Libraries.php';
$lib_id = $_POST['id'];
$lib_id = (int)$lib_id;

?>


<?php ob_start(); ?>
<style>

.align-desc * {
    vertical-align: middle;
}

</style>
<div class="modal fade library-details-modal" id="library-details-modal" tabindex="-1"
	role="dialog"  aria-labelledby="windowTitleLabel"> aria-hidden="true">

    <div class="modal-header">
        <h3>Task List</h3>
        </div>
    <div class="modal-body">
        <div class="tabbable"> <!-- Only required for left/right tabs -->
        <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab">Section 1</a></li>
        <li><a href="#tab2" data-toggle="tab">Section 2</a></li>
        </ul>
        <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            Data 1
        </div>
        <div class="tab-pane" id="tab2">
        	<p>Data 2.</p>
        </div>
        </div>
        </div>
   </div>
   <div class="modal-footer">
         <a href="#" class="btn btn-primary" onclick="CloseTaskList();">Close</a>
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

<?php 
/**
 * Create's and send's an object with the material details
 * 
 */

require_once '../database/ConnectionDB/dbConnection.php';
require_once '../database/Model/Material.php';
require_once '../utilities/helpers.php';
$material_id = $_POST['id'];
$page_title = $_POST['page_title'];
$material_id = intval($material_id);

$flag = 0;
$material = new Material();
$genre = $material->materialBelongsToTable($material_id);
if($genre == "books"){
	$flag = 1;
}
$stmt = $material->fetch_material_details($material_id);

if($stmt->rowCount() == 0) {
	
	$message = "Πρόβλημα με τις λεπτομέρειες του Υλικού";
	echo "<script>error_messages('$message');</script>";
}

	$library = $material->get_material_library($material_id);
	$lib_name = '';
	if($library != -1) {
		$lib_name = $library['Name'];
	}
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	?>


<?php ob_start(); ?>
<style>

.align-desc * {
    vertical-align: middle;
}
/* custom inclusion of right, left and below tabs */

.tabs-below > .nav-tabs,
.tabs-right > .nav-tabs,
.tabs-left > .nav-tabs {
  border-bottom: 0;
}

.tab-content > .tab-pane,
.pill-content > .pill-pane {
  display: none;
}

.tab-content > .active,
.pill-content > .active {
  display: block;
}

.tabs-below > .nav-tabs {
  border-top: 1px solid #ddd;
}

.tabs-below > .nav-tabs > li {
  margin-top: -1px;
  margin-bottom: 0;
}

.tabs-below > .nav-tabs > li > a {
  -webkit-border-radius: 0 0 4px 4px;
     -moz-border-radius: 0 0 4px 4px;
          border-radius: 0 0 4px 4px;
}

.tabs-below > .nav-tabs > li > a:hover,
.tabs-below > .nav-tabs > li > a:focus {
  border-top-color: #ddd;
  border-bottom-color: transparent;
}

.tabs-below > .nav-tabs > .active > a,
.tabs-below > .nav-tabs > .active > a:hover,
.tabs-below > .nav-tabs > .active > a:focus {
  border-color: transparent #ddd #ddd #ddd;
}

.tabs-left > .nav-tabs > li,
.tabs-right > .nav-tabs > li {
  float: none;
}

.tabs-left > .nav-tabs > li > a,
.tabs-right > .nav-tabs > li > a {
  min-width: 74px;
  margin-right: 0;
  margin-bottom: 3px;
}

.tabs-left > .nav-tabs {
  float: left;
  margin-right: 19px;
  border-right: 1px solid #ddd;
}

.tabs-left > .nav-tabs > li > a {
  margin-right: -1px;
  -webkit-border-radius: 4px 0 0 4px;
     -moz-border-radius: 4px 0 0 4px;
          border-radius: 4px 0 0 4px;
}

.tabs-left > .nav-tabs > li > a:hover,
.tabs-left > .nav-tabs > li > a:focus {
  border-color: #eeeeee #dddddd #eeeeee #eeeeee;
}

.tabs-left > .nav-tabs .active > a,
.tabs-left > .nav-tabs .active > a:hover,
.tabs-left > .nav-tabs .active > a:focus {
  border-color: #ddd transparent #ddd #ddd;
  *border-right-color: #ffffff;
}

.tabs-right > .nav-tabs {
  float: right;
  margin-left: 19px;
  border-left: 1px solid #ddd;
}

.tabs-right > .nav-tabs > li > a {
  margin-left: -1px;
  -webkit-border-radius: 0 4px 4px 0;
     -moz-border-radius: 0 4px 4px 0;
          border-radius: 0 4px 4px 0;
}

.tabs-right > .nav-tabs > li > a:hover,
.tabs-right > .nav-tabs > li > a:focus {
  border-color: #eeeeee #eeeeee #eeeeee #dddddd;
}

.tabs-right > .nav-tabs .active > a,
.tabs-right > .nav-tabs .active > a:hover,
.tabs-right > .nav-tabs .active > a:focus {
  border-color: #ddd #ddd #ddd transparent;
  *border-left-color: #ffffff;
}

#spinner {
	width: 40px;
	color: #000;
	text-align: center;
}

</style>
<div class="modal fade details-material-modal" id="details-material-modal" tabindex="-1"
	role="dialog" aria-labelledby="details-material-modal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="background-color: #520000;">
			<div class="modal-header">
				<button class="close" type="button" style="color:#fff;" aria-label="Close"  onclick="closeModal()">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title text-center" style="color:white;"><?php echo $result['title'];?></h4>
			</div>
			<div class="modal-body" style="background-color: #5B2A2A;margin: 10px; border-radius: 10px;">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-6">
							<div class="center-block">
								<img src="<?php if($flag == 1){
									echo $result['image'];
									} else {
										echo './images/covers/Not_available.jpg';
									}
									
									?> " alt="Μη διαθέσιμο εξώφυλλο"
									class="details img-responsive">
							</div>
						</div>

						<div class="col-md-6">
							<div class="tabbable tabs-left"> 
						        <ul class="nav nav-tabs"  data-tabs="tabs" style="background-color:#B8742D;">
						        	<?php 
						            if($flag == 1){
									?>
						        	<li  ><a href="#tab1" data-toggle="tab" style="color:white;">ISBN</a></li>
						        	<?php }?>
						        	<li><a href="#tab2" data-toggle="tab" style="color:white">Συγγραφέας-εις</a></li>
						        	<li><a href="#tab3" data-toggle="tab" style="color:white">Βιβλιοθήκη</a></li>
						        	<?php 
						            if($flag == 1){
									?>
						        	<li><a href="#tab4" data-toggle="tab" style="color:white">Εκδόσεις</a></li>
						        	<?php }?>
						        	<li><a href="#tab5" data-toggle="tab" style="color:white">Κατηγορία</a></li>
						        	<?php 
						            if($flag == 1){
									?>
						        	<li class="active"><a href="#tab6" data-toggle="tab" style="color:white">Περιγραφή</a></li>
						        	<?php }?>
						        	<li><a href="#tab7" data-toggle="tab" style="color:white">Διαθεσιμότητα</a></li>
						        	
						        	
						        </ul>
						        
						        <div class="tab-content" >
						        	<div class="tab-pane " id="tab1" style="color:white;margin-top: 10px;">
						            	<?php 
						            	if($flag == 1){
										?>
										<?php echo $result['isbn'];?>
										<?php }?>
						        	</div>
						        	<div class="tab-pane" id="tab2" style="color:white;margin-top: 10px;">
						        		<?php
											echo $result['Name'];
											echo " ";
											echo $result['Surname'];
											
											while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
												echo " - ";
												echo $result['Name'];
												echo " ";
												echo $result['Surname'];
											}
										?>
						        	</div>
						        	<div class="tab-pane" id="tab3" style="color:white;margin-top: 10px;">
						        		<?php echo $lib_name;?>
						        	</div>
						        	<?php 
						            if($flag == 1){
									?>
						        	<div class="tab-pane" id="tab4" style="color:white;margin-top: 10px;">
						        		<?php echo $result['publisher'];?>
						        	</div>
						        	<?php }?>
						        	<div class="tab-pane" id="tab5" style="color:white;margin-top: 10px;">
						        		<?php echo $result['category'];?>
						        	</div>
						        	<?php 
						            if($flag == 1){
									?>
						        	<div class="tab-pane active" id="tab6" style="color:white;margin-top: 10px;">
						        		<?php echo nl2br($result['description']);?>
						        	</div>
						        	<?php }?>
						        	<div class="tab-pane" id="tab7" style="color:white;margin-top: 10px;">
						        		<?php echo $result['availability'];?>
						        	</div>
						        	
						        	
						        </div>
					        </div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="modal-button" class="btn btn-default"  onclick="closeModal()">Κλείσιμο</button>
				
				<?php if($page_title != "Ιστορικό Χρήστη" && $page_title != "Επιβεβαίωση Δανεισμού") {?>
				<button class="btn btn-warning" type="submit" onClick="addToCart(<?php echo $result['MaterialID'];?>,'<?php echo $result['title'];?>')">
					<span class="glyphicon glyphicon-shoppinng-cart"></span>Προσθήκη στο Καλάθι
				</button>
				<?php } ?>
				
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

	function closeModal(){
		jQuery('#details-material-modal').modal('hide');
		setTimeout(function(){
			jQuery('#details-material-modal').remove();
			jQuery('.modal-backdrop').remove();
			},500);
		}
	var current_val = parseInt($('#spinner').val());
	$('#spinner').spinner({
		max: current_val + 7,
		min: current_val,
		step: 1
	});

</script>

<?php echo ob_get_clean(); ?>

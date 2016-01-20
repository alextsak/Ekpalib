<?php 
require_once '../database/ConnectionDB/dbConnection.php';
require_once '../database/Model/Material.php';

$username = $_POST['username'];
$materialID = $_POST['materialID'];
$materialID = intval($materialID);
$material = new Material();
$flag = 0;

$genre = $material->materialBelongsToTable($materialID);
if($genre == "books"){
	$flag = 1;
}
$stmt = $material->fetch_material_details($materialID);

if($stmt->rowCount() == 0) {
	//echo "Error bookdetails line 10";
	$message = "Πρόβλημα με τις λεπτομέρειες του Υλικού";
	echo "<script>error_messages('$message');</script>";
}

	$library = $material->get_material_library($materialID);
	$lib_name = '';
	if($library != -1) {
		$lib_name = $library['Name'];
	}
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	?>


<?php ob_start(); ?>
<style>
.spinner {
  width: 100px;
}
.spinner input {
  text-align: right;
}
.input-group-btn-vertical {
  position: relative;
  white-space: nowrap;
  width: 1%;
  vertical-align: middle;
  display: table-cell;
}
.input-group-btn-vertical > .btn {
  display: block;
  float: none;
  width: 100%;
  max-width: 100%;
  padding: 8px;
  margin-left: -1px;
  position: relative;
  border-radius: 0;
}
.input-group-btn-vertical > .btn:first-child {
  border-top-right-radius: 4px;
}
.input-group-btn-vertical > .btn:last-child {
  margin-top: -2px;
  border-bottom-right-radius: 4px;
}
.input-group-btn-vertical i{
  position: absolute;
  top: 0;
  left: 4px;
}
</style>
<div class="modal fade expansion-modal" id="expansion-modal" tabindex="-1"
		role="dialog" aria-labelledby="expansion-modal" aria-hidden="true">
		<div class="modal-dialog modal-lg">
		<div class="modal-content">
		<div class="modal-header">
		<button class="close" type="button" aria-label="Close"  onclick="closeModal()">
		<span aria-hidden="true">&times;</span>
		</button>
		<h4 class="modal-title text-center" style="color:navy;">Επέκταση Δανεισμού</h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-6">
							<div class="center-block">
								<img src="<?php echo $result['image']?>" alt="Μη διαθέσιμο εξώφυλλο"
									class="details img-responsive">
							</div>
						</div>

						
						<div class="col-sm-6">
							<h4 style="color:navy;text-align:center;text-decoration: underline;">Λεπτομέρειες</h4>
							<?php 
							if($flag == 1){
							?>
							<p style="color:black"><span style="color:navy;font-weight: bold;">ISBN:</span> <?php echo $result['isbn'];?></p>
							<?php }?>
							<p style="color:black"><span style="color:navy;font-weight: bold;">Συγγραφέας-εις:</span> 
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
							?></p>
							
							<p style="color:black"><span style="color:navy;font-weight: bold;">Βιβλιοθήκη:</span> <?php echo $lib_name;?></p>
							<hr>
							<?php if($flag == 1){ ?>
							<p style="color:black"><span style="color:navy;font-weight: bold;">Εκδόσεις:</span> <?php echo $result['publisher'];?></p>
							<?php } ?>
							<p style="color:black"><span style="color:navy;font-weight: bold;">Κατηγορία:</span> <?php echo $result['category'];?></p>
							<?php if($flag == 1){ ?>
							<p class="align-desc" style="color:black">
								<label for="textarea" style="color:navy;font-weight: bold;">Περιγραφή:</label>
							 	<textarea id="textarea" rows="4" cols="40" >
							 		<?php echo $result['description'];?>
							 	</textarea>
							 </p>
							 <?php } ?>
							<p style="color:black;"><span style="color:navy;font-weight: bold;">Διαθεσιμότητα:</span> <?php echo $result['availability'];?></p>
						 	<div class="input-group spinner">
    							    <input type="number" id="spinId" class="form-control" value="1">
    						        <div class="input-group-btn-vertical">
                                    <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-triangle-top"></i></button>
                                    <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-triangle-bottom"></i></button>
                                    </div>
                            </div>
      						
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
		jQuery('#expansion-modal').modal('hide');
		setTimeout(function(){
			jQuery('#expansion-modal').remove();
			jQuery('.modal-backdrop').remove();
			},500);
		}

	(function ($) {
		  $('.spinner .btn:first-of-type').on('click', function() {
			$('#spinId').spinner('option', 'min', 1);
			$('.spinner input').val( parseInt($('.spinner input').val(), 10) + 1);
		  });
		  $('.spinner .btn:last-of-type').on('click', function() {
			$('#spinId').spinner('option', 'max', 7); 
		    $('.spinner input').val( parseInt($('.spinner input').val(), 10) - 1);
		  });
		})(jQuery);


</script>

<?php echo ob_get_clean(); ?>

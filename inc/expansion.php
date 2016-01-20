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
								<img src="<?php echo $book['image']?>" alt="Μη διαθέσιμο εξώφυλλο"
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
							<p style="color:black"><span style="color:navy;font-weight: bold;">Διαθεσιμότητα:</span> <?php echo $result['availability'];?></p>
						 	
						 	<div class="row">
        						<div class="span4 collapse-group">
          						<h2>Heading</h2>
           						<p class="collapse">Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          						<p><a class="btn" href="#">View details &raquo;</a></p>
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
		jQuery('#details-material-modal').modal('hide');
		setTimeout(function(){
			jQuery('#details-material-modal').remove();
			jQuery('.modal-backdrop').remove();
			},500);
		}

	$('.row .btn').on('click', function(e) {
	    e.preventDefault();
	    var $this = $(this);
	    var $collapse = $this.closest('.collapse-group').find('.collapse');
	    $collapse.collapse('toggle');
	});



</script>

<?php echo ob_get_clean(); ?>

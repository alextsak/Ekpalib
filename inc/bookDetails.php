<?php 
require_once '../database/ConnectionDB/dbConnection.php';
require_once '../database/Model/Material.php';
$material_id = $_POST['id'];
$material_id = (int)$material_id;
$material = new Material();
$book = $material->fetch_material_details($material_id, 'books');

if($book == -1) {
	echo "Error bookdetails line 10";
}



?>


<?php ob_start(); ?>
<div class="modal fade details-material-modal" id="details-material-modal" tabindex="-1"
	role="dialog" aria-labelledby="details-material-modal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" aria-label="Close"  onclick="closeModal()">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title text-center"><?php echo $book['title'];?></h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-6">
							<div class="center-block">
								<img src="/Ekpalib/images/fr.png" alt="something"
									class="details img-responsive">
							</div>
						</div>

						<div class="col-sm-6">
							<h4 style="color:navy;text-align:center;">Λεπτομέρειες</h4>
							<p>Τίτλος: <?php echo $book['isbn'];?></p>
							<p>Συγγραφέας-εις: <?php echo $book['author'];?></p>
							<hr>
							
							<p>Εκδόσεις: <?php echo $book['publisher'];?></p>
							<p>Κατηγορία: <?php echo $book['category'];?></p>
							<p>Διαθεσιμότητα: <?php echo $book['availability'];?></p>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default"  onclick="closeModal()">Κλείσιμο</button>
				<button class="btn btn-warning" type="submit">
					<span class="glyphicon glyphicon-shoppinng-cart"></span>Add To Cart
				</button>
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

</script>

<?php echo ob_get_clean(); ?>

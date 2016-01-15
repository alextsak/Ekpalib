<?php 
require_once '../database/ConnectionDB/dbConnection.php';
require_once '../database/Model/Material.php';
$material_id = $_POST['id'];
$material_id = (int)$material_id;
$material = new Material();
$stmt = $material->fetch_material_details($material_id);

if($stmt == -1) {
	//echo "Error bookdetails line 10";
	$message = "Πρόβλημα με τις λεπτομέρειες του Υλικού";
	echo "<script>error_messages('$message');</script>";
}
$library = $material->get_material_library($material_id);
$lib_name = '';
if($library != -1) {
	$lib_name = $library['Name'];
}
$book = $stmt->fetch(PDO::FETCH_ASSOC);
?>


<?php ob_start(); ?>
<style>

.align-desc * {
    vertical-align: middle;
}

</style>
<div class="modal fade details-material-modal" id="details-material-modal" tabindex="-1"
	role="dialog" aria-labelledby="details-material-modal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" aria-label="Close"  onclick="closeModal()">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title text-center" style="color:navy;"><?php echo $book['title'];?></h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-6">
							<div class="center-block">
								<img src="<?php echo $book['image']?>" alt="something"
									class="details img-responsive">
							</div>
						</div>

						<div class="col-sm-6">
							<h4 style="color:navy;text-align:center;text-decoration: underline;">Λεπτομέρειες</h4>
							<p style="color:black"><span style="color:navy;font-weight: bold;">Τίτλος:</span> <?php echo $book['isbn'];?></p>
							<p style="color:black"><span style="color:navy;font-weight: bold;">Συγγραφέας-εις:</span> 
							<?php
							echo $book['Name'];
							echo " ";
							echo $book['Surname'];
							
							while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
								echo " - ";
								echo $row['Name'];
								echo " ";
								echo $row['Surname'];
							}
							?></p>
							
							<p style="color:black"><span style="color:navy;font-weight: bold;">Βιβλιοθήκη:</span> <?php echo $lib_name;?></p>
							<hr>
							
							<p style="color:black"><span style="color:navy;font-weight: bold;">Εκδόσεις:</span> <?php echo $book['publisher'];?></p>
							<p style="color:black"><span style="color:navy;font-weight: bold;">Κατηγορία:</span> <?php echo $book['category'];?></p>
							<p class="align-desc" style="color:black">
								<label for="textarea" style="color:navy;font-weight: bold;">Περιγραφή:</label>
							 	<textarea id="textarea" rows="4" cols="40" >
							 		<?php echo $book['description'];?>
							 	</textarea>
							 </p>
							<p style="color:black"><span style="color:navy;font-weight: bold;">Διαθεσιμότητα:</span> <?php echo $book['availability'];?></p>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default"  onclick="closeModal()">Κλείσιμο</button>
				<button class="btn btn-warning" type="submit" onClick="addToCart(<?php echo $book['MaterialID'];?>)">
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


	/* function addToCart(id){
		//console.log("book id: " + id);
		//console.log(window.location.href);
		$.ajax({
			  url: window.location.href,
			  type: "POST", //send it through get method
			  data:{action : "add", materialID : id},
			  success: function(response) {
				  location.reload(true);
				  closeModal();
			  },
			  error: function(xhr) {
			    //Do Something to handle error
			  }
			});
		} */

</script>

<?php echo ob_get_clean(); ?>

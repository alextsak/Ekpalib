<?php
require_once '../database/ConnectionDB/dbConnection.php';
require_once '../database/Model/Material.php';

$idArray = $_POST['idArray'];
$user = $_POST['user'];
$days_array = $_POST['request_days'];
$material = new Material();
$result = $material->confirmLoan($idArray, $user, $days_array);
$flag = 0;
$message = '';
switch ($result) {
	case "empty": $message = "Οι παράμετροι που υποβλήθηκαν είναι κενές";
					echo "<script>error_messages('$message');</script>";
					break;
					
	case "problem": $message = "Πρόβλημα στην καταχώρηση της αίτησης";
					echo "<script>error_messages('$message');</script>";
					break;
					
	case "inserted": $flag = 1;
					$message = "Η υποβολή του αιτήματος έγινε με επιτυχία";
					break;
	case "request_denied": 
	                $message = "Έχετε ήδη κάνει αίτηση για αυτό το βιβλίο.";
	                echo "<script>error_messages('$message');</script>";
	                break;	
					
	default: 
}
if($flag == 1){
	
	ob_start();
?>

<div class="modal fade success-loan-modal" id="success-loan-modal" tabindex="-1"
		role="dialog" aria-labelledby="success-loan-modal" aria-hidden="true">
		<div class="modal-dialog modal-lg">
		<div class="modal-content">
		<div class="modal-header">
		<button class="close" type="button" aria-label="Close"  onclick="closeModal()">
		<span aria-hidden="true">&times;</span>
		</button>
		<h3 class="modal-title text-center" style="color:navy;">Επιτυχές Αίτημα</h3>


		</div>
		<div class="modal-body">
				<div class="container-fluid">
					<div class="row">

					<div class="col-sm-12">
							<h4 class="bg-success text-center"><?php echo $message;?></h4>
							<h5 class="text-info text-center"><?php echo "Πατώντας το κουμπί <b>Συνέχεια</b> μπορείτε να μεταφερθείτε στην αρχική σελίδα σας"?></h5>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
		
				<button class="btn btn-default"  onclick="homeRedirect()">Συνέχεια</button>
			
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	function homeRedirect(){
		// clear first the modal and the send a request to clear the cart
		jQuery('#success-loan-modal').modal('hide');
		setTimeout(function(){
			jQuery('#success-loan-modal').remove();
			jQuery('.modal-backdrop').remove();
			},500);
		
		var data = {"action" : "removeAll"};
		var host = window.location.host;
		var protocol = window.location.protocol;
		var urlpath = protocol + "//" + host + "/Ekpalib/";
		jQuery.ajax({
			
			url : urlpath,
			method: "post",
			data : data,
			success : function(data){
				window.location.replace("");
			},
			error : function(){
				alert("Something went wrong");
			}

			});
		
		}

</script>

<?php 
echo ob_get_clean();
}?>
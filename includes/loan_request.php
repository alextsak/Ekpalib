<?php
/**
 * This script handle's the loan request.
 * If everything goes well then it send's back a successful response to the user
 * 
 */

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
		<div class="modal-dialog modal-lg" style="background-color: #520000;>
		<div class="modal-content">
		<div class="modal-header">
		<button class="close" type="button" style="color:#fff;" aria-label="Close"  onclick="closeModal()">
					<span aria-hidden="true">&times;</span>
				</button>
		<h3 class="modal-title text-center" style="color:white;">Επιτυχές Αίτημα</h3>


		</div>
		<div class="modal-body" style="background-color:#B8742D;margin: 10px; border-radius: 10px;">
				<div class="container-fluid">
					<div class="row">

					<div class="col-sm-12">
							<h4 class="text-info text-center" style="color:white;"><?php echo $message;?></h4>
							<h5 style="color:white;" class="text-info text-center"><?php echo "Πατώντας το κουμπί <b>Συνέχεια</b> μπορείτε να μεταφερθείτε στην αρχική σελίδα σας"?></h5>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
		
				<button id="modal-button" class="btn btn-default"  onclick="homeRedirect()">Συνέχεια</button>
			
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
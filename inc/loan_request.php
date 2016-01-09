<?php



?>

<div class="modal fade success-loan-modal" id="error-modal" tabindex="-1"
		role="dialog" aria-labelledby="success-loan-modal" aria-hidden="true">
		<div class="modal-dialog modal-lg">
		<div class="modal-content">
		<div class="modal-header">
		<button class="close" type="button" aria-label="Close"  onclick="closeModal()">
		<span aria-hidden="true">&times;</span>
		</button>
		<h3 class="modal-title text-center" >Επιτυχές Αίτημα</h3>


		</div>
		<div class="modal-body">
				<div class="container-fluid">
					<div class="row">

					<div class="col-sm-12">
							<h4 class="bg-success text-center"><?php echo $message;?></h4>
							
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default"  onclick="closeModal()">Συνέχεια</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	function closeModal(){
		jQuery('#error-modal').modal('hide');
		setTimeout(function(){
			jQuery('#error-modal').remove();
			jQuery('.modal-backdrop').remove();
			},500);
		}

</script>
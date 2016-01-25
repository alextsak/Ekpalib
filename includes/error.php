<?php 
$message = $_POST['message'];

?>
<?php ob_start(); ?>
<div class="modal fade error-modal" id="error-modal" tabindex="-1"
	role="dialog" aria-labelledby="error-modal" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="background-color: #520000;>
		<div class="modal-content" >
			<div class="modal-header">
				<button class="close" type="button" style="color:#fff;" aria-label="Close"  onclick="closeModal()">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title text-center" style="color:orange;">Προσοχή!</h3>
				
				
			</div>
			<div class="modal-body" style="background-color:#B8742D;margin: 10px; border-radius: 10px;">
				<div class="container-fluid">
					<div class="row">

						<div class="col-sm-12">
							<h4 class="bg-danger text-primary text-center"><?php echo $message;?></h4>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="modal-button" class="btn btn-default"  onclick="closeModal()">Κλείσιμο</button>
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

<?php echo ob_get_clean(); ?>
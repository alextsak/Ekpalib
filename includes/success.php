<?php 

$message = $_POST['message'];

?>
<?php ob_start(); ?>
<div class="modal fade success-modal" id="success-modal" tabindex="-1"
	role="dialog" aria-labelledby="success-modal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" aria-label="Close"  onclick="closeModal()">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title text-center" style="color:navy;">Επιτυχία</h3>
				
				
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
				<button class="btn btn-default"  onclick="closeModal()">Κλείσιμο</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	function closeModal(){
		jQuery('#success-modal').modal('hide');
		setTimeout(function(){
			jQuery('#success-modal').remove();
			jQuery('.modal-backdrop').remove();
			},500);
		}

</script>

<?php echo ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="modal fade details-modal" id="details-modal" tabindex="-1"
	role="dialog" aria-labelledby="details-1" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title text-center">Levis Jeans</h4>
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
							<h4>Details</h4>
							<p>Some description</p>
							<hr>
							<p>Price</p>
							<p>Something else</p>
							
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn brn-default" data-dismiss="modal">Close</button>
				<button class="btn btn-warning" type="submit">
					<span class="glyphicon glyphicon-shoppinng-cart"></span>Add To Cart
				</button>
			</div>
		</div>
	</div>
</div>
<?php echo ob_get_clean(); ?>

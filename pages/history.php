<?php

// take the user and ask question to the database for his history
$username = $_SESSION ['username'];
$user = new User ();
$user_results = $user->get_user_transactions ( $username );
$user_results_approved = $user->get_user_transactions_approved ( $username );
$user_results_history = $user->get_user_history ( $username );
?>


<div id="main-bg">
		<ul id="main-tabs" class="nav nav-tabs" role="tablist">
			<li class="active"><a href="#NewsAndEvents" data-toggle="tab"> <i
					class="glyphicon glyphicon-calendar"></i> Πρόσφατες Αιτήσεις
			</a></li>

			<li><a href="#StudyRooms" data-toggle="tab"> <i
					class="glyphicon glyphicon-edit"></i> Ενεργοί Δανεισμοί
			</a></li>

			<li><a href="#Libraries" data-toggle="tab"> <i
					class="glyphicon glyphicon-time"></i> Παλαιοί Δανεισμοί
			</a></li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">

			<div class="tab-pane active" id="NewsAndEvents">
				<div class="panel-body" id="NewsAndEventsBody">
					<div class="table-responsive">
						<table class="table" id="results-grid">
							
							
							
							<thead>
								<tr>
									<td style="text-align:center;"><?php echo 'Τίτλος';?></th>
									<td style="text-align:center;"><?php echo 'Κατηγορία';?></th>
									<td style="text-align:center;"><?php echo 'Βιβλιοθήκη';?></th>
									<td style="text-align:center;"><?php echo 'Κατάσταση';?></th>
									<td style="text-align:center;"><?php echo 'Επιλογές'?></th> <!-- book details / cancel -->
								</tr>
							</thead>
							<tbody>
    						<?php
								if ($user_results == "No data found") {
							?>
                			<tr>
								<td style="text-align:center;"><?php echo "Δεν υπάρχουν πρόσφατες αιτήσεις";?></td>
							</tr>
                			<?php
								} else {
									while ( $row = $user_results->fetch(PDO::FETCH_ASSOC) ) {
									$material = new Material ();
									$material_info = $material->get_material_by_id($row ['MaterialID'])->fetch(PDO::FETCH_ASSOC);
									$library = $material->get_material_library ( $row ['MaterialID'] );
									$lib_name = '';
									if ($library != - 1) {
										$lib_name = $library ['Name'];
										$lib_id = $library ['idLibraries'];
									}
									?>
									<tr>
									<td style="text-align:center;"><?php echo $material_info['title']; ?></td>
		                   			<td style="text-align:center;"><?php echo $material_info['category']; ?></td>
		                   			<td style="text-align:center;"><a href="javascript:detailsLibrary(<?php echo $lib_id;?>)"><?php echo $lib_name; ?></a></td>
									<td style="text-align:center;">
									<?php if ($row['Approved'] == 1) {?>
											<span class="glyphicon glyphicon-ok"></span>
											<?php 
									}
									else {
										?><span class="glyphicon glyphicon-minus"></span>
										<?php 
									}
									?></td>
									<td style="width:120px;">
									<button class="btn btn-primary btn-sm" type="button" onclick="detailsbook(<?php echo $row['MaterialID'];?>)">
									<span class="glyphicon glyphicon-info-sign" ></span>
									</button>
									&nbsp | &nbsp
									<button class="btn btn-warning btn-sm" type="submit" onclick="removeRequest(<?php echo $username;?>,<?php echo $row['MaterialID'];?>)">
									<span class="glyphicon glyphicon-remove-circle"></span>
									</button>
									</td>
		                   			</tr><?php 
								}
							}
						?>
   						</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="tab-pane" id="StudyRooms">
				<div class="panel-body" id="StudyRoomsBody">
					<div class="table-responsive">
						<table class="table" id="results-grid">
							
							
							
							<thead>
							
								<tr>
									<td style="text-align:center;"><?php echo 'Τίτλος';?></th>
									<td style="text-align:center;"><?php echo 'Κατηγορία';?></th>
									<td style="text-align:center;"><?php echo 'Βιβλιοθήκη';?></th>
									<td style="text-align:center;"><?php echo 'Hμέρα Παραλαβής';?></th>
									<td style="text-align:center;"><?php echo 'Hμέρα Επιστροφής';?></th>
									<td style="text-align:center;"><?php echo 'Επιλογές'?></th> <!-- book details / expansion -->
								</tr>
							</thead>
							<tbody>
    		<?php
								if ($user_results == "No data found") {
							?>
                			<tr>
								<td style="text-align:center;"><?php echo "Δεν υπάρχουν πρόσφατες αιτήσεις";?></td>
							</tr>
                			<?php
								} else {
									while ( $row = $user_results_approved->fetch(PDO::FETCH_ASSOC) ) {
									$material = new Material ();
									$material_info = $material->get_material_by_id($row ['MaterialID'])->fetch(PDO::FETCH_ASSOC);
									$library = $material->get_material_library ( $row ['MaterialID'] );
									$lib_name = '';
									if ($library != - 1) {
										$lib_name = $library ['Name'];
										$lib_id = $library ['idLibraries'];
									}
									?>
									<tr>
									<td style="text-align:center;"><?php echo $material_info['title']; ?></td>
		                   			<td style="text-align:center;"><?php echo $material_info['category']; ?></td>
		                   			<td style="text-align:center;"><a href="javascript:detailsLibrary(<?php echo $lib_id;?>)"><?php echo $lib_name; ?></a></td>
		                   			<td style="text-align:center;"><?php echo $row['StartDate']; ?></td>
		                   			<td style="text-align:center;"><?php echo $row['EndDate']; ?></td>
									<td style="width:120px;">
									<button class="btn btn-primary btn-sm" type="button" onclick="detailsbook(<?php echo $row['MaterialID'];?>)">
									<span class="glyphicon glyphicon-info-sign" ></span>
									</button>
									&nbsp | &nbsp
									<button class="btn btn-warning btn-sm" type="submit" onclick="removeRequest(<?php echo $username;?>,<?php echo $row['MaterialID'];?>)">
									<span class="glyphicon glyphicon-expand"></span>
									</button>
									</td>
		                   			</tr><?php 
								}
							}
						?>
   		</tbody>
						</table>
					</div>
				</div>
			</div>

	<div class="tab-pane" id="Libraries">
		<div class="panel-body" id="LibrariesBody">
			<div class="table-responsive">
				<table class="table" id="results-grid">
					
					
					
					<thead>
					
						<tr>
							<td style="text-align:center;"><?php echo 'Τίτλος';?></th>
							<td style="text-align:center;"><?php echo 'Κατηγορία';?></th>
							<td style="text-align:center;"><?php echo 'Βιβλιοθήκη';?></th>
							<td style="text-align:center;"><?php echo 'Hμέρα Παραλαβής';?></th>
							<td style="text-align:center;"><?php echo 'Hμέρα Παράδοσης';?></th>
							<td style="text-align:center;"><?php echo 'Επιλογές'?></th> <!-- book details -->
						</tr>
					</thead>
					<tbody>
    		<?php
								if ($user_results == "No data found") {
							?>
                			<tr>
								<td style="text-align:center;"><?php echo "Δεν υπάρχουν πρόσφατες αιτήσεις";?></td>
							</tr>
                			<?php
								} else {
									while ( $row = $user_results_history->fetch(PDO::FETCH_ASSOC) ) {
									$material = new Material ();
									$material_info = $material->get_material_by_id($row ['MaterialID'])->fetch(PDO::FETCH_ASSOC);
									$library = $material->get_material_library ( $row ['MaterialID'] );
									$lib_name = '';
									if ($library != - 1) {
										$lib_name = $library ['Name'];
										$lib_id = $library ['idLibraries'];
									}
									?>
									<tr>
									<td style="text-align:center;"><?php echo $material_info['title']; ?></td>
		                   			<td style="text-align:center;"><?php echo $material_info['category']; ?></td>
		                   			<td style="text-align:center;"><a href="javascript:detailsLibrary(<?php echo $lib_id;?>)"><?php echo $lib_name; ?></a></td>
		                   			<td style="text-align:center;"><?php echo $row['received']; ?></td>
		                   			<td style="text-align:center;"><?php echo $row['returned']; ?></td>
									<td style="width:120px;">
									<button class="btn btn-primary btn-sm" type="button" onclick="detailsbook(<?php echo $row['MaterialID'];?>)">
									<span class="glyphicon glyphicon-info-sign" ></span>
									</button>
									</td>
		                   			</tr><?php 
								}
							}
						?>
   		</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>


<script type="text/javascript">

$(document).ready(function(){

	$('#search_books').on('submit', function(e){
		var term = $("#Search_Argument").val();
		if(term == ""){
			
			e.preventDefault();
			var message = "Παρακαλώ εισάγετε όρο αναζήτησης, π.χ. Φυσική";
			error_messages(message);
			
		} else {
			// do nothing here and let the form submit
		}
	});


	$('#search_articles').on('submit', function(e){
		var term = $("#artclSubject").val();
		if(term == ""){
			
			e.preventDefault();
			var message = "Παρακαλώ εισάγετε κάποια λέξη κλειδί για το άρθρο, π.χ. Φυσική";
			error_messages(message);
			
		} else {
			// do nothing here and let the form submit
		}
	});
});



</script>
<div id="main-bg">
	  <ul id="main-tabs" class="nav nav-tabs" role="tablist">
	   	<li class="active"><a href="#NewsAndEvents"  data-toggle="tab">
	    	<i class="glyphicon glyphicon-calendar"></i>
	    	Νέα και Εκδηλώσεις</a>
	    </li>
	    
	    <li><a href="#StudyRooms"  data-toggle="tab">
	    	<i class="glyphicon glyphicon-edit"></i>
	    	Αναγνωστήρια</a>
	    </li>
	   
	     <li ><a href="#Libraries" data-toggle="tab">
	    	<i class="glyphicon glyphicon-time"></i>
	    	Βιβλιοθήκες</a>
	    </li>
	  </ul>
	 
	  <!-- Tab panes -->
	  <div  class="tab-content" >
	  
            <div class="tab-pane active" id="NewsAndEvents">
            	<div class="panel-body" id="NewsAndEventsBody">
	            	<div class="col-md-6" id="News">
	            		<h4 style="text-decoration: underline; text-align: center; color:#F5FFFA;">Νέα</h4>
	            		 <p style="color:#FFFAF0;">Με την υψηλότερη διάκριση ―worthy of merit― αξιολογήθηκε από τους εξωτερικούς αξιολογητές το 
	           						Εθνικό και Καποδιστριακό Πανεπιστήμιο Αθηνών κατά την τελική φάση της διαδικασίας της εξωτερικής 
	           						ιδρυματικής αξιολόγησης
	
	 
	            		</p>
	            	</div>
	            	<div class="col-md-6" id="Events">
	            		<h4 style="text-decoration: underline; text-align: center; color:#F5FFFA;">Εκδηλώσεις</h4>
	          			<p style="color:#FFFAF0;">Πρόσκληση σε ομιλία του Καθηγητή και Ακαδημαϊκού κ. Δ. Νανόπουλου 
							Τετάρτη 13 Ιανουαρίου 2016, ώρα 12:00 Πρόσκληση σε ομιλία του Καθηγητή και Ακαδημαϊκού κ. Δ. Νανόπουλου 
	
	          			</p>
	            	</div>
            	 </div>
            </div>
          
            <div class="tab-pane" id="StudyRooms">
    			<div class="panel-body" id="StudyRoomsBody">
	    			<div class="table-responsive">  
			    		<table class="table" id="stdr-grid">
							<thead>
								<tr>
									<th style="text-align:center;">Όνομα</th>
									<th style="text-align:center;">Διεύθυνση</th>
									<th style="text-align:center;">Ώρες Λειτουργίας</th>
								</tr>
							</thead>
							
							<tbody >
						    	<?php   		
						       		$studyRooms = new StudyRooms();
						       		$studyRooms->getAllStudyRooms();
						 		?> 
							</tbody>	
						</table>
					</div>
				</div>
	    	</div>
	    	
            <div class="tab-pane" id="Libraries">
              	<div class="panel-body" id="LibrariesBody">
	              	<div class="col-sm-12" style="margin-bottom:30px;
	              									margin-top:20px;
													border: 1px solid white;
													border-radius: 10px;
													-moz-border-radius: 10px;
													-webkit-border-radius: 10px;
													height:inherit;
													border-style: double;">
						<p>Εάν επιλέξετε "Κανένα" Τμήμα τότε αναζητείτε βιβλιοθήκες με βάση την διεύθυνση</p>
		              	<div class="col-md-4">
			              	<form class="form-horizontal">
			              		<h5 style="position:relative;top:15px;right: 15px;text-decoration: underline;">Επιλογή τμήματος</h5>
								<select id="lib-dep" class="form-control" style="position:relative;top:10px;margin-bottom:25px;right:15px;width:250px">
									  <option>Όλα</option>
									  <?php 
									  	$libraries = new Libraries();
									  	$libraries->get_department_names();	
					 				   ?>
					 				   <option>Κανένα</option> 
								</select>
							</form>
		              	</div>
		              	<div class="col-md-6">
			              	<form class="form-horizontal" >
			              		<div class="form-group" style="position:relative;top:45px;margin-bottom:25px;right:110px;width:inherit">
									    <div class="col-sm-10">
									      <input class="form-control" id="lib-addr" placeholder="Διεύθυνση" disabled>
									    </div>
								</div>
							</form>
		              	</div>
		              	<div class="col-md-2">
			              	<a id="lib-search" href="#" class="btn btn-primary" style="position:relative;top:45px;float:right;">
						     	<span class="glyphicon glyphicon-search"></span>
						     	Αναζήτηση
						     </a>
		              	</div>
					</div>
					
					<!-- class="table-responsive" -->
					<div >  
			    		<table  class="table" id="lib-grid">
							<thead>
								<tr>
									<th style="text-align:center;">Όνομα</th>
									<th style="text-align:center;">Διεύθυνση</th>
									<th style="text-align:center;">Τηλέφωνο</th>
									<th style="text-align:center;">Λεπτομέρειες</th>
								</tr>
							</thead>
							
							<tbody >
						    	<?php   		
						       		$libraries = new Libraries();
						       		$libraries->getAllLibraries();
						 		?> 
							</tbody>	
						</table>
					</div>
				</div>
           	</div>
	  </div>
</div>

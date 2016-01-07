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

			
			  <!-- Nav tabs -->
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
	  <div  class="tab-content">
	  
            <div class="tab-pane active" id="NewsAndEvents">
           <p>Με την υψηλότερη διάκριση ―worthy of merit― αξιολογήθηκε από τους εξωτερικούς αξιολογητές το 
           Εθνικό και Καποδιστριακό Πανεπιστήμιο Αθηνών κατά την τελική φάση της διαδικασίας της εξωτερικής 
           ιδρυματικής αξιολόγησης, σύμφωνα με την ισχύουσα νομοθεσία και την εφαρμογή της σε συνεργασία με την 
           ΑΔΙΠ (Αρχή Διασφάλισης Ποιότητας). Πιο συγκεκριμένα η Έκθεση, μεταξύ άλλων, μνημονεύει:

«An admirable effort by the academic units and the administration has been made towards establishing a mission and its goals. Fortunately, in the context of the current financial crisis, the long standing tradition of excellence of UOA inherently addresses its immediate mission and goals». 
            </p></div>
              
            <div class="tab-pane" id="StudyRooms">
    			<table>
					<thead>
						<th>Όνομα</th>
						<th>Διεύθυνση</th>
						<th>Ώρες Λειτουργίας</th>
					</thead>
					
					<tbody >
				    	<?php   		
				       		$studyRooms = new StudyRooms();
				       		$studyRooms->getAllStudyRooms();
				 		?> 
					</tbody>	
				</table>
	    	</div>
	    	
            <div class="tab-pane" id="Libraries">
              	<div class="col-sm-12" style="margin-bottom:30px;
              									margin-top:20px;
												border: 1px solid black;
												border-radius: 10px;
												-moz-border-radius: 10px;
												-webkit-border-radius: 10px;
												height:inherit;
												border-style: double;">
	              	<div class="col-md-4">
		              	<form class="form-horizontal">
		              		<h5 style="position:relative;top:15px;right: 15px;text-decoration: underline;">Επιλογή τμήματος</h5>
							<select id="lib-dep" class="form-control" style="position:relative;top:10px;margin-bottom:25px;right:15px;width:250px">
								  <?php   		
				       				$libraries = new Libraries();
				       				$libraries->get_department_names();
				 				   ?> 
							</select>
						</form>
	              	</div>
	              	<div class="col-md-6">
		              	<form class="form-horizontal" >
		              		<div class="form-group" style="position:relative;top:45px;margin-bottom:25px;right:110px;width:inherit">
								    <div class="col-sm-10">
								      <input class="form-control" id="lib-addr" placeholder="Διεύθυνση">
								    </div>
							</div>
						</form>
	              	</div>
	              	<div class="col-md-2">
		              	<a id="lib-search" href="#" class="btn btn-primary" style="position: relative;top: 45px;float: right;">
					     	<span class="glyphicon glyphicon-search"></span>
					     	Αναζήτηση
					     </a>
	              	</div>
				</div>
				<table id="lib-grid">
					<thead>
						<th>Όνομα</th>
						<th>Διεύθυνση</th>
						<th>Τηλέφωνο</th>
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

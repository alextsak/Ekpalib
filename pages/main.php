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
            	<div id="bg-news-img-container">
	            	<div class="col-md-6" id="News">
	            		<h4 style="text-decoration: underline; text-align: center; color:#F5FFFA;">Νέα</h4>
	            			<hr>
	            			<p>
	            				<img class="img-responsive"style="float: left; margin: 0px 15px 15px 0px;" src="images/news.png" width="100" />
								<h5><a href="#" style="color:#6699CC;">Προκήρυξη εκλογών για την ανάδειξη αιρετού εκπροσώπου Διοικητικού Προσωπικού στη Σύγκλητο</a></h5>
								<p>Πέμπτη 11 Φεβρουαρίου 2016, 8.30-16.00</p>
								<br style="clear: both;" />
							</p>
							
							<hr>
	            			<p>
	            				<img class="img-responsive"style="float: left; margin: 0px 15px 15px 0px;" src="images/news.png" width="100" />
								<h5><a href="#" style="color:#6699CC;">Προκήρυξη εκλογών για την ανάδειξη αιρετού εκπροσώπου Ειδικού Τεχνικού Εργαστηριακού Προσωπικού (ΕΤΕΠ) στη Σύγκλητο</a></h5>
								<p>Πέμπτη 11 Φεβρουαρίου 2016, 8.30-16.00</p>
								<br style="clear: both;" />
							</p>
	            	</div>
	            	<div class="col-md-6" id="Events">
	            		<h4 style="text-decoration: underline; text-align: center; color:#F5FFFA;">Εκδηλώσεις</h4>
	            			<hr>
	            			<p>
	            				<img class="img-responsive"style="float: left; margin: 0px 15px 15px 0px;" src="images/events.png" width="100" />
								<h5><a href="#" style="color:#6699CC;">Ομιλία με θέμα "Οι Αρχαίοι Έλληνες, οι Άραβες και η Ιστορία των Μαθηματικών: Διαμάχες για την πρώιμη ιστορία της άλγεβρας"</a></h5>
								<p>Τρίτη 26 Ιανουαρίου 2016, ώρα 19:00</p>
								<br style="clear: both;" />
							</p>
							
							<hr>
	            			<p>
	            				<img class="img-responsive"style="float: left; margin: 0px 15px 15px 0px;" src="images/events.png" width="100" />
								<h5><a href="#" style="color:#6699CC;">Επιστημονική εκδήλωση "Σύγχρονος Επαγγελματικός Αθλητισμός και οι Αλλαγές του Αθλητικού Νόμου"</a></h5>
								<p>Τετάρτη 27 Ιανουαρίου 2016, ώρα 18.00</p>
								<br style="clear: both;" />
							</p>
	            	</div>
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
						
		              	<div class="col-md-4">
			              	<div id="dep-header" class="header" style="width: 140px;"> 
			              		<h5>
			              			<span class="glyphicon glyphicon-plus-sign"></span>
			              			Επιλογή Τμήματος
			              		</h5>
			              	</div>
    						<div id="dep-content" class="content">
				              	<form class="form-horizontal">
									<select id="lib-dep" class="form-control" style="position:relative;top:10px;margin-bottom:25px;right:15px;width:250px">
										  <option>Όλα</option>
										  <?php 
										  	$libraries = new Libraries();
										  	$libraries->get_department_names();	
						 				   ?>
						 				    
									</select>
								</form>
		              		</div>
		              	</div>
		              	<div class="col-md-6">
			              	<div id="addr-header" class="header" style="right: 0px; left: -22%;width: 150px;">
			              		<h5>
			              			<span class="glyphicon glyphicon-plus-sign"></span>
			              			Επιλογή Διεύθυνσης
			              		</h5>
			              	</div>
    						<div id="addr-content" class="content">
				              	<form class="form-horizontal" >
				              		<div class="form-group" style="position:relative;top:10px;right:110px;width:inherit">
										    <div class="col-sm-10">
										      <input class="form-control" id="lib-addr" placeholder="Εισάγετε διεύθυνση" 
										      	type="text" placeholder="Εισάγετε διεύθυνση" 
					                    		maxlength="255" size="25" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Εισάγετε διεύθυνση'"
					                    		required
	                							data-fv-notempty-message/>
										    </div>
									</div>
								</form>
		              		</div>
		              	</div>
		              	
		              	<div>
			              	<a id="lib-search" href="#" class="btn btn-primary" style="position:relative;float:right;margin-top: 5%; margin-bottom: 2%;">
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

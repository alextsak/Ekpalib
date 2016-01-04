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
<div >
	  <!-- Nav tabs -->
	  <ul id="main-tabs" class="nav nav-tabs" role="tablist">
	    <li class="active"><a href="#Books" data-toggle="tab">Βιβλία</a></li>
	    <li><a href="#Articles"  data-toggle="tab">Άρθρα</a></li>
	    <li><a href="#Journals"  data-toggle="tab">Περιοδικά</a></li>
	  </ul>
	  <!-- Tab panes -->
	  <div  class="tab-content">
            <!--begin books panel-->
            <div class="tab-pane active" class="tab-pane" id="Books">
	              <div class="panel-body" id="search-book">
	              		<div class="row">
	                    	<div class="col-sm-6">
	                      		<h3><span class="glyphicon glyphicon-search"></span> Γρήγορη Αναζήτηση</h3>
	                    	</div>
	                    	<div class="col-sm-6">  
	                      		<a class="pull-right hidden-xs" href="?page=advancedSearch">Σύνθετη Αναζήτηση</a>
	                    	</div>
	                  	</div>
		                <div class="row">
		                  <form class="form-inline" id="search_books" action="?page=resultsPage" method="POST">
				                    <label class="sr-only" for="Search_Argument">Εισάγετε όρους αναζήτησης</label>
				                    <input id="Search_Argument" class="form-control easy-search-text-input" type="text" placeholder="Εισάγετε όρους αναζήτησης" maxlength="255" size="25" name="term" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Εισάγετε όρους αναζήτησης'">
				                    <label class="sr-only" for="booksSearch_Code">Book Search</label>
				                    <select id="booksSearch_Code" class="form-control" name="keyword" aria-required="true">
				                      <option value="key">Λέξη-Κλειδί</option>
				                      <option value="title">Τίτλος</option>
				                      <option value="author">Συγγραφέας</option>
				                    </select>
				                    <input type="submit" class="btn btn-primary" alt="submit" value="Αναζήτηση" name="searchbooks">
				                  </form>
		    	        </div>
		                <div class="row hidden-xs">
		                  <div class="col-sm-6">
		                  
		                    <p>Αναζητήστε Βιβλίο με βάση Λέξη-Κλειδί, Τίτλο ή Συγγραφέα</p>
		                  </div>
		                </div>
	              </div>
           	</div>
            <!--end books panel-->
	    	
	    	<div class="tab-pane" id="Articles">
	    		<div class="tab-pane active" id="articlesTab">
	              <!--begin articles panel-->
	               <div class="panel-body" id="search-article">
	                  <div class="row">
	                    <div class="col-sm-6">
	                      <h3><span class="glyphicon glyphicon-search"></span> Γρήγορη Αναζήτηση</h3>
	                    </div>
	                    <!-- <div class="col-sm-6">  
	                      <a class="pull-right hidden-xs" href="?page=advancedSearch">Σύνθετη Αναζήτηση</a>
	                    </div> -->
	                  </div>
	                <div class="row">   
	                  <form id="search_articles" class="form-inline" action="?page=resultsPage" method="POST">
	                    <label for="artclSubject" class="sr-only">article</label>
	                    <input id="artclSubject" class="form-control easy-search-text-input" type="text" placeholder="Εισαγωγή θέματος άρθρου" maxlength="255" size="25" name="keyword" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter article subject'">
	                    <input type="hidden" alt="submit" value="direct" name="s2">
	                    <input type="hidden" alt="submit" value="gatewayjnlarticle" name="project">
	                      <label for="selection2" class="sr-only">choose the subject</label>
	                      <select id="selection2" class="form-control" name="selection" aria-required="true">
	                        <option value="gen">Multi-Subject Resources</option>
	                        <option value="news">Current News Sources</option>
	                        <option value="ArHu">Arts &amp; Humanities</option>
	                        <option value="Bus">Business</option>
	                        <option value="Educ">Education</option>
	                        <option value="EngRes">Engineering</option>
	                        <option value="health">Health Sciences</option>
	                        <option value="ias">International &amp; Area Studies</option>
	                        <option value="LIS">Library &amp; Information Science</option>
	                        <option value="lifesci">Life Sciences</option>
	                        <option value="music">Music &amp; Performing Arts</option>
	                        <option value="Physsci">Physical Sciences/Math</option>
	                        <option value="Socsci">Social Sciences</option>
	                      </select>
	                      <input type="submit" class="btn btn-primary" alt="submit" value="Αναζήτηση" name="searcharticles">
	                  </form>
	                </div>
	                <div class="row hidden-xs">
	                  <div class="col-sm-6">
	                    <p>Search for articles on a specific topic in magazines and journals.</p>
	                  </div>
	                </div>
	              </div>
	              <!--end articles panel-->
	            </div>
	    	</div>
	    	<div class="tab-pane" id="Journals">
	    		<div class="panel-body" id="search-journal">
	                  <div class="row">
	                    <div class="col-sm-6">
	                      <h3><span class="glyphicon glyphicon-search"></span> Γρήγορη Αναζήτηση</h3>
	                    </div>
	                    <div class="col-sm-6">  
	                      <a class="pull-right hidden-xs" href="#">Σύνθετη Αναζήτηση</a>
	                    </div>
	                  </div>
		                <div class="row">   
		                  <form class="form-inline" id="search_journals" action="?page=resultsPage" method="get">
		                    <label for="jnltitle" class="sr-only">Journal Title</label>
		                    <input id="jnltitle" class="form-control easy-search-text-input es-text-no-select" type="text" placeholder="Enter journal title" maxlength="255" size="25" name="jnltitle" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter journal title'" aria-required="true">
				                    <input type="hidden" alt="submit" value="gatewayjnltitle" name="project">
				                    <input type="submit" class="btn btn-primary" alt="submit" value="Αναζήτηση" name="searchjournal">
				                  </form>
				                </div>
				                <div class="row hidden-xs">
				                  <div class="col-sm-6">
				                   <p>Search for specific journal titles both in print and electronic format.</p>
				                  </div>
				                </div>
               			</div>
			    	</div>
			  </div>
			</div>
			
			
			<div>
			
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
					<tr>
						<th>Όνομα</th>
						<th>Διεύθυνση</th>
						<th>Ώρες Λειτουργίας</th>
					</tr>
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
							<select  class="form-control" style="position:relative;top:10px;margin-bottom:25px;right:15px;width:inherit">
								  <option>Θετικών Επιστημών</option>
								  <option>Βιολογίας-Χημείας-Φαρμακευτικής</option>
								  <option>3</option>
								  <option>4</option>
								  <option>5</option>
							</select>
						</form>
	              	</div>
	              	<div class="col-md-6">
		              	<form class="form-horizontal" >
		              		<div class="form-group" style="position:relative;top:45px;margin-bottom:25px;right:110px;width:inherit">
								    <div class="col-sm-10">
								      <input class="form-control" id="keyword" placeholder="Διεύθυνση">
								    </div>
							</div>
						</form>
	              	</div>
	              	<div class="col-md-2">
		              	<a href="#" class="btn btn-primary" style="position: relative;top: 45px;float: right;">
					     	<span class="glyphicon glyphicon-search"></span>
					     	Αναζήτηση
					     </a>
	              	</div>
				</div>
				<table>
					<tr>
						<th>Όνομα</th>
						<th>Διεύθυνση</th>
						<th>Τηλέφωνο</th>
					</tr>
				</table>
           	</div>
	  </div>
</div>

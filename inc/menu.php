<style>
 .borderline {
 	border-top: 3px solid #ddd
 }
 
 #bottom_borderline{
 	margin-bottom:30px;
 }
 
 #site-path{
 	height:40px;
 }
 
 #tabs{
 	background:beige;
 }
 
 #tabs a{
 	color:black;
 }

</style>

<div class="borderline"></div>
           <ul id="tabs"  class="nav nav-pills">
           	   <li>
           	   		<a href="">Αρχική</a>
           	   </li>
               <li class="dropdown">
               		<a href="#" data-toggle="dropdown" class="dropdown-toggle">Πληροφορίες <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="?page=about">Καλωσόρισμα Ββλιοθήκης</a></li>
                            <li><a href="#">Διοικητικό Προσωπικό</a></li>
                            <li><a href="#">Πολιτική Λειτουργίας</a></li>
                        </ul>
               </li>
               <li class="dropdown">
               		<a href="#" data-toggle="dropdown" class="dropdown-toggle">Επικοινωνία <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                        	<li><a href="#">Αποστολή Μηνύματος</a></li>
                            <li><a href="#">Παρατηρήσεις - Προτάσεις</a></li>
                        </ul>
               </li>

               <li class="dropdown">
               		<a href="?page=about" data-toggle="dropdown" class="dropdown-toggle">Βοήθεια <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="?page=about">Συχνές Ερωτήσεις</a></li>
                            <li><a href="#">Οδηγίες Αναζήτησης Υλικού</a></li>
                            <li><a href="#">Άμεση Βοήθεια</a></li>
                        </ul>
               </li>
               
              
          	</ul>
          	<div  id="bottom_borderline" class="borderline"></div>
          	<?php 
          	if(!empty($_SERVER['QUERY_STRING'])) {
          		
          	
          	?> 
		

		
			<div id="site-path">
			<?php
			
				$sitepath = sitepath_constructor();
				echo $sitepath;
				//echo var_dump($_SESSION['sitepath']);
			?>
			</div>
			
<?php 
          	} else {
          		init_sitepath();
          	}
?>
    	
    	
    	
    	
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
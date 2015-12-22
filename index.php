<?php /*include some functions */require 'functions.php';?> 
<?php //session_start();	
/* if(isset($_SESSION['username'])){
	echo "<h1>Welcome ";
	echo $_SESSION['username'];
	echo "</h1>";
	echo '<a href="./pages/logout.php">Logout</a>';
} */
?>
<?php 
	include_once './inc/header.php';
	include_once './inc/menu.php';

	?> 
		<div class="container">
			<div>
			  <!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
			    <li class="active"><a href="#Books" data-toggle="tab">Books</a></li>
			    <li><a href="#Articles"  data-toggle="tab">Articles</a></li>
			    <li><a href="#Journals"  data-toggle="tab">Journals</a></li>
			  </ul>
			  <!-- Tab panes -->
			  <div  class="tab-content">
		            <!--begin books panel-->
		            <div class="tab-pane active" class="tab-pane" id="Books">
			              <div class="panel-body" id="search-book">
			              		<div class="row">
			                    	<div class="col-sm-6">
			                      		<h3><span class="glyphicon glyphicon-search"></span> Easy Search</h3>
			                    	</div>
			                    	<div class="col-sm-6">  
			                      		<a class="pull-right hidden-xs" href="#">Advanced Search</a>
			                    	</div>
			                  	</div>
				                <div class="row">
				                  <form class="form-inline" id="search_books" action="#" method="get">
				                    <label class="sr-only" for="Search_Argument">Enter Search Terms</label>
				                    <input id="Search_Argument" class="form-control easy-search-text-input" type="text" placeholder="Enter search terms" maxlength="255" size="25" name="keyword" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter search terms'">
				                    <label class="sr-only" for="booksSearch_Code">Book Search</label>
				                    <select id="booksSearch_Code" class="form-control" name="booksSearch_Code" aria-required="true">
				                      <option value="FT*">Keyword</option>
				                      <option value="TALL">Title words</option>
				                      <option value="NAME+">Author (last name, first)</option>
				                    </select>
				                    <input type="submit" class="btn btn-primary" alt="submit" value="Search" name="searchbutton">
				                  </form>
				    	        </div>
				                <div class="row hidden-xs">
				                  <div class="col-sm-6">
				                    <p>Find books by keyword, title, or author.</p>
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
			                      <h3><span class="glyphicon glyphicon-search"></span> Easy Search</h3>
			                    </div>
			                    <div class="col-sm-6">  
			                      <a class="pull-right hidden-xs" href="#">Advanced Search</a>
			                    </div>
			                  </div>
			                <div class="row">   
			                  <form id="search_articles" class="form-inline" action="#" method="get">
			                    <label for="artclSubject" class="sr-only">article</label>
			                    <input id="artclSubject" class="form-control easy-search-text-input" type="text" placeholder="Enter article subject" maxlength="255" size="25" name="keyword" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter article subject'">
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
			                      <input type="submit" class="btn btn-primary" alt="submit" value="Search" name="searchbutton">
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
			                      <h3><span class="glyphicon glyphicon-search"></span> Easy Search</h3>
			                    </div>
			                    <div class="col-sm-6">  
			                      <a class="pull-right hidden-xs" href="#">Advanced Search</a>
			                    </div>
			                  </div>
				                <div class="row">   
				                  <form class="form-inline" id="search_journals" action="#" method="get">
				                    <label for="jnltitle" class="sr-only">Journal Title</label>
				                    <input id="jnltitle" class="form-control easy-search-text-input es-text-no-select" type="text" placeholder="Enter journal title" maxlength="255" size="25" name="jnltitle" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter journal title'" aria-required="true">
				                    <input type="hidden" alt="submit" value="gatewayjnltitle" name="project">
				                    <input type="submit" class="btn btn-primary" alt="submit" value="Search" name="searchbutton">
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
			  <ul class="nav nav-tabs" role="tablist">
			    <li class="active"><a href="#Libraries" data-toggle="tab">
			    	<i class="glyphicon glyphicon-time"></i>
			    	Libraries and Hours</a>
			    </li>
			    
			    <li><a href="#StudyRooms"  data-toggle="tab">
			    	<i class="glyphicon glyphicon-edit"></i>
			    	Study Rooms</a>
			    </li>
			    
			    <li><a href="#NewsAndEvents"  data-toggle="tab">
			    	<i class="glyphicon glyphicon-calendar"></i>
			    	News and Events</a>
			    </li>
			  </ul>
			  <!-- Tab panes -->
			  <div  class="tab-content">
		            <div class="tab-pane active" class="tab-pane" id="Libraries">
			              	<div id="libraries-table" class="panel panel-default" >
						    	<div class="panel-body" id="libraries-tab">
						    			<table id="libraries-grid" class="display" cellspacing="0" width="100%">
							    			 <thead>
									            <tr>
									                <th>Name</th>
									                <th>Address</th>
									                <th>Hours</th>
									            </tr>
									        </thead>
									        <tbody>
									        	<?php /* include php code for rows */ ?>
									            <tr>
									                <th>Ξ‘Ξ³Ξ³Ξ»ΞΉΞΊΞ·Ο‚ Ξ“Ξ»Ο‰ΟƒΟƒΞ±Ο‚ ΞΊΞ±ΞΉ Ξ¦ΞΉΞ»ΞΏΞ»ΞΏΞ³ΞΉΞ±Ο‚</th>
									                <th>Ξ�Ο„Ξ―Ο�ΞΉΞΏ Ξ¦ΞΉΞ»ΞΏΟƒΞΏΟ†ΞΉΞΊΞ®Ο‚ Ξ£Ο‡ΞΏΞ»Ξ®Ο‚ 9ΞΏΟ‚ Ο�Ο�ΞΏΟ†ΞΏΟ‚ ΞΊΟ…Ο�Ξ­Ξ»Ξ· 929 Ξ Ξ±Ξ½/Ο€ΞΏΞ»Ξ· Ξ–Ο‰Ξ³Ο�Ξ¬Ο†ΞΏΟ…</th>
									                <th>Ξ”Ξµ-Ξ Ξµ 9-6 Ξ Ξ± 9-3 (Ο‡ΞµΞΉΞΌΞµΟ�ΞΉΞ½Ο�) ΞΊΞ±ΞΉ Ξ™ΞΏΟ�Ξ»ΞΉΞΏ-Ξ‘Ο�Ξ³ΞΏΟ…ΟƒΟ„ΞΏ Ξ”Ξµ-Ξ Ξ± 9-3</th>
									            </tr>
									        </tbody>
						    			</table>
								</div>
					   		</div>
		           	</div>
			    	
			    	<div class="tab-pane" id="StudyRooms">
			    			<div id="studyRooms-table" class="panel panel-default" >
						    	<div class="panel-body" id="studyRooms-tab">
						    			<table id="studyRooms-grid" class="display" cellspacing="0" width="100%">
							    			 <thead>
									            <tr>
									                <th>Name</th>
									                <th>Address</th>
									                <th>Hours</th>
									            </tr>
									        </thead>
									        <tbody>
									        	<?php /* include php code for rows */ ?>
									            <tr>
									                <th></th>
									                <th></th>
									                <th></th>
									            </tr>
									        </tbody>
						    			</table>
								</div>
					   		</div>
			    	</div>
			    	<div class="tab-pane" id="NewsAndEvents">
			    		
			    	</div>
			  </div>
			</div>

<?php  include_once './inc/footer.php';  ?>  
		











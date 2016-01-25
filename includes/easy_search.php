<div id="easy-search-bg">
	  <!-- Nav tabs -->
	  <ul id="main-tabs" class="nav nav-tabs" role="tablist" data-toggle="collapse">
	    <li class="active"><a href="#Books" data-toggle="tab">Βιβλία</a></li>
	    <li><a href="#Articles"  data-toggle="tab">Άρθρα</a></li>
	    <li><a href="#Journals"  data-toggle="tab">Περιοδικά</a></li>
	  </ul>
	  <!-- Tab panes -->
	  <div  class="tab-content">
            
            <div class="tab-pane active" class="tab-pane" id="Books">
	              <div class="panel-body" id="search-book">
	              		<div class="row">
	                    	<div class="col-sm-6">
	                      		<h3 style="color:#FFFAF0;"><span class="glyphicon glyphicon-search"></span> Γρήγορη Αναζήτηση</h3>
	                    	</div>
	                    	<div class="col-sm-6">  
	                      		<a class="pull-right hidden-xs" href="?page=advancedSearch" id="button-ref">Σύνθετη Αναζήτηση</a>
	                    	</div>
	                  	</div>
		                <div class="row">
		                  <form  class="form-inline" id="search_books" action="?page=resultsPage" method="POST">
				                    <label class="sr-only" for="Search_Argument">Εισάγετε όρους αναζήτησης</label>
				                    <input id="Search_Argument" class="form-control easy-search-text-input" type="text" placeholder="Εισάγετε όρους αναζήτησης" 
				                    	maxlength="255" size="25" name="term" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Εισάγετε όρους αναζήτησης'"
				                    	required
                						data-fv-notempty-message/>
				                    <label class="sr-only" for="booksSearch_Code">Book Search</label>
				                    <select id="booksSearch_Code" class="form-control" name="keyword" aria-required="true">
				                      <option value="title">Λέξη-Κλειδί</option>
				                      <option value="title">Τίτλος</option>
				                      <option value="Name">Συγγραφέας</option>
				                    </select>
				                    <input class='form-control' name='category' type='hidden' value='' />
				                    <input class='form-control' name='genre' type='hidden' value='books' />
				                    <input type="submit" class="btn btn-primary" id="search-btn"alt="submit" value="Αναζήτηση" name="searchbooks">
				         </form>
		    	        </div>
		                <div class="row hidden-xs">
		                  <div class="col-sm-6">
		                  
		                    <p style="color:#FFFAF0;">Αναζητήστε Βιβλίο με βάση Λέξη-Κλειδί, Τίτλο ή Συγγραφέα</p>
		                  </div>
		                </div>
	              </div>
           	</div>
            
	    	
	    	<div class="tab-pane" id="Articles">
	    		<div class="tab-pane active" id="articlesTab">
	              <!--begin articles panel-->
	               <div class="panel-body" id="search-article">
	                  <div class="row">
	                    <div class="col-sm-6">
	                      <h3 style="color:#FFFAF0;"><span class="glyphicon glyphicon-search"></span> Γρήγορη Αναζήτηση</h3>
	                    </div>
	                    <div class="col-sm-6">  
	                      <a id="button-ref" class="pull-right hidden-xs" href="?page=advancedSearch">Σύνθετη Αναζήτηση</a>
	                    </div>
	                  </div>
	                <div class="row">   
	                  <form id="search_articles" class="form-inline" action="?page=resultsPage" method="POST">
	                    <label for="artclSubject" class="sr-only">Άρθρο</label>
	                    <input id="artclSubject" class="form-control easy-search-text-input" type="text" placeholder="Εισαγωγή λέξης κλειδιού" 
	                    	maxlength="255" size="25" name="term" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Εισαγωγή λέξης κλειδιού'"
	                    	required
                			data-fv-notempty-message>
	                      <label for="selection2" class="sr-only">Επιλέξτε Κατηγορία</label>
	                      <select id="selection2" class="form-control" name="category" aria-required="true">
	                        <?php 
	                        	$mat = new Material();
	                        	$mat->getArticleCategories();
	                        ?>
	                      </select>
	                      <input class='form-control' name='genre' type='hidden' value='articles' />
	                      <input class='form-control' name='keyword' type='hidden' value='title' />
	                      <input id="search-btn" type="submit" class="btn btn-primary" alt="submit" value="Αναζήτηση" name="searcharticles">
	                  </form>
	                </div>
	                <div class="row hidden-xs">
	                  <div class="col-sm-6">
	                    <p style="color:#FFFAF0;">Αναζήτηση άρθρου συγκεκριμένης θεματολογίας.</p>
	                  </div>
	                </div>
	              </div>
	              <!--end articles panel-->
	            </div>
	    	</div>
	    	
	    	
    		
    		<div class="tab-pane" id="Journals">
    			<div class="tab-pane active" id="journalsTab">	
    				<div class="panel-body" id="search-journal">
	                  	<div class="row">
		                    <div class="col-sm-6">
		                      <h3  style="color:#FFFAF0;"><span class="glyphicon glyphicon-search"></span> Γρήγορη Αναζήτηση</h3>
		                    </div>
		                    <div class="col-sm-6">  
		                      <a class="pull-right hidden-xs" href="?page=advancedSearch" id="button-ref">Σύνθετη Αναζήτηση</a>
		                    </div>
	                  	</div>
	                	<div class="row">   
		                  <form class="form-inline" id="search_journals" action="?page=resultsPage" method="post">
		                    <label for="jnltitle" class="sr-only">Τίτλος Περιοδικού</label>
		                    <input id="jnltitle" class="form-control easy-search-text-input es-text-no-select" type="text" 
		                    	placeholder="Εισαγωγή τίτλου" maxlength="255" size="25" name="term" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Εισαγωγή τίτλου'" aria-required="true"
			                    	required
	                				data-fv-notempty-message>
					                    <input class='form-control' name='category' type='hidden' value='' />
					                    <input class='form-control' name='genre' type='hidden' value='magazines' />
		                      			<input class='form-control' name='keyword' type='hidden' value='title' />
					                    <input id="search-btn" type="submit" class="btn btn-primary" alt="submit" value="Αναζήτηση" name="searchmagazines">
					                  </form>
					    </div>
		                <div class="row hidden-xs">
		                  	<div class="col-sm-6">
		                   		<p style="color:#FFFAF0;">Αναζήτηση περιοδικού βάση τίτλου.</p>
		                 	</div>
		                </div>
               		</div>
               	</div>
			</div>	
	 
	 </div>
	 
</div>
		
			
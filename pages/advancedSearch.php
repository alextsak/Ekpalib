<style>
#category-options,#lib-options{
	/* height: 30px;
    width: 100% */
}

#searchContainer{
	/* margin-bottom:30px;
 */	border: 1px solid white;
	border-radius: 10px;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	/* height:200px; */
	border-style: double;
}

.col-md-2,.col-md-6{
	margin-top:5px;
}

#advancedSearchButton{
    position: relative;
    float: right;
    margin-top: 80px;
}

</style>




<h4 style="margin-left:400px;text-decoration: underline;margin-bottom: 25px;color:#FFFAF0">
		Αναζήτηση βιβλίων, περιοδικών και άρθρων</h4>
<div id="searchContainer"  class="col-xs-12">
<form id="advancedSearch" action="?page=resultsPage" method="POST">
	<div >		
			<div class="col-md-2">
					<!-- <form id="radioButton-From" class="from-horizontical" > -->
					<div id="radioButton-From">
						<h5 style="text-decoration: underline;">1. Τύπος αντικειμένου</h5>
						<div >
					        <div >
					            <input type="radio" name="radio" id="all" value="all" checked>
					            Όλα
					        </div>
					        <div >
					            <input type="radio" name="radio" id="books" value="books">
					            Συγγράματα
					        </div>
					        <div>
					            <input type="radio" name="radio" id="articles" value="articles">
					           	Άρθρα
					        </div>
					        <div >
					            <input type="radio" name="radio" id="magazines" value="magazines">
					            Περιοδικά
					        </div>
					    </div>
					</div>
					<!-- </form> -->
			</div>
    
    
		    <div class="col-md-2">
					<h5 style="text-decoration: underline;">2. Επιλογή Κατηγορίας</h5>
						<select id="category-options"  class="form-control" name="category">
						</select>
			</div>
			
			<div class="col-md-6">
					<h5 style="text-decoration: underline;padding-left:30px;">3.Όροι αναζήτησης</h5> 
						<div class="col-sm-12">
							<div class="col-md-6">
					        	<div class="form-group">
									    <div class="col-sm-10">
									      <input class="form-control" name="keyword" placeholder="Λέξη κλειδί">
									    </div>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									    <div class="col-sm-10">
									      <input  class="form-control" name="author" placeholder="Συγγαφέας">
									    </div>
								</div>
							</div>
						</div>
						
						<div class="col-sm-12" >
							<div class="col-md-6">
								<div class="form-group">
							    	<div class="col-sm-10" id="publisher-form"> 
							      		<input class="form-control"  name="publisher" placeholder="Εκδότης" id="publisher">
							    	</div>
							  	</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
							    	<div class="col-sm-10" id="isbn-form">
							      		<input class="form-control" name="isbn" placeholder="ISBN" id="isbn">
							    	</div>
							  	</div>
							</div>
						</div>	
			</div>
			
			<div class="col-md-2">
					<h5 style="text-decoration: underline;">4. Επιλογή Βιβλιοθήκης</h5>
						<select id="lib-options"  class="form-control" name="library">
						  <option value="all">Όλες</option>
						  <?php	
						 	$libraries = new Libraries();
						 	$libraries->get_libraries();
						   ?>
						</select>
			</div>
		    <input type="submit" value="Αναζήτηση" id="advancedSearchButton" class="btn btn-primary" name="advancedSearch">
		     	<!-- <span class="glyphicon glyphicon-search"></span> --> 
	</div>
</form> 
</div>
<!-- <div id="bottom_borderline" class="borderline"></div> -->

	
 
							
																    
							

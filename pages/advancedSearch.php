<style>
#options{
	height: 30px;
    width: 100%
}

#searchContainer{
	margin-bottom:30px;
	border: 1px solid black;
	border-radius: 10px;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	height:200px;
	border-style: double;
}

.col-md-2,.col-md-6{
	margin-top:5px;
}

#searchButton{
    position: relative;
    float: right;
    margin-top: 80px;
}

</style>




<h4 style="margin-left:400px;text-decoration: underline;margin-bottom: 25px;">Αναζήτηση βιβλίων, περιοδικών και άρθρων</h4>

<div id="searchContainer" class="col-xs-12">		
	
	<div class="col-md-2">
			<form id="radioButton-From" class="from-horizontical">
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
			</form>
	</div>
    
    
    <div class="col-md-2">
			<form class="form-horizontal">
			<h5 style="text-decoration: underline;">2. Επιλογή Κατηγορίας</h5>
				<select id="options"  class="form-control">
				 
				</select>
			</form>
	</div>
	
	<div class="col-md-6">
		<form class="form-horizontal">
			<h5 style="text-decoration: underline;padding-left:30px;">3.Όροι αναζήτησης</h5> 
				<div class="col-sm-12">
					<div class="col-md-6">
			        	<div class="form-group">
							    <div class="col-sm-10">
							      <input class="form-control" id="keyword" placeholder="Λέξη κλειδί">
							    </div>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
							<!-- <label for="inputEmail3" class="col-sm-2 control-label">???µa S????af?a</label> -->
							    <div class="col-sm-10">
							      <input  class="form-control" id="name" placeholder="Συγγαφέας">
							    </div>
						</div>
					</div>
				</div>
				
				<div class="col-sm-12" >
					<div class="col-md-6">
						<div class="form-group">
					    	<div class="col-sm-10">
					      		<input class="form-control" id="publisher" placeholder="Εκδότης">
					    	</div>
					  	</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
					    	<div class="col-sm-10">
					      		<input class="form-control" id="isbn" placeholder="ISBN">
					    	</div>
					  	</div>
					</div>
				</div>	
			</form>
	</div>
	
	<div class="col-md-2">
			<form class="form-horizontal">
			<h5 style="text-decoration: underline;">4. Επιλογή Βιβλιοθήκης</h5>
				<select id="options"  class="form-control">
				  <option>Όλες</option>
				 <?php
				 if($_GET['page'] == 'advancedSearch') { 
				 	
				 	$libraries = new Libraries();
				 	$libraries->get_libraries_names();
				 }
				?>
				</select>
			</form>
	</div>
     <a id="searchButton" href="?page=resultsPage" class="btn btn-primary">
     	<span class="glyphicon glyphicon-search"></span>
     	Αναζήτηση
     </a> 
</div>

<!-- <div id="bottom_borderline" class="borderline"></div> -->

	
 
							
																    
							

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
	border-style: double
}

.col-md-2,.col-md-6{
	margin-top:5px;
}

#searchButton{
    position: relative;
    float: right;
    margin-top: 80px;
}

#verticalLine{
    transform: rotate(90deg);
    height: 19px;
    position: relative;
    right: 300px;
    width: 280px;
    bottom: 170px;
    border-radius:0px;
}
#verticalLine:before{
	border-radius:0px;
}
</style>


<h4 style="margin-left:400px;text-decoration: underline;margin-bottom: 25px;">Αναζήτηση βιβλίων, περιοδικών και άρθρων</h4>

<div id="searchContainer" class="col-xs-12">		
	
	<div class="col-md-2" >
			<form class="form-horizontal">
			<h5 style="text-decoration: underline;">1. Τύπος αντικειμένου</h5>
				<div class="radio">
	  				<label>
	    				<input type="radio" name="all" >
					    Όλα
					</label>
				</div>
				<div class="radio">
	  				<label>
	    				<input type="radio" name="books" >
					    Συγγράματα
					</label>
				</div>
				<div class="radio">
	  				<label>
	    				<input type="radio" name="articles" >
					    Άρθρα
					</label>
				</div>
				<div class="radio">
	  				<label>
	    				<input type="radio" name="magazines">
					    Περιοδικά
					</label>
				</div>
			</form>
	</div>
    
    
    <div class="col-md-2">
			<form class="form-horizontal">
			<h5 style="text-decoration: underline;">2. Επιλογή Κατηγορίας</h5>
				<select id="options"  class="form-control">
				  <option>
				  		Όλες
				  </option>
				  <option>2</option>
				  <option>3</option>
				  <option>4</option>
				  <option>5</option>
				  <option>5</option>
				  <option>5</option>
				  <option>5</option>
				  <option>5</option>
				  <option>5</option>
				  <option>5</option>
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
				  <option>
				  		Όλες
				  </option>
				  <option>2</option>
				  <option>3</option>
				  <option>4</option>
				  <option>5</option>
				  <option>5</option>
				  <option>5</option>
				  <option>5</option>
				  <option>5</option>
				  <option>5</option>
				  <option>5</option>
				</select>
			</form>
	</div>
     <a id="searchButton" href="?page=resultsPage" class="btn btn-primary">
     	<span class="glyphicon glyphicon-search"></span>
     	Αναζήτηση
     </a> 
</div>

<!-- <div id="bottom_borderline" class="borderline"></div> -->

	
 
							
																    
							
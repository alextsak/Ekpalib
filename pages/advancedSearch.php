<style>

#modal_1{
    width:initial;
}

#modal_2{
	width:initial;
}

#options{
	height:150px;
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


<h4 style="margin-left:280px;">Αναζήτηση βιβλίων, περιοδικών και άρθρων με πολλαπλά κριτήρια</h4>
<hr class="style-seven">

<div class="col-xs-12" style="background: beige; margin-bottom:30px; ">		
	
	<div class="col-md-3">
		<div id="modal_1" class="modal-dialog">
	        <div class="modal-content" style="width:90%">
	            <div class="modal-header">
	                <h5 class="modal-title" style="text-align: center;text-decoration: underline;">1.Επιλογή ερευνητικού πεδίου </h5>
	            </div>
	            <div class="modal-body" style="oveflow-y:auto; max-height: calc(100vh - 210px);">
		             	<select id="options" multiple class="form-control">
						  <option>
						  		Φυσική
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
	            </div>
	        </div>
   		</div>
	</div>
	
	<div class="col-md-7">
		<div id="modal_2" class="modal-dialog">
	        <div  class="modal-content"  style="width:90%;height:230px;">
	            <div class="modal-header">
	                <h5 class="modal-title" style="text-align: center;text-decoration: underline;">2.Εισαγωγή όρων αναζήτησης </h5>
	            </div>
	            <div class="modal-body">
	            	<form class="form-horizontal"> 
						<div class="col-sm-12" style="margin-top: 15px;left: 20px;">
							<div class="col-md-6">
					        	<div class="form-group">
									    <div class="col-sm-10">
									      <input type="email" class="form-control" id="keyword" placeholder="Λέξη κλειδί ή Φράση">
									    </div>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<!-- <label for="inputEmail3" class="col-sm-2 control-label">Όνομα Συγγραφέα</label> -->
									    <div class="col-sm-10">
									      <input type="email" class="form-control" id="inputEmail3" placeholder="Συγγραφέας">
									    </div>
								</div>
							</div>
						</div>
						
						<div class="col-sm-12" style="left: 20px;">
							<div class="col-md-6">
								<div class="form-group">
							    	<div class="col-sm-10">
							      		<input type="email" class="form-control" id="inputEmail3" placeholder="Βιβλιοθήκη">
							    	</div>
							  	</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
							    	<div class="col-sm-10">
							      		<input type="email" class="form-control" id="inputEmail3" placeholder="ISBN">
							    	</div>
							  	</div>
							</div>
						</div>
						
						
					</form>
	            </div>
	        </div>
    	</div> 
	</div>
    
    <div class="col-md-2">
		<div id="modal_1" class="modal-dialog">
	        <div class="modal-content" style="height:230px;width: 140%;right: 55px;">
	            <div class="modal-header">
	                <h5 class="modal-title" style="text-align: center;text-decoration: underline;">3.Ολοκλήρωση αναζήτησης </h5>
	            </div>
	            <div class="modal-body" >
             		<button type="button" class="btn btn-default" style="position: relative;left: 45px;top: 30px;">
      					<span class="glyphicon glyphicon-search"></span> Search
    				</button>
	            </div>
	        </div>
   		</div>
	</div>
    <!-- <hr id="verticalLine" class="style-seven" > -->
    
    
     
</div>

<!-- <div id="bottom_borderline" class="borderline"></div> -->

	
 
							
																    
							
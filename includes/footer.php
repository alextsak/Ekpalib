<footer  id="footer">
			<div id="footer-container">
					<h5 id="sitemap" style="color:#FFFAF0;">
					<a href="<?php echo get_basename();?>" style="color:#FFFAF0;">Αρχική</a><a>&nbsp|&nbsp</a><a href="?page=under_construction" style="color:#FFFAF0;">Χάρτης Ιστοτόπου</a></h5>

				<p id="copyright">&copy;2016 Βιβλιοθήκες ΕΚΠΑ </p> 
			</div>
	</footer>
	
</div> <!-- Container -->


<script>

/**
 * 
 *	Below are some functions for ajax requests 
 */

function detailsbook(id, page_title){
	/**
	 * detailsbook creates an ajax call to show a modal for the book details
	 */
	var data = {"id" : id, "page_title" : page_title};
	jQuery.ajax({
		url : "/Ekpalib/includes/materialDetails.php",
		method: "post",
		data : data,
		success : function(data){
			
			jQuery('body').append(data);
			jQuery('#details-material-modal').modal('toggle');
			},
		error : function(){
		alert("Something went wrong");
			}

		});
}

function detailsLibrary(id){
	/**
	 * detailsLibrary creates an ajax call to show a modal for the library details
	 */
	var data = {"id" : id};

	jQuery.ajax({
		url : "/Ekpalib/includes/lib_details.php",
		method: "post",
		data : data,
		success : function(data){
			
			$('body').append(data);
			$('#library-details-modal').modal('toggle');
			},
		error : function(){
		alert("Something went wrong");
			}

		});
}

function expand(username, materialID){
	/**
	 * expand creates an ajax call to show a modal for the expansion details
	 */
	var data = {"username" : username, "materialID" : materialID};
	jQuery.ajax({
		url : "/Ekpalib/includes/expansion.php",
		method: "post",
		data : data,
		success : function(data){
			$('body').append(data);
			$('#expansion-modal').modal('toggle');
			},
		error : function(){
		alert("Something went wrong");
			}

		});
	
}

function request_expand(username, materialID, days){
	/**
	 * request_expand creates an ajax call to send the info, that got from the expansion.php (days to expand the loan)
	 *  
	 */
	
	var data = {"request" : "expand" , "username" : username, "materialID" : materialID, "days" : days};
	jQuery.ajax({
		url : window.location.href,
		method: "post",
		data : data,
		success : function(data){
			if ( $('#expansion-modal').is(':visible') ) {
				closeModal();
			}
			location.reload(true);
			},
		error : function(){
		alert("Something went wrong");
			}

		});
	
}

function removeRequest(username, materialID){
	/**
	 * removeRequest creates an ajax call to remove the application request from the table 
	 *  
	 */
	
	var data = {request : "remove", "username" : username, "materialID" : materialID};
	jQuery.ajax({
		url : window.location.href,
		method: "post",
		data : data,
		success : function(data){
			location.reload(true);
			},
		error : function(){
		alert("Something went wrong");
			}

		});
}



</script>
</body>
</html>
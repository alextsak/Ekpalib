
	
	<footer  id="footer">
			<div id="footer-container">
					<h5 id="sitemap" style="color:#FFFAF0;">
					<a href="<?php echo get_basename();?>" style="color:#FFFAF0;">Αρχική</a><a>&nbsp|&nbsp</a><a href="#" style="color:#FFFAF0;">Χάρτης Ιστοτόπου</a></h5>
				<p id="copyright">&copy;2016 Βιβλιοθήκες ΕΚΠΑ </p> 
			</div>
	</footer>
	
</div> <!-- Container -->


<script>

/**
 * detailsbook creates an ajax call to show a modal for the book details
 */
function detailsbook(id, page_title){
	 console.log("hii");
	 console.log(id);
	 console.log(page_title);
	var data = {"id" : id, "page_title" : page_title};
	jQuery.ajax({
		url : "/Ekpalib/inc/bookDetails.php",
		method: "post",
		data : data,
		success : function(data){
			console.log(data);
			jQuery('body').append(data);
			jQuery('#details-material-modal').modal('toggle');
			},
		error : function(){
		alert("Something went wrong");
			}

		});
}

function detailsLibrary(id){
	
	var data = {"id" : id};

	jQuery.ajax({
		url : "/Ekpalib/inc/lib_details.php",
		method: "post",
		data : data,
		success : function(data){
			console.log(data);
			$('body').append(data);
			$('#library-details-modal').modal('toggle');
			},
		error : function(){
		alert("Something went wrong");
			}

		});
}

function expand(username, materialID){

	var data = {"username" : username, "materialID" : materialID};
	jQuery.ajax({
		url : "/Ekpalib/inc/expansion.php",
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
	var data = {"request" : "expand" , "username" : username, "materialID" : materialID, "days" : days};
	jQuery.ajax({
		url : window.location.href,
		method: "post",
		data : data,
		success : function(data){
			location.reload(true);
			closeModal();
			},
		error : function(){
		alert("Something went wrong");
			}

		});
	
}

function removeRequest(username, materialID){

	console.log(username);
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
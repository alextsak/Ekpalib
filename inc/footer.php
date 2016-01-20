
	
	<footer  id="footer">
			<div id="footer-container">
					<h5 id="sitemap" style="color:#FFFAF0;">
					<a href="./index.php" style="color:#FFFAF0;">Αρχική</a><a>&nbsp|&nbsp</a><a href="#" style="color:#FFFAF0;">Χάρτης Ιστοτόπου</a></h5>
				<p id="copyright">&copy; Copyright 2015-2016 EKPA Libraries </p> 
			</div>
	</footer>
	
</div> <!-- Container -->


<script>

/**
 * detailsbook creates an ajax call to show a modal for the book details
 */
function detailsbook(id){
	 console.log(id);
	var data = {"id" : id};
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
			console.log(data);
			$('body').append(data);
			$('#expansion-modal').modal('toggle');
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
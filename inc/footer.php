
	<footer>
		<div id="footer">
			<h5><a href="./index.php">Αρχική</a><a>&nbsp|&nbsp</a><a href="#">Χάρτης Ιστοτόπου</a></h5>
			<p id="copyright">&copy; Copyright 2015-2016 EKPA Libraries </p> 
		</div>
	</footer>
</div> <!-- Container -->


<script>

/**
 * detailsbook creates an ajax call to show a modal for the book details
 */
function detailsbook(id){
	
	var data = {"id" : id};
	jQuery.ajax({
		url : "/Ekpalib/inc/bookDetails.php",
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



</script>
</body>
</html>
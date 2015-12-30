
	<footer>
		<div id="footer">
			<h5><a href="./index.php">Home</a><a>&nbsp|&nbsp</a><a href="#">Sitemap</a></h5>
			<p id="copyright">&copy; Copyright 2015-2016 EKPA Libraries </p> 
		</div>
	</footer>
</div> <!-- Container -->


<script>


function detailsbook(id){
	
	var data = {"id" : id};
	jQuery.ajax({
		url : "/Ekpalib/inc/bookDetails.php",
		method: "post",
		data : data,
		success : function(data){
			jQuery('body').append(data);
			jQuery('#details-modal').modal('toggle');
			},
		error : function(){
		alert("Something went wrong");
			}

		});
}




</script>
</body>
</html>
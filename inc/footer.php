
	<footer>
		<div id="footer">
			<h5><a href="./index.php">Home</a><a>&nbsp|&nbsp</a><a href="#">Sitemap</a></h5>
		</div>
	</footer>
</div> <!-- Container -->
<div id="console-debug">
<pre>
<?php 
error_reporting(E_ALL);
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
	print_r($_SESSION['cart']);
	if(isset($_POST['removeBtn']) && $_POST['id_to_remove']!="") {
		//echo 'id to remove: ' . $_POST['id_to_remove'];
		$materialID=intval($_POST['id_to_remove']);
		print_r($_SESSION['cart'][$materialID]) ;
	}
}
if(isset($_POST['login-form'])){
	$username = $_POST['username'];
	
	echo $username;
}
?>
</pre>

</div>

<script>
$(document).ready(function(){
	$('#console-debug').hide();
	$('#btn-debug').click(function(){
		$('#console-debug').toggle();
		});
});


function deletefromCart(material_id){
	//alert(material_id);
	var page_url = window.location.href;
	var data = {"material_id": material_id};
	jQuery.ajax({
			url: page_url,
			method: "post",
			data: data,
			success: function(){

				},
			error: function(){
				alert("Something went wrong");
				}
		});
}
</script>
</body>
</html>
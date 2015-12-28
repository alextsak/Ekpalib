
	<footer>
		<div id="footer">
			<h5><a href="./index.php">Home</a><a>&nbsp|&nbsp</a><a href="#">Sitemap</a></h5>
		</div>
	</footer>
</div> <!-- Container -->
<div id="console-debug">
<pre>
<?php 
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
	print_r($_SESSION['cart']);
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
</script>
</body>
</html>
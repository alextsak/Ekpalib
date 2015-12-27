<?php 
session_start();
error_reporting(E_ALL);

function cart_func($mycart) {
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		// if a user is logged in
		print_r($mycart);
	}
	else {
		header('Location: ./login_signup.php');
	}
}

if (isset($_POST['cart_func'])) {
	cart_func($_POST['cart_func']);
}


?>


<div>
	<div>
		<h3 id="reasultsHeader">Confirm Loan</h3>
	</div>
	<div >
    	<table>
			<tr>
				<th>Title</th>
				<th>Category</th>
				<th>Author(s)</th>
				<th>ISBN</th>
				<th>Science Library</th>
				<th>Availability</th>
			</tr>
		</table>
   	</div>
</div>
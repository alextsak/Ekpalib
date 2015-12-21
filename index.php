<?php /*include some functions */require 'functions.php';?> 
<?php session_start();	
/* if(isset($_SESSION['username'])){
	echo "<h1>Welcome ";
	echo $_SESSION['username'];
	echo "</h1>";
	echo '<a href="./pages/logout.php">Logout</a>';
} */
?>
<!DOCTYPE html>
<html>
	<head>
		<base href="http://localhost:5555/Ekpalib/">
	 	<link rel="stylesheet" href="css/login-signup.css" type="text/css" media="all">
	 	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	 	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  		<script src="js/Login-Signup.js"></script>
  		<script src="bootstrap/bootstrap.js"></script>
	</head>
	
	<body>
		<div class="container">
		    	<?php include_once './inc/header.php';
						include_once './inc/menu.php';?> 
				
		</div>
	</body>
</html>










<?php include_once './inc/footer.php'; ?>
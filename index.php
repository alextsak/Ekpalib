<?php /*include some functions */require 'functions.php';?> 
<?php include_once './inc/header.php';?>
<?php session_start();	
if(isset($_SESSION['username'])){
	echo "<h1>Welcome";
	echo $_SESSION['username'];
	echo "</h1>";
	echo '<a href="./pages/logout.php">Logout</a>';
}
	
?>




<?php include_once './inc/footer.php'; ?>
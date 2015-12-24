 <?php //session_start();	
/* if(isset($_SESSION['username'])){
	echo "<h1>Welcome ";
	echo $_SESSION['username'];
	echo "</h1>";
	echo '<a href="./pages/logout.php">Logout</a>';
} */
?>
<?php 
	require_once 'controller/pageController.php';
	
	include './inc/header.php';
	include './inc/menu.php';

if(isset($_GET['page'])) {
	getPage('pages', $_GET['page'], 'main');
} else {
	getPage('pages', 'main');
}

include './inc/footer.php';

?>
 <?php //session_start();	
/* 
 * if(isset($_SESSION['username'])){
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
//sxolio
if(isset($_GET['page']) && !isset($_GET['page_no'])) {
	
	getPage('pages', $_GET['page'], 'main');
} 
elseif (isset($_GET['page_no'])) {
	
	getPage('pages', $_GET['page'], 'search_pagination');
}
else {
	getPage('pages', 'main');
}

include './inc/footer.php';

?>
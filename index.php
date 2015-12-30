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
session_start();
	require_once 'controller/pageController.php';
	
	

if(isset($_GET['page']) && !isset($_GET['page_no'])) {
	
	if($_GET['page'] == 'confirmLoan'){
		
		if(!isset($_SESSION['username'])) {
			
			header('Location: ./pages/login_signup.php');
		}
		elseif(isset($_SESSION['username']) && !isset($_SESSION['cart'])){
			echo 'Your Cart is empty!!!';
		} 
		else {
			include './inc/header.php';
			include './inc/menu.php';
			getPage('pages', $_GET['page'], 'main');
		}
	} 
	elseif($_GET['page'] == 'login_signup'){
		include './inc/header.php';
	}
	else {
		include './inc/header.php';
		include './inc/menu.php';
		getPage('pages', $_GET['page'], 'main');
	}
	
	
} 
elseif (isset($_GET['page_no'])) {
	include './inc/header.php';
	include './inc/menu.php';
	getPage('pages', $_GET['page'], 'search_pagination');
}
else {
	include './inc/header.php';
	include './inc/menu.php';
	getPage('pages', 'main');
}


include './inc/footer.php';

?>
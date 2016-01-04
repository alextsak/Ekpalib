<?php 
session_start();
require_once 'controller/pageController.php';

if(isset($_GET['page']) && !isset($_GET['page_no'])) {
	
	if($_GET['page'] == 'login_signup'){
		include './inc/header.php';
	}
	elseif($_GET['page'] == 'confirmLoan'){
		if(!isset($_SESSION['username']) || !isset($_SESSION['cart'])){
			echo "Πρόσβαση χωρίς δικαιώματα. Παρακαλώ επιστρέψτε " . "<a href=\"index.php\">πίσω</a>";
		}
		else {
			include './inc/header.php';
			include './inc/menu.php';
			getPage('pages', $_GET['page'], 'main');
		}
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
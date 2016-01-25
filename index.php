<?php 
error_reporting(E_ALL);
/**
 * Index start's the session and then serves the correct content to the user
 * 
 */
session_start();
require_once './controller/pageController.php';

$problem = 0;

$exclude_easy_search = array('confirmLoan', 'advancedSearch', 'history', 'under_construction');

if(isset($_GET['page']) && !isset($_GET['page_no'])) {
	
	if($_GET['page'] == 'login_signup'){
		include './includes/header.php';
	}
	elseif($_GET['page'] == 'confirmLoan'){
		
		if(!isset($_SESSION['username'])){
			$problem = 1;
		}
		
		else {
			include './includes/header.php';
			include './includes/menu.php';
			getPage('pages', $_GET['page'], 'main');
		}
	}
	else {
		include './includes/header.php';
		include './includes/menu.php';
		
		// check if we need to exclude easy search
		if(!in_array($_GET['page'], $exclude_easy_search)){
			include './includes/easy_search.php';
		}
		getPage('pages', $_GET['page'], 'main');
	}
	
	
} 
elseif (isset($_GET['page_no'])) {
	include './includes/header.php';
	include './includes/menu.php';
	include './includes/easy_search.php';
	getPage('pages', $_GET['page'], 'search_pagination');
}
else {
	
	include './includes/header.php';
	include './includes/menu.php';
	include './includes/easy_search.php';
	getPage('pages', 'main');
}

if($problem == 1){
	// if someone tries to get via the url to specific pages that are not allowed this message is being presented
	echo "Πρόσβαση χωρίς δικαιώματα. Παρακαλώ επιστρέψτε " . "<a href=\"index.php\">πίσω</a>";
} 
else {
	
	include './includes/footer.php';
}


?>
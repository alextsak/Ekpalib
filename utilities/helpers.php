<?php
/*""" This file contains some helpers function for the website """*/


function init_sitepath(){
	
	// we will create an associative array with key the page and value the href
	unset($_SESSION['sitepath']);
	if(!isset($_SESSION['sitepath']) && empty($_SESSION['sitepath'])) {
		// if session variable sitepath is not set then initialize it with home
		$page = "Αρχική";
		$href = "index.php";
		
		$_SESSION['sitepath'][$page] = $href;
		
	}
}

function sitepath_constructor(){
	
	$urlpath = $_SERVER['QUERY_STRING'];
	$sitepath = '';
	
	$pieces = explode("=", $urlpath);
	if(strpos($pieces[1], '&') !== FALSE) {
		// if the url string contains & then trim the pieces[1]
		$pieces_inside = explode("&", $pieces[1]);
		
		//Now pieces_inside[0] contains the desired path
		$page = $pieces_inside[0];
		
	}
	else {
		// if the url string does not contain &, just create the desired path
		$page = $pieces[1];
	}
	switch($page){
			case "resultsPage" :
			$page = 'Αποτελέσματα Αναζήτησης';
			$href = '?page=resultsPage';
			break;
		case "confirmLoan" :
			$page = 'Επιβεβαίωση Δανεισμού';
			$href = '?page=confirmLoan';
			break;
		case "advancedSearch" :
			$page = 'Σύνθετη Αναζήτηση';
			$href = '?page=advancedSearch';
			break;
		
		default :
			$page = 'no path :(';
	}
	
	if (! array_key_exists ( $page, $_SESSION ['sitepath'] )) {
		
		// echo $page . ' and ' . $href . ' do not exist';
		$_SESSION ['sitepath'] [$page] = $href;
	}
	
	foreach ( $_SESSION ['sitepath'] as $key => $value ) {
		if ($key == 'Αρχική') {
			
			$sitepath = '<a href="">' . $key . '</a>';
		} else {
			$sitepath = $sitepath . ' <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span> ' . "<a href='$value'>" . $key . '</a>';
		}
	}
	
	return $sitepath;
	
	
}


function key_val_exists($key, $val) {
	foreach ($_SESSION['sitepath'] as $item)
		if (isset($item[$key]) && $item[$key] == $val)
			return true;
		return false;
}




?>
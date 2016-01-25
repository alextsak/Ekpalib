<?php
/*""" This file contains some helpers function for the website """*/


function init_sitepath(){
	
	// we will create an associative array with key the page and value the href
	unset($_SESSION['sitepath']);
	if(!isset($_SESSION['sitepath']) && empty($_SESSION['sitepath'])) {
		// if session variable sitepath is not set then initialize it with home
		$page = "Αρχική";
		$href = get_basename();
		
		$_SESSION['sitepath'][$page] = $href;
		
	}
}

function sitepath_constructor(){
	
	
	$urlpath = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
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
		case "history" :
			$page = 'Ιστορικό Χρήστη';
			$href = '?page=history';
			break;
		case "under_construction" :
			$page = 'Υπο Κατασκευή';
			$href = get_basename();
			break;
		default :
			$page = 'no path';
			$href = get_basename();
	}
	
	if (! array_key_exists ( $page, $_SESSION ['sitepath'] )) {
		
		// echo $page . ' and ' . $href . ' do not exist';
		$_SESSION ['sitepath'] [$page] = $href;
	}
	
	foreach ( $_SESSION ['sitepath'] as $key => $value ) {
		if ($key == 'Αρχική') {
			
			$sitepath = '<a href="" style="position:relative;top:10px;left:14px;text-decoration:underline;color:#FFFAF0;">' . $key . '</a>';
		} else {
			// If the requested URI is already in the path, then add it to the path and stop construction.
			
			$current = "$_SERVER[REQUEST_URI]";
			if (strpos($current, $value) !== FALSE) {
				$sitepath = $sitepath . ' <span class="glyphicon glyphicon-chevron-right" style="color: gray;position:relative;top:12px;left:14px;" aria-hidden="true"></span> ' . "<a href='$value' style=position:relative;top:10px;left:14px;text-decoration:underline;color:#FFFAF0;>" . $key . '</a>';
				break;
			}
			else {
				$sitepath = $sitepath . ' <span class="glyphicon glyphicon-chevron-right" style="color: gray;position:relative;top:12px;left:14px;" aria-hidden="true"></span> ' . "<a href='$value' style=position:relative;top:10px;left:14px;text-decoration:underline;color:#FFFAF0;>" . $key . '</a>';
			}
			
		}
	}
	
	return $sitepath;
	
	
}


function key_val_exists($key, $val) {
	/**
	 * Check if a key exist's in array
	 * 
	 */
	foreach ($_SESSION['sitepath'] as $item)
		if (isset($item[$key]) && $item[$key] == $val)
			return true;
		return false;
}


function get_title(){
	/**
	 * Create's the title for every page. It dynamically create's the title via the url
	 * 
	 */
	$urlpath = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$title = '';
	
	if (strpos($urlpath,'?') !== FALSE) {
		
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
				$title = 'Αποτελέσματα Αναζήτησης';
					
				break;
			case "confirmLoan" :
				$title = 'Επιβεβαίωση Δανεισμού';
					
				break;
			case "advancedSearch" :
				$title = 'Σύνθετη Αναζήτηση';
					
				break;
			case "history" :
				$title = 'Ιστορικό Χρήστη';
					
				break;
			default :
				$title = 'Βιβλιοθήκες ΕΚΠΑ';
		}
	}
	else {
		// set up  a default title
		$title = 'Βιβλιοθήκες ΕΚΠΑ';
		
	}
	return $title;
	
}

function get_basename(){
	// constructs the site basename
	
	return "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/Ekpalib/";
}



?>
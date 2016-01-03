<?php
/*""" This file contains some helpers function for the website """*/


function sitepath_constructor(){
	
	$urlpath = $_SERVER['QUERY_STRING'];
	$sitepath = '';
	if(!isset($_SESSION['sitepath'])) {
		// if session variable sitepath is not set then initialize it with home
		$_SESSION['sitepath'] = array('Αρχική');
	}
	else {
		// else append it
		$page = '';
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
			case "resultsPage":
				$page = "Αποτελέσματα Αναζήτησης";
				break;
			case "confirmLoan":
				$page = "Επιβεβαίωση Δανεισμού";
				break;
			default:
				$page = 'no path :(';
		}
		if(!in_array($page, $_SESSION['sitepath'])) {
			
			array_push($_SESSION['sitepath'], $page);
			//$sitepath = ' <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span> ' . $page;
		} 

	}
	foreach($_SESSION['sitepath'] as $key=>$value)
	{
		if($value == "Αρχική") 
			$sitepath = 'Αρχική';
		else
			$sitepath = $sitepath . ' <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span> ' . $value;
		
	}
		return $sitepath;
	
	
}


?>
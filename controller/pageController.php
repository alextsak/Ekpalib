<?php
function getPage($dir, $filename, $default = false) {
	
	/*
	 * This function acts as an anchor controller for the site
	 * for every page that is called like ?page=... it automatically server the correct .php file 
	 * */
	
	$root = $_SERVER['DOCUMENT_ROOT'];
	$basename = '/Ekpalib/';
	$path = $root . $basename . $dir;

	if(is_dir($path)) {
		if(file_exists($path . '/' . $filename . '.php')){
			include $path . '/' . $filename . '.php';
			return true;
		}
	
		if($default) {
			if($default == 'search_pagination'){
				include $path . '/' . $default . '.php';
				return true;
			}
			elseif(file_exists($path . '/' . $default . '.php')){
				include $path . '/' . $default . '.php';
				return true;
			}
		}
	}
}
?>
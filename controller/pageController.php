<?php
function getPage($dir, $filename, $default = false) {
	$root = $_SERVER['DOCUMENT_ROOT'];
	$basename = '/Ekpalib/';
	$path = $root . $basename . $dir;
	
	/*if($filename == 'about'){
		echo 'I AM CALLED with params ' . $path;
	}*/
	if(is_dir($path)) {
		if(file_exists($path . '/' . $filename . '.php')){
			include $path . '/' . $filename . '.php';
			return true;
		}
		
		if($default) {
			if(file_exists($path . '/' . $default . '.php')){
				include $path . '/' . $default . '.php';
				return true;
			}
		}
	}
}
?>
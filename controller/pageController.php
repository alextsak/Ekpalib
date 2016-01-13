<?php
function getPage($dir, $filename, $default = false) {
	$root = $_SERVER['DOCUMENT_ROOT'];
	$basename = '/Ekpalib/';
	$path = $root . $basename . $dir;
//echo $path;
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
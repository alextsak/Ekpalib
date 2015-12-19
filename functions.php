<?php
function array_pluck($toPluck,$arr) {
	$ret = array();
	foreach ($arr as $item){
		$ret[] = $item[$toPluck];
	}
	return $ret;
}

function array_pluck_map($toPluck,$arr) {
	return array_map(function($item) use($toPluck){
		return $item[$toPluck];
	}, $arr);
	
	
}


function pp($value){
	echo '<pre>';
	print_r($value);
	echo '<pre>';
}
?>
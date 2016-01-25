<?php
require_once '../database/ConnectionDB/dbConnection.php';
require_once '../database/Model/Material.php';

$material = $_POST['material'];

$mat = new Material();
$result = $mat->get_categories($material);
	
$retlib = array();
while($row=$result->fetch(PDO::FETCH_ASSOC)){
	$retlib[] = array('Category'=> $row['category']);
}

echo json_encode($retlib);
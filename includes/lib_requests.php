<?php 
/**
 * 
 * Handle's the request's for the libraries search
 * 
 */

require_once '../database/ConnectionDB/dbConnection.php';
require_once '../database/Model/Libraries.php';
$lib_addr = $_POST['address'];
$lib_dep = $_POST['department'];

$libraries = new Libraries();

$libs = $libraries->searchLibraries($lib_addr,$lib_dep);


$retlib = array();
while($row=$libs->fetch(PDO::FETCH_ASSOC)){
	$retlib[] = array('name'=> $row['Name'], 'address' => $row['Address'], 'tel' => $row['Telephone'],'id'=> $row['idLibraries']);
}

echo json_encode($retlib);

 
?>		
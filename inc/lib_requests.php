<?php 
require_once '../database/ConnectionDB/dbConnection.php';
require_once '../database/Model/Libraries.php';
$lib_addr = $_POST['address'];
$lib_dep = $_POST['department'];

$libraries = new Libraries();
$libs = $libraries->searchLibraries($lib_addr,$lib_dep);
$row=$libs->fetch(PDO::FETCH_ASSOC);
echo json_encode($row);
 
			
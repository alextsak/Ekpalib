<?php 
require_once '../database/ConnectionDB/dbConnection.php';
require_once '../database/Model/Material.php';
$lib_addr = $_POST['address'];
$lib_dep = $_POST['department'];

$material = new Material();
$libraries = $material->searchLibraries($lib_addr,$lib_dep);
?>


<?php ob_start(); ?>





<?php echo ob_get_clean(); ?>
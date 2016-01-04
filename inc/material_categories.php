<?php
require_once '../database/ConnectionDB/dbConnection.php';
require_once '../database/Model/Material.php';

$material = $_POST['material'];

$mat = new Material();
$result = $mat->get_categories($material);
	

ob_start();
?>
<option>Όλες</option>
<?php foreach ($result as $key=>$row){ ?>
	<option><?php echo $row;?></option>
<?php }?>
<?php echo ob_get_clean();?>
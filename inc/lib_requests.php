<?php 
require_once '../database/ConnectionDB/dbConnection.php';
require_once '../database/Model/Libraries.php';
$lib_addr = $_POST['address'];
$lib_dep = $_POST['department'];

$libraries = new Libraries();
$libs = $libraries->searchLibraries($lib_addr,$lib_dep);

?>


<?php ob_start(); ?>
			<?php 
			while($row=$libs->fetch(PDO::FETCH_ASSOC)){?>
	            <tr>
		            <td>
		               	<div >
	                   		<?php echo $row['Name'];?>
	                   	</div>		
	                </td>
	                <td>
		               	<div >
	                   		<?php echo $row['Address'];?>
	                   	</div>		
	                </td>
	                <td>
		               	<div>
	                   		<?php echo $row['Telephone'];?>
	                   	</div>		
	                </td>
	            </tr> 
        <?php
			}
		?>
<?php echo ob_get_clean(); ?>
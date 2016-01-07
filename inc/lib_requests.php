<?php 
require_once '../database/ConnectionDB/dbConnection.php';
require_once '../database/Model/Material.php';
$lib_addr = $_POST['address'];
$lib_dep = $_POST['department'];

$libraries = new Libraries();
$libs = $libraries->searchLibraries($lib_addr,$lib_dep);
?>


<?php ob_start(); ?>
		<tr>
			<th>Όνομα</th>
			<th>Διεύθυνση</th>
			<th>Τηλέφωνο</th>
		</tr>
		<?php
		$query = 'SELECT * FROM libraries';
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			?>
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
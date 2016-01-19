<?php
class StudyRooms{

	private $db;
	

	public function __construct(){
		
		$pdo = Connection::instance();
		$this->db = $pdo->dbConnect();
	}

	
	
	public function getAllStudyRooms(){
	
		$query = 'SELECT * FROM studyrooms';	
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			?>
		            <tr>
			            <td style="text-align:center;">
		                   		<?php echo $row['Name'];?>
		                </td>
		                <td style="text-align:center;">
		                   		<?php echo $row['Address'];?>
		                </td>
		                <td style="text-align:center;">
		                   		<?php echo $row['Description'];?>
		                </td>
		            </tr> 
		        <?php
		        }
			}
	
}
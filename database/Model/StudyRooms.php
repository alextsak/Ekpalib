<?php
class StudyRooms{

	private $db;
	public static $instance;

	public function __construct(){
		self::$instance = $this;
		$this->db = new Connection();
		$this->db->ini_parser();
		$this->db = $this->db->dbConnect();
	}

	public static function get() {
		if (self::$instance === null) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	public function getAllStudyRooms(){
	
		$query = 'SELECT * FROM studyrooms';
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
		                   		<?php echo $row['Description'];?>
		                   	</div>		
		                </td>
		            </tr> 
		        <?php
		        }
			}
	
}
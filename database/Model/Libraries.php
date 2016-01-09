<?php


class Libraries{
	
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
	
	
	public function get_department_names(){
		$st = $this->db->prepare("SELECT Name FROM universitydepartment");
		
		$st->execute();
		if($st->rowCount()>0)
			while($row=$st->fetch(PDO::FETCH_ASSOC))				
				echo '<option>'.$row['Name'].'</option>';
		else 
			echo '<script>alert(\"Errror\")</script>';
		
	}
	
	public function QuickSearch($params){
	
		// Search to all columns for given parameter
	
		$st = $this->db->prepare("SELECT * FROM libraries WHERE Concat(`Name`,`Site`,`Address`,`Telephone`,`Fax`,`Informations`) LIKE ('%?%')");
		$st->bindParam(1, $params);
	
	
		if($st->execute()){
			return $st->get_result();
		}
		else {
			echo 'Values did NOT insert correctly';
		}
	}
	
	public function Search(array $params){
	
		// Advanced Search
	
		$st = $this->db->prepare("SELECT * FROM libraries WHERE `Name` LIKE '%?%' or `Address` LIKE '%?%' or `Telephone` LIKE '%?%' or `Fax` LIKE '%?%'");
		$st->bindParam(1, $params[0]);
		$st->bindParam(2, $params[1]);
		$st->bindParam(3, $params[2]);
		$st->bindParam(4, $params[3]);
	
	
		if($st->execute()){
			return $st->get_result();
		}
		else {
			echo 'Values did NOT insert correctly';
		}
	}
	
	public function Add_New_Lib(array $params){
	
		// it might need another insertion
	
		$st = $this->db->prepare("INSERT INTO Libraries (`idLibraries`,`Name`,`Site`,`Address`,`Telephone`,`Fax`,`Informations`) VALUES (?,?�?�?,?,?,?);");
		$st->bindParam(1, $params[0]);
		$st->bindParam(2, $params[1]);
		$st->bindParam(3, $params[2]);
		$st->bindParam(4, $params[3]);
		$st->bindParam(5, $params[4]);
		$st->bindParam(6, $params[5]);
		$st->bindParam(7, $params[6]);
	
	
		if($st->execute()){
			$message="New Library Inserted successfully!";
		}
		else {
			echo 'Values did NOT insert correctly';
		}
	}
	
	
	/********************************************************************************************************************/
	
	public function get_library_by_param($param){
		// get's library name, address, email/site according to the parameter given, e.g. address, department
		
	}
	
	public function get_library_details($lib_id){
		$query = 'select * from libraries where idlibraries =  ?';
			
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $lib_id);
		$stmt->execute();
		if($stmt->rowCount() > 0)
			return $stmt;
		
		return -1;
	}
	
	public function searchLibraries($lib_addr,$lib_dep){
		
		if($lib_addr == "" && $lib_dep != ""){
			$query1 = 'SELECT DISTINCT(libraries.idLibraries),libraries.Name,libraries.Address,libraries.Telephone'.
					' FROM   libraries,universitydepartment'.
					' where  libraries.idLibraries = universitydepartment.idLibraries and'.
					' universitydepartment.Name = ?';
			
			$stmt = $this->db->prepare($query1);
			$stmt->bindParam(1, $lib_dep);
		}
		elseif($lib_addr != "" && $lib_dep == ""){
			$query2 = 'SELECT DISTINCT(libraries.idLibraries),libraries.Name,libraries.Address,libraries.Telephone'.
					' FROM   libraries,universitydepartment'.
					' where  libraries.idLibraries = universitydepartment.idLibraries and'.
					' libraries.Address LIKE ?';
				
			$stmt = $this->db->prepare($query2);
			$lib_addr = '%'.$lib_addr.'%';
			$stmt->bindParam(1, $lib_addr);
			
		}
		else {
			$query = 'SELECT DISTINCT(libraries.idLibraries),libraries.Name,libraries.Address,libraries.Telephone'.
					' FROM   libraries,universitydepartment'.
					' where  libraries.idLibraries = universitydepartment.idLibraries and'.
					' universitydepartment.Name = ? and libraries.Address LIKE ?';
			
			$stmt = $this->db->prepare($query);
			$lib_addr = '%'.$lib_addr.'%';
			$stmt->bindParam(1, $lib_dep);
			$stmt->bindParam(2, $lib_addr);
			
		}
		$stmt->execute();
		if($stmt->rowCount() > 0)
			return $stmt;
		
		return -1;
	
	}
	
	public function getAllLibraries(){
		
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
	                <td style="width:120px;">
						<button class="btn btn-primary btn-sm" type="button" onclick="detailsLibrary(<?php echo $row['idLibraries'];?>)">
							<span class="glyphicon glyphicon-info-sign" ></span>
						</button>
					</td>
	            </tr> 
	        <?php
	        }
		}
	
}

<?php
class anggota{
	
	private $conn;
	private $table_name = "anggota";
	
	public $ka;
	public $na;
	public $la;
	public $dl;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){
		
		$query = "insert into ".$this->table_name." values(:ka,:na,:la,:dl)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':ka', $this->ka);
		$stmt->bindParam(':na', $this->na);
		$stmt->bindParam(':la', $this->la);
		$stmt->bindParam(':dl', $this->dl);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	function readAll(){

		$query = "SELECT * FROM ".$this->table_name." ORDER BY kode_anggota ASC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		
		return $stmt;
	}
	
	// used when filling up the update product form
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE kode_anggota LIKE %:ka%";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':ka', $this->ka);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$dataee = array();
		$this->ka = $row['kode_anggota'];
		$this->na = $row['nama_anggota'];
		$this->la = $row['limit_anggota'];
		$this->dl = $row['deadline'];
	}
	
	// update the product
	function update(){

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					nama_anggota = :na,  
					limit_anggota = :la,
					deadline = :dl
				WHERE
					kode_anggota = :ka";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':ka', $this->ka);
		$stmt->bindParam(':na', $this->na);
		$stmt->bindParam(':la', $this->la);
		$stmt->bindParam(':dl', $this->dl);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	// delete the product
	function delete(){
	
		$query = "DELETE FROM " . $this->table_name . " WHERE kode_anggota = :ka";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':ka', $this->ka);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}
?>
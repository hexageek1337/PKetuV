<?php
class value{
	
	private $conn;
	private $table_name = "value";
	
	public $id;
	public $kt;
	public $jm;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){
		$query = "insert into ".$this->table_name." values(NULL,:kt,:jm)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':kt', $this->kt);
		$stmt->bindParam(':jm', $this->jm);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	function readAll(){

		$query = "SELECT * FROM ".$this->table_name." ORDER BY id_nilai ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	
	// used when filling up the update product form
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id_nilai = :id LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(':id', $this->id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['id_nilai'];
		$this->kt = $row['ket_nilai'];
		$this->jm = $row['jum_nilai'];
	}
	
	// update the product
	function update(){

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					ket_nilai = :kt,  
					jum_nilai = :jm
				WHERE
					id_nilai = :id";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':kt', $this->kt);
		$stmt->bindParam(':jm', $this->jm);
		$stmt->bindParam(':id', $this->id);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	// delete the product
	function delete(){
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_nilai = :id";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $this->id);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}
?>
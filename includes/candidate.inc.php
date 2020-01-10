<?php
class candidate{
	
	private $conn;
	private $table_name = "candidate";
	
	public $id;
	public $kt;
	public $ip;
	public $jm;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){
		
		$query = "insert into ".$this->table_name." values('',:ip,:kt,'')";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':ip', $this->ip);
		$stmt->bindParam(':kt', $this->kt);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	function readAll(){

		$query = "SELECT * FROM ".$this->table_name." ORDER BY id_candidate ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	
	// used when filling up the update product form
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id_candidate = :id LIMIT 0,1";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $this->id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['id_candidate'];
		$this->ip = $row['id_pengguna'];
		$this->kt = $row['nama_candidate'];
	}

	// used when filling up the update product form
	function readKandidatUser(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id_pengguna = :ip LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(':ip', $this->ip);
		$stmt->execute();

		return $stmt->fetchColumn();
	}
	
	// update the product
	function update($option){
		if (isset($option)) {
			if ($option == "candidate") {
				$where_field = 'id_candidate';
			} elseif ($option == "pengguna") {
				$where_field = 'id_pengguna';
			}
		} else {
			$where_field = 'id_candidate';
		}

		$query = "UPDATE " . $this->table_name . " SET nama_candidate = :kt WHERE ".$where_field." = :id";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':kt', $this->kt);
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
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_candidate = :id";
		
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
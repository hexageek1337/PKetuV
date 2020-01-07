<?php
class User{
	
	private $conn;
	private $table_name = "pengguna";
	
	public $id;
	public $nl;
	public $un;
	public $pw;
	public $rl;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){
		
		$query = "insert into ".$this->table_name." values(NULL,?,?,?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->nl);
		$stmt->bindParam(2, $this->un);
		$stmt->bindParam(3, $this->pw);
		$stmt->bindParam(4, $this->rl);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	function readAll(){

		$query = "SELECT * FROM ".$this->table_name." ORDER BY id_pengguna ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	
	// used when filling up the update product form
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id_pengguna=? LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['id_pengguna'];
		$this->nl = $row['nama_lengkap'];
		$this->un = $row['username'];
		$this->pw = $row['password'];
	}
	
	// update the product
	function update($option){
		if (isset($option)) {
			if ($option == "fcandidate") {
				$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					nama_lengkap = :nm
				WHERE
					id_pengguna = :id";
			} elseif ($option == "fpengguna") {
				$query = "UPDATE 
							" . $this->table_name . " 
						SET 
							nama_lengkap = :nm, 
							username = :un, 
							password = :ps,
							role = :rl
						WHERE
							id_pengguna = :id";
			}
		} else {
			$query = "UPDATE 
							" . $this->table_name . " 
						SET 
							nama_lengkap = :nm, 
							username = :un, 
							password = :ps,
							role = :rl
						WHERE
							id_pengguna = :id";
		}

		$stmt = $this->conn->prepare($query);

		if (isset($option)) {
			if ($option == "fcandidate") {
				$stmt->bindParam(':nm', $this->nl);
				$stmt->bindParam(':id', $this->id);
			} elseif ($option == "fpengguna") {
				$stmt->bindParam(':rl', $this->rl);
				$stmt->bindParam(':nm', $this->nl);
				$stmt->bindParam(':un', $this->un);
				$stmt->bindParam(':ps', $this->pw);
				$stmt->bindParam(':id', $this->id);
			}
		} else {
			$stmt->bindParam(':rl', $this->rl);
			$stmt->bindParam(':nm', $this->nl);
			$stmt->bindParam(':un', $this->un);
			$stmt->bindParam(':ps', $this->pw);
			$stmt->bindParam(':id', $this->id);
		}
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	// delete the product
	function delete(){
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_pengguna = ?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}
?>

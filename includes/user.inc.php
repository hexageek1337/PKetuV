<?php
class User{
	
	private $conn;
	private $table_name = "pengguna";
	private $table_dua = "event";
	
	public $id;
	public $ka;
	public $nl;
	public $un;
	public $pw;
	public $rl;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){
		$hashedPassword = password_hash($this->pw, PASSWORD_BCRYPT);
		$query = "insert into ".$this->table_name." values(NULL,:ka,:nl,:un,:pw,:rl)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':ka', $this->ka);
		$stmt->bindParam(':nl', $this->nl);
		$stmt->bindParam(':un', $this->un);
		$stmt->bindParam(':pw', $hashedPassword);
		$stmt->bindParam(':rl', $this->rl);
		
		if($stmt->execute()){
			return true;
		} else {
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
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id_pengguna = :id LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(':id', $this->id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['id_pengguna'];
		$this->nl = $row['nama_lengkap'];
		$this->un = $row['username'];
		$this->pw = $row['password'];
	}

	// used when filling up the update product form
	function readevent(){
		
		$query = "SELECT * FROM " . $this->table_dua . " WHERE kode_event = :ka LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(':ka', $this->ka);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$dataee = array();
		$dataee['kode_event'] = $row['kode_event'];
		$dataee['nama_event'] = $row['nama_event'];
		$dataee['limit_event'] = $row['limit_event'];
		$dataee['deadline'] = $row['deadline'];

		return $dataee;
	}

	// used when filling up the update product form
	function jumlahVoterTerdaftar(){
		
		$query = "SELECT COUNT(kode_event) AS jvterdaftar FROM " . $this->table_name . " WHERE kode_event=:ka LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(':ka', $this->ka);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$dataee = array();
		$dataee['jvterdaftar'] = $row['jvterdaftar'];

		return $dataee;
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
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_pengguna = :id";
		
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

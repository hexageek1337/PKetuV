<?php
class voting{
	
	private $conn;
	private $table_name = "voting";
	
	public $ia;
	public $id_pengguna;
	public $ik;
	public $nn;
	public $nn2;
	public $nn3;
	public $mnr1;
	public $mnr2;
	public $has;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){
		
		$query = "insert into ".$this->table_name." values(:ia,:ik,:id_pengguna,:nn)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':ia', $this->ia);
		$stmt->bindParam(':ik', $this->ik);
		$stmt->bindParam(':id_pengguna', $this->id_pengguna);
		$stmt->bindParam(':nn', $this->nn);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	function readAll(){

		$query = "SELECT * FROM ".$this->table_name;
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	
	function readKhusus(){

		$query = "SELECT * FROM candidate a, criteria b, voting c where a.id_candidate=c.id_candidate and b.id_kriteria=c.id_kriteria AND c.id_pengguna = :id_pengguna order by a.id_candidate asc";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(':id_pengguna', $this->id_pengguna);
		$stmt->execute();
		
		return $stmt;
	}
	
	function readR($a){

		$query = "SELECT * FROM candidate a, criteria b, ranking c where a.id_candidate=c.id_candidate and b.id_kriteria=c.id_kriteria and c.id_candidate='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	
	function readMax($b){
		
		$query = "SELECT max(nilai_voting) as mnr1 FROM " . $this->table_name . " WHERE id_kriteria='$b' LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}
	
	function readMin($b){
		
		$query = "SELECT min(nilai_voting) as mnr2 FROM " . $this->table_name . " WHERE id_kriteria='$b' LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}
	
	
	function readHasil($a){
		
		$query = "SELECT sum(bobot_normalisasi) as bbn FROM " . $this->table_name . " WHERE id_candidate='$a' LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}
	
	// used when filling up the update product form
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id_candidate = :ia AND id_kriteria = :ik AND id_pengguna = :id_pengguna LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(':ia', $this->ia);
		$stmt->bindParam(':ik', $this->ik);
		$stmt->bindParam(':id_pengguna', $this->id_pengguna);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->ia = $row['id_candidate'];
		$this->ik = $row['id_kriteria'];
		$this->nn = $row['nilai_voting'];
	}

	// used when filling up the update product form
	function rangkingvoting(){
		$query = "SELECT id_candidate,id_kriteria,SUM(nilai_voting)/(SELECT COUNT(id_pengguna) FROM pengguna WHERE role = 'Voter') AS jumlahvoting FROM " . $this->table_name . " WHERE id_kriteria = :ik AND id_candidate = :ia";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(':ia', $this->ia);
		$stmt->bindParam(':ik', $this->ik);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$datae = array();
		$datae['id_candidate'] = $row['id_candidate'];
		$datae['id_kriteria'] = $row['id_kriteria'];
		$datae['jumlahvoting'] = $row['jumlahvoting'];

		return $datae;
	}
	
	// update the product
	function update(){

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					nilai_voting = :nn
				WHERE
					id_candidate = :ia 
				AND
					id_kriteria = :ik
				AND
					id_pengguna = :id_pengguna";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nn', $this->nn);
		$stmt->bindParam(':ia', $this->ia);
		$stmt->bindParam(':ik', $this->ik);
		$stmt->bindParam(':id_pengguna', $this->id_pengguna);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function normalisasi(){

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					nilai_normalisasi = :nn2,
					bobot_normalisasi = :nn3
				WHERE
					id_candidate = :ia 
				AND
					id_kriteria = :ik";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nn2', $this->nn2);
		$stmt->bindParam(':nn3', $this->nn3);
		$stmt->bindParam(':ia', $this->ia);
		$stmt->bindParam(':ik', $this->ik);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function hasil(){

		$query = "UPDATE 
					candidate
				SET 
					hasil_candidate = :has
				WHERE
					id_candidate = :ia";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':has', $this->has);
		$stmt->bindParam(':ia', $this->ia);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	// delete the product
	function delete(){
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_candidate = ? and id_kriteria = ?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->ia);
		$stmt->bindParam(2, $this->ik);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}
?>
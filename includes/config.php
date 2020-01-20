<?php
class Config{
	/* Config Connection Database */
	private $host = "localhost";
	private $db_name = "dbspk";
	private $username = "root";
	private $password = "";
	public $conn;
	/* Config Site */
	public $title = "PKetuV"; // this title your website
	public $description = "Pemilihan Ketua Organisasi berdasarkan Voting";
	public $keywords = "pemilihan,ketua,voting,pketuv,spk,pendukung,keputusan"; // this keyword your website
	public $author = "Denny Septian";
	/* Meta Tag Config */
	public $google = "-aEi2vbBOMhSakw1f8_Kd2opa9bnJMNKCMOEsX4lROw";
	public $alexa = "X_XYKdWXrp0DhuyeL9ORhHijmCs";
	/* Meta Tag Sosial Media */
	// Facebook
	public $fbpagesid = "1867255716844226";
	public $fbid = "";
	// Twitter
	public $twsiteid = "3167728602";
	public $twtid = "";
	
	public function getConnection(){
	
		$this->conn = null;
		
		try{
			$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
		}catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}
		
		return $this->conn;
	}

	public function link()
	{
		return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/";
	}
}
?>
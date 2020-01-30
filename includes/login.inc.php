<?php 
class Login
{
	private $conn;
	private $table_name = "pengguna";
	
    public $user;
    public $userid;
    public $passid;

    public function __construct($db){
		$this->conn = $db;
	}

    public function login()
    {
        $user = $this->checkCredentials();
        if ($user) {
            $this->user = $user;
			session_start();
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            $_SESSION['id_pengguna'] = $user['id_pengguna'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['kdevent'] = $user['kode_event'];
            $_SESSION['role'] = base64_encode($user['role']);
            return $user['nama_lengkap'];
        } else {
            return false;
        }
    }

    protected function checkCredentials()
    {
        $stmt = $this->conn->prepare('SELECT * FROM '.$this->table_name.' WHERE username = ?');
		$stmt->bindParam(1, $this->userid);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $submitted_pass = $this->passid;

            if (password_verify($submitted_pass, $data['password'])) {
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getUser()
    {
        return $this->user;
    }
}
?>

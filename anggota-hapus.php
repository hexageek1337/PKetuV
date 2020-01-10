<?php
include_once "includes/config.php";
$database = new Config();
$db = $database->getConnection();

include_once 'includes/anggota.inc.php';
$pro = new anggota($db);
$ka = isset($_GET['ka']) ? $_GET['ka'] : die('ERROR: missing kode.');
$pro->ka = addslashes($ka);
	
if($pro->delete()){
	echo "<script>location.href='anggota.php';</script>";
} else{
	echo "<script>alert('Gagal Hapus Data');location.href='anggota.php';</script>";
		
}
?>

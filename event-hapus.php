<?php
include_once "includes/config.php";
$database = new Config();
$db = $database->getConnection();

include_once 'includes/event.inc.php';
$pro = new event($db);
$ka = isset($_GET['ka']) ? $_GET['ka'] : die('ERROR: missing kode.');
$pro->ka = addslashes($ka);
	
if($pro->delete()){
	echo "<script>location.href='event.php';</script>";
} else{
	echo "<script>alert('Gagal Hapus Data');location.href='event.php';</script>";
		
}
?>

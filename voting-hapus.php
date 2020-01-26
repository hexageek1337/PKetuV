<?php
date_default_timezone_set('Asia/Jakarta');
include_once "includes/config.php";
$database = new Config();
$db = $database->getConnection();

include_once 'includes/voting.inc.php';
$pro = new voting($db);
$dateQ = date('Y-m-d h:i:s');
$dataevent = $pro->readeventDeadline();

if ($dateQ <= $dataevent['deadline']) {
	$ia = isset($_GET['ia']) ? $_GET['ia'] : die('ERROR: missing ID.');
	$pro->ia = $ia;
	$ik = isset($_GET['ik']) ? $_GET['ik'] : die('ERROR: missing ID.');
	$pro->ik = $ik;
		
	if($pro->delete()){
		echo "<script>location.href='voting.php';</script>";
	} else {
		echo "<script>alert('Gagal Hapus Data');location.href='voting.php';</script>";
			
	}
} else {
	echo "<script>location.href='voting.php'</script>";
}
?>

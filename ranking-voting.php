<?php
if (isset($_POST['ia']) AND isset($_POST['ik'])) {
	include "includes/config.php";
	$config = new Config();
	$db = $config->getConnection();
	include_once 'includes/voting.inc.php';
	$eks = new voting($db);
	$eks->ia = addslashes($_POST['ia']);
	$eks->ik = addslashes($_POST['ik']);

	$data = $eks->rangkingvoting();
	$result = json_encode($data, JSON_PRETTY_PRINT);

	print_r($result);

	return $result;
}
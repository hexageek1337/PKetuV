<?php
include_once 'header.php';
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

include_once 'includes/user.inc.php';
include_once 'includes/candidate.inc.php';
$eks = new candidate($db);
$pro = new User($db);

if ($_SESSION['id_pengguna'] != 1 OR $_SESSION['id_pengguna'] != "1") {
	$eks->id = intval($id);
	$pro->id = intval($_SESSION['id_pengguna']);
} elseif ($_SESSION['id_pengguna'] == 1 OR $_SESSION['id_pengguna'] == "1") {
	$eks->id = intval($id);
	$pro->id = intval($_SESSION['id_pengguna'])+1;
}

$eks->readOne();

if($_POST){
	$pro->nl = addslashes($_POST['kt']);
	$eks->kt = addslashes($_POST['kt']);
	
	if($eks->update('candidate') AND $pro->update('fcandidate')){
		if ($_SESSION['id_pengguna'] != 1 OR $_SESSION['id_pengguna'] != "1") {
			$_SESSION['nama_lengkap'] = addslashes($_POST['kt']);
		}
		echo "<script>location.href='candidate.php'</script>";
	} else {
?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Gagal Ubah Data!</strong> Terjadi kesalahan, coba sekali lagi.
</div>
<?php
	}
}
?>
		<div class="row">
		  <div class="col-xs-12 col-sm-12 col-md-8">
		  	<div class="page-header">
			  <h5>Ubah candidate</h5>
			</div>
			
			    <form method="post">
				  <div class="form-group">
				    <label for="kt">Nama Candidate</label>
				    <input type="text" class="form-control" id="kt" name="kt" value="<?php echo $eks->kt; ?>">
				  </div>
				  <button type="submit" class="btn btn-primary">Ubah</button>
				  <button type="button" onclick="location.href='candidate.php'" class="btn btn-success">Kembali</button>
				</form>
			  
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-4">
		  	<?php include_once 'sidebar.php'; ?>
		  </div>
		</div>
		<?php
include_once 'footer.php';
?>
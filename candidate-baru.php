<?php
include_once 'header.php';
if (isset($_GET['id']) AND $_GET['id'] != '') {
	$id_pengguna = intval($_GET['id']);
	include_once 'includes/candidate.inc.php';
	$eks = new candidate($db);
	$eks->ip = intval($id_pengguna);
	$stmk = $eks->readKandidatUser();
	if (isset($_GET['id']) AND $_GET['id'] == 1) { ?>
		<div class="container">
			<div class="text-center">User Admin tidak bisa dijadikan login untuk Kandidat!</div>
		</div>
	<?php } elseif ($stmk > 0) {?>
		<div class="container">
			<div class="text-center">User sudah digunakan untuk login Kandidat lain!</div>
		</div>
	<?php } else {
if($_POST){
	$eks->kt = addslashes($_POST['kt']);
	$eks->ip = intval($id_pengguna);
	
	if($eks->insert()){
?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Berhasil Tambah Data!</strong> Tambah lagi atau <a href="candidate.php">lihat semua data</a>.
</div>
<?php
	}
	
	else{
?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Gagal Tambah Data!</strong> Terjadi kesalahan, coba sekali lagi.
</div>
<?php
	}
}
?>
		<div class="row">
		  <div class="col-xs-12 col-sm-12 col-md-8">
		  	<div class="page-header">
			  <h5>Tambah Kandidat</h5>
			</div>
			
			    <form method="post">
				  <div class="form-group">
				    <label for="kt">Nama Kandidat</label>
				    <input type="text" class="form-control" id="kt" name="kt" required>
				  </div>
				  <div class="form-group">
				    <label for="kt">User ID</label>
				    <input type="text" class="form-control" id="ip" name="ip" value="<?=$id_pengguna?>" disabled required>
				  </div>
				  <button type="submit" class="btn btn-primary">Simpan</button>
				  <button type="button" onclick="location.href='candidate.php'" class="btn btn-success">Kembali</button>
				</form>
			  
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-4">
		  	<?php include_once 'sidebar.php'; ?>
		  </div>
		</div>
		<?php }
} else { ?>
	<div class="container">
		<div class="text-center">Sebelum membuat Kandidat baru diharapkan membuat User terlebih dahulu!</div>
	</div>
<?php }
include_once 'footer.php';
?>
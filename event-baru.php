<?php
include_once 'header.php';
if($_POST){
	
	include_once 'includes/event.inc.php';
	$eks = new event($db);

	$eks->ka = addslashes($_POST['ka']);
	$eks->na = addslashes($_POST['na']);
	$eks->la = addslashes($_POST['la']);
	$eks->dl = addslashes($_POST['dl']);
	
	if($eks->insert()){
?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Berhasil Tambah Data!</strong> Tambah lagi atau <a href="event.php">lihat semua data</a>.
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
			  <h5>Tambah Event</h5>
			</div>
			
			    <form method="post">
				  <div class="form-group">
				    <label for="ka">Kode Event</label>
				    <input type="text" class="form-control" id="ka" name="ka" maxlength="6" required>
				  </div>
				  <div class="form-group">
				    <label for="na">Nama Event</label>
				    <input type="text" class="form-control" id="na" name="na" required>
				  </div>
				  <div class="form-group">
				    <label for="la">Limit Event</label>
				    <input type="number" class="form-control" id="la" name="la" required>
				  </div>
				  <div class="form-group">
				    <label for="dl">Deadline</label>
				    <input type="date" class="form-control" id="dl" name="dl" required>
				  </div>
				  <button type="submit" class="btn btn-primary">Simpan</button>
				  <button type="button" onclick="location.href='event.php'" class="btn btn-success">Kembali</button>
				</form>
			  
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-4">
		  	<?php include_once 'sidebar.php'; ?>
		  </div>
		</div>
		<?php
include_once 'footer.php';
?>
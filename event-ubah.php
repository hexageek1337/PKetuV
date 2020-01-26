<?php
include_once 'header.php';
$ka = isset($_GET['ka']) ? $_GET['ka'] : die('ERROR: missing ka.');

include_once 'includes/event.inc.php';
$eks = new event($db);

$eks->ka = $ka;
$eks->readOne();

if($_POST){
	$eks->ka = addslashes($_POST['ka']);
	$eks->na = addslashes($_POST['na']);
	$eks->la = addslashes($_POST['la']);
	$eks->dl = addslashes($_POST['dl']);
	
	if($eks->update()){
		echo "<script>location.href='event.php'</script>";
	} else{
?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hkaden="true">&times;</span></button>
  <strong>Gagal Ubah Data!</strong> Terjadi kesalahan, coba sekali lagi.
</div>
<?php
	}
}
?>
		<div class="row">
		  <div class="col-xs-12 col-sm-12 col-md-8">
		  	<div class="page-header">
			  <h5>Ubah event</h5>
			</div>
			
			    <form method="post">
				  <div class="form-group">
				    <label for="ka">Kode event</label>
				    <input type="text" class="form-control" id="ka" name="ka" value="<?=$ka?>" readonly>
				  </div>
				  <div class="form-group">
				    <label for="na">Nama event</label>
				    <input type="text" class="form-control" id="na" name="na" value="<?=$eks->na?>">
				  </div>
				  <div class="form-group">
				    <label for="la">Limit event</label>
				    <input type="number" class="form-control" id="la" name="la" value="<?=$eks->la?>">
				  </div>
				  <div class="form-group">
				    <label for="dl">Deadline</label>
				    <input type="date" class="form-control" id="dl" name="dl" value="<?=$eks->dl?>">
				  </div>
				  <button type="submit" class="btn btn-primary">Ubah</button>
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
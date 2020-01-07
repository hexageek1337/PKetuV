<?php
include_once 'header.php';
include_once 'includes/candidate.inc.php';
$pgn1 = new candidate($db);
include_once 'includes/criteria.inc.php';
$pgn2 = new criteria($db);
include_once 'includes/value.inc.php';
$pgn3 = new value($db);
if($_POST){
	
	include_once 'includes/ranking.inc.php';
	$eks = new ranking($db);

	$eks->ia = $_POST['ia'];
	$eks->ik = $_POST['ik'];
	$eks->nn = $_POST['nn'];
	
	if($eks->insert()){
?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Berhasil Tambah Data!</strong> Tambah lagi atau <a href="ranking.php">lihat semua data</a>.
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
			  <h5>Tambah ranking</h5>
			</div>
			
			    <form method="post">
				  <div class="form-group">
				    <label for="ia">candidate</label>
				    <select class="form-control" id="ia" name="ia">
				    	<?php
						$stmt3 = $pgn1->readAll();
						while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
							extract($row3);
							echo "<option value='{$id_candidate}'>{$nama_candidate}</option>";
						}
					    ?>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="ik">criteria</label>
				    <select class="form-control" id="ik" name="ik">
				    	<?php
						$stmt2 = $pgn2->readAll();
						while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
							extract($row2);
							echo "<option value='{$id_kriteria}'>{$nama_kriteria}</option>";
						}
					    ?>
				    </select>
				  </div>
				  <div class="form-group">
				  	<label for="nn">Nilai</label>
				  	<div class="row" id="nn">
				  		<div class="col-xs-10">
				  			<input class="form-control" type="text" id="nndata" name="nn" value="">
				  		</div>
				  		<div class="col-xs-2">
				  			<a class="btn btn-primary" id="getdataavg">GET Data</a>
				  		</div>
				  	</div>
				  </div>
				  <button type="submit" class="btn btn-primary">Simpan</button>
				  <button type="button" onclick="location.href='ranking.php'" class="btn btn-success">Kembali</button>
				</form>
			  
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-4">
		  	<?php include_once 'sidebar.php'; ?>
		  </div>
		</div>
		<?php
include_once 'footer.php';
?>
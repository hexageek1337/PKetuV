<?php
include_once 'header.php';
include_once 'includes/candidate.inc.php';
$pgn1 = new candidate($db);
include_once 'includes/criteria.inc.php';
$pgn2 = new criteria($db);
include_once 'includes/value.inc.php';
$pgn3 = new value($db);
if($_POST){
	
	include_once 'includes/voting.inc.php';
	$eks = new voting($db);

	$eks->ia = addslashes($_POST['ia']);
	$eks->ik = addslashes($_POST['ik']);
	$eks->id_pengguna = intval($_SESSION['id_pengguna']);
	$eks->nn = addslashes($_POST['nn']);
	
	if($eks->insert()){
?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Berhasil Tambah Data!</strong> Tambah lagi atau <a href="voting.php">lihat semua data</a>.
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
			  <h5>Tambah voting</h5>
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
				    <label for="nn">Kategori Nilai</label>
				    <select class="form-control" id="nn" name="nn">
				    	<?php
						$stmt4 = $pgn3->readAll();
						while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)){
							extract($row4);
							echo "<option value='{$jum_nilai}'>{$ket_nilai}</option>";
						}
					    ?>
				    </select>
				  </div>
				  <button type="submit" class="btn btn-primary">Simpan</button>
				  <button type="button" onclick="location.href='voting.php'" class="btn btn-success">Kembali</button>
				</form>
			  
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-4">
		  	<?php include_once 'sidebar.php'; ?>
		  </div>
		</div>
		<?php
include_once 'footer.php';
?>
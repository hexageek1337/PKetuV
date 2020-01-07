<?php
include_once 'header.php';
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] != base64_encode('Voter')) { ?>
        <div class="container">
            <div class="text-center">Halaman ini hanya untuk hak akses Admin saja!</div>
        </div>
    <?php } else {
include_once 'includes/candidate.inc.php';
$pro1 = new candidate($db);
$stmt1 = $pro1->readAll();
include_once 'includes/criteria.inc.php';
$pro2 = new criteria($db);
$stmt2 = $pro2->readAll();
include_once 'includes/voting.inc.php';
$pro = new voting($db);
$pro->id_pengguna = intval($_SESSION['id_pengguna']);
$stmt = $pro->readKhusus();
?>
	<br/>
	<div>
	
	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active"><a href="#lihat" aria-controls="lihat" role="tab" data-toggle="tab">Lihat Semua Data</a></li>
	    <li role="presentation"><a href="voting-baru.php" role="tab">Tambah Data</a></li>
	  </ul>
	
	  <!-- Tab panes -->
	  <div class="tab-content">
	    <div role="tabpanel" class="tab-pane active" id="lihat">
	    	<br/>
	    	<div class="row">
				<div class="col-md-6 text-left">
					<h4>Data Voting</h4>
				</div>
				<div class="col-md-6 text-right">
					<button onclick="location.href='voting-baru.php'" class="btn btn-primary" id="btn-tambah">Tambah Data</button>
				</div>
			</div>
			<br/>
			<table width="100%" class="table table-striped table-bordered" id="tabeldata">
		        <thead>
		            <tr>
		                <th width="30px">No</th>
		                <th>Kandidat</th>
		                <th>Kriteria</th>
		                <th>Nilai</th>
		                <th width="100px">Aksi</th>
		            </tr>
		        </thead>
		        <tbody>
		<?php
		$no=1;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		?>
		            <tr>
		                <td><?php echo $no++ ?></td>
		                <td><?php echo $row['nama_candidate'] ?></td>
		                <td><?php echo $row['nama_kriteria'] ?></td>
		                <td><?php echo $row['nilai_voting'] ?></td>
		                <td class="text-center">
							<a href="voting-ubah.php?ia=<?php echo $row['id_candidate'] ?>&ik=<?php echo $row['id_kriteria'] ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
							<a href="voting-hapus.php?ia=<?php echo $row['id_candidate'] ?>&ik=<?php echo $row['id_kriteria'] ?>" onclick="return confirm('Yakin ingin menghapus data')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
					    </td>
		            </tr>
		<?php
		}
		?>
		        </tbody>
		    </table>
	    </div>
	  </div>
	
	</div>
<?php
include_once 'footer.php';
	}
}
?>
<?php
include_once 'header.php';
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] != base64_encode('Admin')) { ?>
        <div class="container">
            <div class="text-center">Halaman ini hanya untuk hak akses Admin saja!</div>
        </div>
    <?php } else {
include_once 'includes/candidate.inc.php';
$pro = new candidate($db);
$stmt = $pro->readAll();
?>
	<div class="row">
		<div class="col-md-6 text-left">
			<h4>Data Kandidat</h4>
		</div>
		<div class="col-md-6 text-right">
			<button onclick="location.href='candidate-baru.php'" class="btn btn-primary" id="btn-tambah">Tambah Data</button>
		</div>
	</div>
	<br/>

	<table width="100%" class="table table-striped table-bordered" id="tabeldata">
        <thead>
            <tr>
                <th width="30px">No</th>
                <th>Nama Kandidat</th>
                <th>Hasil Kandidat</th>
                <th width="150px" id="bg-hasil">Aksi</th>
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
                <td><?php echo $row['hasil_candidate'] ?></td>
                <td class="text-center">
                    <?php if (isset($row['id_pengguna']) AND $row['id_pengguna'] > 1) { ?>
                    <a href="user-ubah.php?id=<?php echo $row['id_pengguna'] ?>" class="btn btn-info"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
                    <?php } ?>
					<a href="candidate-ubah.php?id=<?php echo $row['id_candidate'] ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
					<a href="candidate-hapus.php?id=<?php echo $row['id_candidate'] ?>" onclick="return confirm('Yakin ingin menghapus data')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
			    </td>
            </tr>
<?php
}
?>
        </tbody>

    </table>
<?php
include_once 'footer.php';
    }
}
?>
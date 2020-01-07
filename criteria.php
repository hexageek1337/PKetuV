<?php
include_once 'header.php';
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] != base64_encode('Admin')) { ?>
        <div class="container">
            <div class="text-center">Halaman ini hanya untuk hak akses Admin saja!</div>
        </div>
    <?php } else {
include_once 'includes/criteria.inc.php';
$pro = new criteria($db);
$stmt = $pro->readAll();
?>
	<div class="row">
		<div class="col-md-6 text-left">
			<h4>Data criteria</h4>
		</div>
		<div class="col-md-6 text-right">
			<button onclick="location.href='criteria-baru.php'" class="btn btn-primary" id="btn-tambah">Tambah Data</button>
		</div>
	</div>
	<br/>

	<table width="100%" class="table table-striped table-bordered" id="tabeldata">
        <thead>
            <tr>
                <th width="30px">No</th>
                <th>Nama Kriteria</th>
                <th>Tipe Kriteria</th>
                <th>Bobot Kriteria</th>
                <th width="100px" id="bg-hasil">Aksi</th>
            </tr>
        </thead>
        <tbody>
<?php
$no=1;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $row['nama_kriteria'] ?></td>
                <td><?php echo $row['tipe_kriteria'] ?></td>
                <td><?php echo $row['bobot_kriteria'] ?></td>
                <td class="text-center">
					<a href="criteria-ubah.php?id=<?php echo $row['id_kriteria'] ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
					<a href="criteria-hapus.php?id=<?php echo $row['id_kriteria'] ?>" onclick="return confirm('Yakin ingin menghapus data')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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
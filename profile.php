<?php
include_once 'header.php';
include_once 'includes/user.inc.php';
include_once 'includes/candidate.inc.php';
$pro = new candidate($db);
$eks = new User($db);

$eks->id = intval($_SESSION['id_pengguna']);
$pro->id = intval($_SESSION['id_pengguna']);

$eks->readOne();

if($_POST){
  if (isset($_POST['rl'])) {
    $eks->rl = addslashes($_POST['rl']);
  } else {
    $eks->rl = 'Peserta';
  }
  $pro->kt = addslashes($_POST['nl']);
  $eks->nl = addslashes($_POST['nl']);
  $eks->un = addslashes($_POST['un']);
  $eks->pw = md5(addslashes($_POST['pw']));

  if ($_SESSION['id_pengguna'] != 1 OR $_SESSION['id_pengguna'] != "1") {
    if($eks->update('fpengguna') AND $pro->update('pengguna')){
      $_SESSION['nama_lengkap'] = addslashes($_POST['nl']);
?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Berhasil!</strong> Anda telah mengubah profile sendiri.
</div>
<?php
    } else {
?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Gagal Ubah profile!</strong> Terjadi kesalahan, coba sekali lagi.
</div>
<?php
    }
  } else {
    if($eks->update('fpengguna')){
      $_SESSION['nama_lengkap'] = addslashes($_POST['nl']);
?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Berhasil!</strong> Anda telah mengubah profile sendiri.
</div>
<?php
    } else {
?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Gagal Ubah profile!</strong> Terjadi kesalahan, coba sekali lagi.
</div>
<?php
    }
  }
}
?>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-8">
            <div class="page-header">
              <h5>Profile Anda</h5>
            </div>
            
                <form method="post">
                  <div class="form-group">
                    <label for="nl">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nl" name="nl" value="<?php echo $eks->nl; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="un">Username</label>
                    <input type="text" class="form-control" id="un" name="un" value="<?php echo $eks->un; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="pw">Password</label>
                    <input type="password" class="form-control" id="pw" name="pw" placeholder="Masukkan password Anda ..." required>
                  </div>
                  <?php if (isset($_SESSION['role'])) {
                    if ($_SESSION['role'] === base64_encode('Admin')) { ?>
                  <div class="form-group">
                    <label for="up">Role</label>
                    <select name="rl" class="form-control" id="up">
                      <option>-- Pilih --</option>
                      <option value="Admin">Admin</option>
                      <option value="Peserta">Peserta</option>
                    </select>
                  </div>
                  <?php }
                  } ?>
                  <button type="submit" class="btn btn-primary">Ubah</button>
                </form>
              
          </div>
          <div class="col-xs-12 col-sm-12 col-md-4">
            <?php include_once 'sidebar.php'; ?>
          </div>
        </div>
        <?php
include_once 'footer.php';
?>
<?php
include "includes/config.php";
session_start();
if(!isset($_SESSION['nama_lengkap'])){
	echo "<script>location.href='index.php'</script>";
}

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === base64_encode('Visitor')) { ?>
        <div class="container">
            <div class="text-center">Halaman ini hanya untuk hak akses Admin dan Peserta saja!</div>
        </div>
    <?php } else {
$config = new Config();
$db = $config->getConnection();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="https://www.phpindonesia.id/uploads/favicon.png">
    <meta name="robots" content="noindex, nofollow" />
    <meta name="author" content="<?=$config->author?>">
    <meta name="description" content="<?=$config->description?>"/>
    <meta name="keywords" content="<?=$config->keywords?>" />
	<link rel="alternate" href="<?=$config->link()?>" hreflang="x-default" />
	<!-- Meta Crawl -->
	<meta name="alexaVerifyID" content="<?=$config->alexa?>"/>
	<meta name="google-site-verification" content="<?=$config->google?>" />
	<!-- Meta Facebook -->
	<meta property="fb:pages" content="<?=$config->fbpagesid?>" />
	<!-- Meta Twitter -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site:id" content="<?=$config->twsiteid?>" />
	<meta name="twitter:domain" content="<?=$_SERVER['HTTP_HOST']?>">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?=$config->title?></title>

    <!-- Bootstrap -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendor/fontawesome/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/custom.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
	<nav class="navbar navbar-default navbar-static-top navbar-custom">
	  <div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="/">pKetuV</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav">
		  	<li><a href="index.php">Home</a></li>
			<?php if (isset($_SESSION['role'])) {
				if ($_SESSION['role'] === base64_encode('Peserta')) { ?>
					<li><a href="report.php">Laporan</a></li>
				<?php } elseif ($_SESSION['role'] === base64_encode('Admin')) { ?>
			<li><a href="value.php">Nilai</a></li>
			<li><a href="criteria.php">Kriteria</a></li>
			<li><a href="candidate.php">Kandidat</a></li>
			<li><a href="ranking.php">Rangking</a></li>
			<li><a href="report.php">Laporan</a></li>
			<?php }
			} ?>
		  </ul>
		  <ul class="nav navbar-nav navbar-right">
			<li><a href="profile.php"><?php echo $_SESSION['nama_lengkap'] ?></a></li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span> <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<?php if (isset($_SESSION['role'])) {
				if ($_SESSION['role'] === base64_encode('Peserta')) { ?>
					<li><a href="profile.php">Profile</a></li>
				<?php } elseif ($_SESSION['role'] === base64_encode('Admin')) { ?>
				<li><a href="profile.php">Profile</a></li>
				<li><a href="user.php">Manager Pengguna</a></li>
				<li><a href="anggota.php">Manager Anggota</a></li>
				<?php }
				} ?>
				<li role="separator" class="divider"></li>
				<li><a href="logout.php">Logout</a></li>
			  </ul>
			</li>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
  
    <div id="container" class="container">
<?php
include_once 'includes/candidate.inc.php';
$pro1 = new candidate($db);
$stmt1 = $pro1->readAll();
$stmt1x = $pro1->readAll();
$stmt1y = $pro1->readAll();
include_once 'includes/criteria.inc.php';
$pro2 = new criteria($db);
$stmt2 = $pro2->readAll();
$stmt2x = $pro2->readAll();
$stmt2y = $pro2->readAll();
$stmt2yx = $pro2->readAll();
include_once 'includes/ranking.inc.php';
$pro = new ranking($db);
$stmt = $pro->readKhusus();
$stmtx = $pro->readKhusus();
$stmty = $pro->readKhusus();
?>
	<br/>
	<div>
	
	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active"><a href="#ranking" aria-controls="ranking" role="tab" data-toggle="tab">Report Perangkingan</a></li>
	    <li role="presentation" style="cursor: pointer;"><a id="cetak" role="tab">Cetak Report 1 (PrintMe)</a></li>
	    <li role="presentation"><a href="report-cetak.php" role="tab">Cetak Report 2 (FPDF)</a></li>
	    <li role="presentation" style="cursor: pointer;"><a onClick ="$('#container').tableExport({type:'png',escape:'false'});" role="tab">Cetak Report 3 (tableExport)</a></li>
	  </ul>
	
	  <!-- Tab panes -->
	  <div class="tab-content">
	    <div role="tabpanel" class="tab-pane active" id="ranking">
	    	<br/>
	    	<h4>Nilai Kriteria Kandidat</h4>
			<table width="100%" class="table table-striped table-bordered">
		        <thead>
		            <tr>
		                <th rowspan="2" style="vertical-align: middle" class="text-center">Kandidat</th>
		                <th colspan="<?php echo $stmt2x->rowCount(); ?>" class="text-center">Kriteria</th>
		            </tr>
		            <tr>
		            <?php
					while ($row2x = $stmt2x->fetch(PDO::FETCH_ASSOC)){
					?>
		                <th><?php echo $row2x['nama_kriteria'] ?><br/>(<?php echo $row2x['tipe_kriteria'] ?>)</th>
		            <?php
					}
					?>
		            </tr>
		        </thead>
		        <tbody>
		<?php
		while ($row1x = $stmt1x->fetch(PDO::FETCH_ASSOC)){
		?>
		            <tr>
		                <th><?php echo $row1x['nama_candidate'] ?></th>
		                <?php
		                $ax= $row1x['id_candidate'];
						$stmtrx = $pro->readR($ax);
						while ($rowrx = $stmtrx->fetch(PDO::FETCH_ASSOC)){
						?>
		                <td>
		                	<?php 
		                	echo $rowrx['nilai_rangking'];
		                	?>
		                </td>
		                <?php
		                }
						?>
		            </tr>
		<?php
		}
		?>
		        </tbody>
		
		    </table>
	    	<h4>Normalisasi R</h4>
			<table width="100%" class="table table-striped table-bordered">
		        <thead>
		            <tr>
		                <th rowspan="2" style="vertical-align: middle" class="text-center">Kandidat</th>
		                <th colspan="<?php echo $stmt2y->rowCount(); ?>" class="text-center">Kriteria</th>
		            </tr>
		            <tr>
		            <?php
					while ($row2y = $stmt2y->fetch(PDO::FETCH_ASSOC)){
					?>
		                <th><?php echo $row2y['nama_kriteria'] ?></th>
		            <?php
					}
					?>
		            </tr>
		        </thead>
		        <tbody>
		<?php
		while ($row1y = $stmt1y->fetch(PDO::FETCH_ASSOC)){
		?>
		            <tr>
		                <th><?php echo $row1y['nama_candidate'] ?></th>
		                <?php
		                $ay= $row1y['id_candidate'];
						$stmtry = $pro->readR($ay);
						while ($rowry = $stmtry->fetch(PDO::FETCH_ASSOC)){
						?>
		                <td>
		                	<?php 
		                	echo $rowry['nilai_normalisasi'];
		                	?>
		                </td>
		                <?php
		                }
						?>
		            </tr>
		<?php
		}
		?><tr>
			<td><b>Bobot</b></td>
		            <?php
					while ($row2yx = $stmt2yx->fetch(PDO::FETCH_ASSOC)){
					?>
		                <td><b><?php echo $row2yx['bobot_kriteria'] ?></b></td>
		            <?php
					}
					?>
		            </tr>
		        </tbody>
		    </table>
		    <h4>Hasil Akhir</h4>
			<table width="100%" id="table-akhir" class="table table-striped table-bordered">
		        <thead>
		            <tr>
		                <th rowspan="2" style="vertical-align: middle" class="text-center">Kandidat</th>
		                <th colspan="<?php echo $stmt2->rowCount(); ?>" class="text-center">Kriteria</th>
		                <th rowspan="2" style="vertical-align: middle" class="text-center" id="bg-hasil">Hasil</th>
		            </tr>
		            <tr>
		            <?php
					while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
					?>
		                <th><?php echo $row2['nama_kriteria'] ?></th>
		            <?php
					}
					?>
		            </tr>
		        </thead>
		        <tbody>
		<?php
		while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
		?>
		            <tr>
		                <th><?php echo $row1['nama_candidate'] ?></th>
		                <?php
		                $a= $row1['id_candidate'];
						$stmtr = $pro->readR($a);
						while ($rowr = $stmtr->fetch(PDO::FETCH_ASSOC)){
						?>
		                <td>
		                	<?php 
		                	echo $rowr['bobot_normalisasi'];
		                	?>
		                </td>
		                <?php
		                }
						?>
						<td>
							<?php 
							echo $row1['hasil_candidate'];
							?>
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
	<?php } } ?>
	<hr class="hr-footer">
    <div class="footer">
        <footer class="text-center">&copy; <?=date("Y")?> PKetuV Solution <i class="fas fa-heart"></i></footer>
    </div>
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <script type="text/javascript" src="js/jquery-printme.js"></script>
    <script type="text/javascript">
    	$('#cetak').click(function() {

    		$("#ranking").printMe({ "path": "css/bootstrap.min.css", "title": "Report HASIL AKHIR" }); 

		});
    </script>
    <script type="text/javascript" src="js/tableExport.js"></script>
	<script type="text/javascript" src="js/jquery.base64.js"></script>
	<script type="text/javascript" src="js/html2canvas.js"></script>
	<script type="text/javascript" src="js/jspdf/libs/sprintf.js"></script>
	<script type="text/javascript" src="js/jspdf/jspdf.js"></script>
	<script type="text/javascript" src="js/jspdf/libs/base64.js"></script>
  </body>
</html>
<?php
include "includes/config.php";
session_start();
if(!isset($_SESSION['nama_lengkap'])){
	echo "<script>location.href='login.php'</script>";
}

$config = new Config();
$db = $config->getConnection();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>pKetuV</title>

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
  <body style="background: #ffffff url(images/back1.jpg) left bottom fixed;">
  
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
			<?php } elseif ($_SESSION['role'] === base64_encode('Voter')) { ?>
			<li><a href="voting.php">Voting</a></li>
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
					<li role="separator" class="divider"></li>
				<?php } elseif ($_SESSION['role'] === base64_encode('Admin')) { ?>
				<li><a href="profile.php">Profile</a></li>
				<li><a href="user.php">Manager Pengguna</a></li>
				<li><a href="anggota.php">Manager Anggota</a></li>
				<li role="separator" class="divider"></li>
				<?php } elseif ($_SESSION['role'] === base64_encode('Voter')) { ?>
				<li><a href="profile.php">Profile</a></li>
				<li role="separator" class="divider"></li>
				<?php }
				} ?>
				<li><a href="logout.php">Logout</a></li>
			  </ul>
			</li>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
  
    <div class="container">
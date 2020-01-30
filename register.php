<?php
include_once 'includes/config.php';

$config = new Config();
$db = $config->getConnection();
	
if($_POST AND $_POST['ka']){
	include_once 'includes/user.inc.php';
    $eks = new User($db);

    $eks->ka = addslashes($_POST['ka']);

    $dataevent = $eks->readevent();
    $datavoter = $eks->jumlahVoterTerdaftar();

    if ($datavoter['jvterdaftar'] < $dataevent['limit_event']) {
	    $eks->nl = addslashes($_POST['nl']);
	    $eks->un = addslashes($_POST['un']);
	    $eks->pw = addslashes($_POST['pw']);
	    $eks->rl = 'Voter';
		
		if($eks->insert()){
			echo "<script>alert('Register berhasil!')</script>";
			echo "<script>location.href='index.php'</script>";
		}

		else{
			echo "<script>alert('Register gagal!')</script>";
		}
	} else {
		echo "<script>alert('Register gagal, Voter sudah mencapai batas maksimum!')</script>";
	}
}
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
		  <a class="navbar-brand" href="<?=$config->link($config->folder)?>/login.php"><?=$config->title?></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav navbar-right">
			<li><a href="javascript:void(0)" id="date-menu"><?=date("Y")?></a></li>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
  
    <div class="container">
		<div class="login login-2">
			<header class="login--header login-2--header text-center">
				<span class="icon icon-medium fa fa-user"></span>
				<h3>Register</h3>
				<span class="arrow-down login--header__arrow"></span>
			</header>
			<form class="login--form" method="post">
				<div class="login--form__input-area input-group">
					<span class="input-group-addon"><span class="fa fa-user"></span></span>
					<input name="ka" type="text" class="form-control" placeholder="Masukkan kode event anda ..." />
				</div>
				<div class="login--form__input-area input-group">
					<span class="input-group-addon"><span class="fa fa-at"></span></span>
					<input name="nl" type="text" class="form-control" placeholder="Masukkan nama lengkap anda ..." />
				</div>
				<div class="login--form__input-area input-group">
					<span class="input-group-addon"><span class="fa fa-user"></span></span>
					<input name="un" type="text" class="form-control" placeholder="Masukkan username anda ..." />
				</div>
				<div class="login--form__input-area input-group">
					<span class="input-group-addon"><span class="fa fa-lock"></span></span>
					<input name="pw" type="password" class="form-control" placeholder="Masukkan password Anda ..." />
				</div>
				<button type="submit" class="login--form__button btn btn-default">Daftar</button>
			</form>
			<footer class="login--footer text-center">
				<p class="login--footer__text">Sudah mempunyai akun? <strong><a href="/login.php">Login disini!</a></strong></p>
			</footer>
		</div>
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>
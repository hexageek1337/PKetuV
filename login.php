<?php
include_once 'includes/config.php';

$config = new Config();
$db = $config->getConnection();
	
if($_POST){
	
	include_once 'includes/login.inc.php';
	$login = new Login($db);

	$login->userid = addslashes($_POST['username']);
	$login->passid = md5(addslashes($_POST['password']));
	
	if($login->login()){
		echo "<script>location.href='index.php'</script>";
	}

	else{
		echo "<script>alert('Username/Password Salah')</script>";
	}
}
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
		  <a class="navbar-brand" href="/login.php">pKetuV</a>
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
		<div class="login login-1">
			<header class="login--header login-1--header text-center">
				<span class="icon icon-medium fa fa-lock"></span>
				<h3>Login</h3>
				<span class="arrow-down login--header__arrow"></span>
			</header>
			<form class="login--form" method="post" autocomplete="off">
				<div class="login--form__input-area input-group">
					<span class="input-group-addon"><span class="fa fa-user"></span></span>
					<input name="username" type="text" class="form-control" placeholder="Masukkan username anda ..." />
				</div>
				<div class="login--form__input-area input-group">
					<span class="input-group-addon"><span class="fa fa-lock"></span></span>
					<input name="password" type="password" class="form-control" placeholder="Masukkan password anda ..." />
				</div>
				<label class="login--form__input-area checkbox-label">
					<input type="checkbox" />
					<span class="checkgraph fa fa-check"></span>
					Remember me?
				</label>
				<button type="submit" class="login--form__button btn btn-default" value="Masuk">Masuk</button>
			</form>
			<footer class="login--footer text-center">
				<p class="login--footer__text">Or you can login with one of the following</p>
				<div class="login--footer__social-buttons">
					<a href="#"><span class="icon icon-small icon-fb fa fa-facebook"></span></a>
					<a href="#"><span class="icon icon-small icon-tw fa fa-twitter"></span></a>
					<a href="#"><span class="icon icon-small icon-gp fa fa-google-plus"></span></a>
				</div>
				<p class="login--footer__text">Belum mempunyai akun? <strong><a href="/register.php">Daftar disini!</a></strong></p>
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
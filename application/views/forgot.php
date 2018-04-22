<?php
require("header.php");
if(!isset($_SESSION)){
session_start();
}
if(isset($_SESSION['logged_in']) == TRUE) {
header("Location: index.php" );
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="author" content="UPCS">
	<title>Forgot Password</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/my-login.css">
	<script src="<?php echo base_url();?>js/jquery-3.3.1.js"</script>
<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
<script>var __adobewebfontsappname__="dreamweaver"</script>
<script src="http://use.edgefonts.net/lato:n4,i4:default.js" type="text/javascript"></script>
	<style type="text/css">
	body {
	background-image: url(<?php echo base_url();?>img/BG.jpg);
	margin-left: 0px;
	margin-right: 0px;
}
    </style>x
</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center align-items-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="<?php echo base_url();?>img/logo.jpg">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Forgot Password</h4>
							<form method="POST">
							 
								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
									<div class="form-text text-muted">
										By clicking "Reset Password" we will send a password reset link
									</div>
								</div>

								<div class="form-group no-margin">
									<button type="submit" class="btn btn-danger btn-block">
										Reset Password
									</button>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; University of the Philippines Manila 2018
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="author" content="UPCS">
	<title>UP Organizations</title>
<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
</head>
<body class="my-login-page">
<section class="h-100">
	<div class="headerbar">
					<h1 class="display-1" style="font-size: 60px;">UP Organizations</h1>
			<div class="container h-100">
			<div class="row">
			<div class="col-sm-7 text">
			<div class="row justify-content-md-center h-100">
				<div class="card fat">	
					<div class="card-body">
						 <h2>Getting Started</h2>
				<hr>
                <div class="description">
                    <p>
	                   	Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Vestibulum nec vestibulum turpis. Sed justo lacus, pulvinar a dolor in, malesuada tempor purus. Proin id lectus eu arcu hendrerit tempor vitae et ligula. Phasellus facilisis tellus sed sagittis cursus. Proin nec scelerisque ipsum, et sollicitudin ante. Etiam tellus risus, sollicitudin ac tincidunt vitae, semper ac nisi.
                   	</p>
                </div>
					</div>
				</div>
				</div>
			</div>
			<div class="col-sm-5">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="container">
						<div class="card fat">	
						<div class="card-body">
							<div class="panel-heading">
						<hr>
					</div>	
							<form method="POST" action ="checkLogin" role="form">
							 	<h4 class="card-title">Student/Organization Login</h4>
								<div class="form-group">
									<label for="email">Username / Email Address</label>

									<input id="email" type="text" maxlength= "50" class="form-control" name="credentials[username]" value="" required autofocus>
								</div>

								<div class="form-group">
									<label for="password">Password
									</label>
									<input id="password" type="password" minlength="7" maxlength = "32" class="form-control" name="credentials[password]" required data-eye>
									<a href="<?php echo base_url();?>forgot">Forgot Password?</a>
								</div>
								<div class="form-group no-margin">
									<button type="submit" class="btn btn-danger btn-block">
										Login
									</button>
								</div>
								<div class="margin-top20 text-center">
									Don't have an account? Sign up as <a href="<?php echo base_url();?>regstud">Student</a> or <a href="<?php echo base_url();?>regorg">Organization</a> 
								</div>
							</form>
						</div>
					</div>
					</div>
				</div>
			</div>
			</div>
				</div>
		</div>
	</section>
</body>
</html>
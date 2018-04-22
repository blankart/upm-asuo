<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="author" content="UPCS">
	<title>Register</title>
<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
</head>
<body class="my-login-page">
	<div class="container reg-page-center">
				<div class="card-wrapper-reg">
					<div class="brand">
						<img src="<?php echo base_url();?>img/logo.jpg">
					</div>
					<div class="card fat">
						<div class="panel-heading">
						<hr>
					</div>	
						<div class="card-body">
							<form method="POST" role="form" id="stud-reg">
							 <h4 class="card-title">Register as Student</h4>
								<fieldset>
								<div class="form-group">
									<label for="email">UP Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" required>
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control" name="password" required>
								</div>
									<div class="form-group">
									<label for="password">Confirm Password</label>
									<input id="password" type="password" class="form-control" name="password" required>
								</div>

								<div class="form-group no-margin">
									<button type="submit" name="next" class="btn btn-danger btn-block next action-button">
										Register
									</button>
								</div>
								<div class="margin-top20 text-center">
									Already have an account? <a href="<?php echo base_url();?>login">Login</a>
								</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
		</div>
</body>
</html>
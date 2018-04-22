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
						<div class="row">
							<div class="col-sm-6">
								<a href="#" class="active" id="stud-reg-link">Student</a>
							</div>
							<div class="col-sm-6">
								<a href="#" id="org-reg-link">Organizations</a>
							</div>
						</div>
						<hr>
					</div>	
						<div class="card-body">
							<form method="POST" role="form" id="stud-reg" style="display: block;">
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
										Next
									</button>
								</div>
								<div class="margin-top20 text-center">
									Already have an account? <a href="<?php echo base_url();?>login">Login</a>
								</div>
								</fieldset>
							</form>
							<form method="POST" role="form" id="org-reg" style="display: none;">
							 <h4 class="card-title">Register as Organization</h4>
								<div class="form-group">
									<label for="name">Name</label>
									<input id="name" type="text" class="form-control" name="name" required autofocus>
								</div>

								<div class="form-group">
									<label for="email">Org E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" required>
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control" name="password" required>
								</div>

								<div class="form-group no-margin">
									<button type="submit" class="btn btn-danger btn-block">
										Register
									</button>
								</div>
								<div class="margin-top20 text-center">
									Already have an account? <a href="<?php echo base_url();?>home">Login</a>
								</div>
							</form>
						</div>
					</div>
				</div>
		</div>
</body>
</html>
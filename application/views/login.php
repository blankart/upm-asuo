<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="author" content="UPCS">
	<title>UP Organizations</title>
<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
</head>
<script>
	function onReady(callback) {
  var intervalId = window.setInterval(function() {
    if (document.getElementsByClassName('h-100')[0] !== undefined) {
      window.clearInterval(intervalId);
      callback.call(this);
    }
  }, 1000);
}

onReady(function() {
  $('.headerbar').show()
  $('.loading-screen').addClass('animated fadeOut');
});
	</script>
	
<body class="my-login-page">
	<div class='loading-screen'>
		<div class="container">
	<div class="row">
		<div id="loader">
    		<div class="dot"></div>
			<div class="dot"></div>
			<div class="dot"></div>
			<div class="dot"></div>
			<div class="dot"></div>
			<div class="dot"></div>
			<div class="dot"></div>
			<div class="dot"></div>
		</div>
	</div>
</div>
	</div>
<section class="h-100">
	<div class="headerbar">
		<h1 class="display-1" style="font-size: 40px;">Online Accreditation System for University-wide Organizations</h1>
			<div class="container h-100 animated fadeIn">
			<div class="row">
			<div class="col-sm-7 text">
			<div class="row justify-content-md-center h-100">
				<div class="card fat" style='border: none; padding: 0 !important;'>
					<div class='card-header' style='background-color:rgb(123,17,19); border: none;'>
						<h2 style='color: white;'>Announcement</h2>
					</div>	
					<div class="card-body" style='overflow-y: scroll; overflow-x: hidden;width: 650px;'>
						<?php if ($notice){ echo '<h4>'.$notice['title'].'</h4>';} else{echo 'No login message found';}?>
                <div class="description" style='font-size: 16px;'>
                	<div style='font-style: italic; margin-bottom: 10px;'><?php if ($notice) echo date("g:i:s a |  F j, Y", strtotime($notice['date_posted'])); else echo 'No login message found'; ?></div>
                    <p style='font-size: 16px;'>
	                   	<?php if ($notice) echo nl2br($notice['content']); else echo 'No login message found'; ?>
                   	</p>
                </div>
                <div style='font-style: italic; margin-top: 10px; font-size: 16px;'><?php if ($notice) echo '<strong>'.$notice['admin_name'].'</strong>'; else echo 'No login message found'; ?></div>
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
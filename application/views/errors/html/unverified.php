
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta content="UPCS" name="author">
    <title>UP Organizations</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"> 
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"> 
</head>
<body>
	<div class="wrapper animated bounceIn" style="margin-top: 80px;">
					
		<div class="container-fluid" id="body-container-fluid">
			<div class="container">
				<!---- for body container ---->								
				<div class="jumbotron">
				<h3 class="display-1"><center><i class="fa fa-frown-o fa-3x"></i></h3>
				<h3 class="display-3"><center>Unverified Account</h3>
				<p class="lower-case"><center>To verify your account, please follow the link sent to <?php echo $org_email; ?>.</p>
				<a  href="<?php echo base_url().'logout'; ?>"><button type="button" class="btn btn-danger">Go Back</button></a>
				</div>	
 			</div>
		</div>
	</div>
	<script src="bootstrap/js/bootstrap.min.js"></script> 
</body>
</html>
	

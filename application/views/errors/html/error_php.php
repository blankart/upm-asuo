<?php
$CI =& get_instance();
if( ! isset($CI))
{
    $CI = new CI_Controller();
}
$CI->load->helper('url');
?>
<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet" id="bootstrap-css">
<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
<link href="<?php echo base_url(); ?>css/404.css" rel="stylesheet">
<style type="text/css">
	body {
	background-image: url(<?php echo base_url(); ?>img/BG.jpg);
	background-attachment: fixed;
	margin-left: 0px;
	margin-right: 0px;
}
    </style>
<!------ Include the above in your HEAD tag ---------->

<!---************* arrangement by john niro yumang b4.0 alpha project graduation ******************* -->

<!DOCTYPE html>
<html lang="en">
	
	<title>Page Not Found</title>

		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<!------------start head  scripts and link src------------>
	<head>
	
		<script src="<?php echo base_url(); ?>js/jq.js"></script>
		<!---- for moving objects make this first always after boootstrap.css ----->
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
		<!-------    font awesome online plug --------------->
 		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	</head>
	<!-------------end head scripts and link src ------------->

	
		 

 
 
	
	<!------------start content ------------>
	<body>
		<div class="wrapper animated bounceIn" style="margin-top: 40px;">
			<div class="container-fluid" id="top-container-fluid-nav">
				<div class="container">	
					<!---- for nav container ----->	
				</div>
			</div> 
			
					
			<div class="container-fluid" id="body-container-fluid">
				<div class="container">
					<!---- for body container ---->
						
						
						<div class="jumbotron">
						<h1 class="display-1">4<i class="fa  fa-spin fa-cog fa-3x"></i> 4</h1>
						<h1 class="display-3">ERROR</h1>
						<p class="lower-case">PAGE NOT FOUND</p>
						<p class="lower-case">Woops. Looks like this page doesn't exist.</p>

						</div>
						
 				</div>
			</div>
  			
				
			
		</div>
		
 	</body>


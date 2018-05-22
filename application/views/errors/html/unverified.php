
<script>

	function resendVerificationCode(){

      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>resendVerificationMail",
        cache: false,
        async: false,
        dataType: "JSON",
        data: {source: 'student' },
        success : function (data){
        	
        	if(data){
	           swal({title: "Success!", text: "A new verification code has been to your email!", type: "success"},
	           		function(){ 
	            	location.reload();
	            	 }
	            	);
	       	}
	       	else{
	       		swal("Failed!", "You can't resend the verification now. Please try again later.", "error");
	       	}
       		},
                  error: function(XMLHttpRequest, textStatus, errorThrown) { 
                     //alert("Status: " + textStatus + " | Error: " + errorThrown); 
                     swal("Failed!", "The system seems to be crashing HAHAHA", "error");
                  }   
            });		
	}


</script>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta content="UPCS" name="author">
    <title>UP Organizations</title>
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
				<p class="lower-case"><center>To verify your account, please follow the link sent to <b><?php echo $org_email; ?></b>.</p>
				<p class="lower-case"> or </p>
				<p><button type="button" onclick='resendVerificationCode()' class="btn btn-success">Resend Verification Code</button></p>
				<a  href="<?php echo base_url().'logout'; ?>"><button type="button" class="btn btn-danger">Go Back</button></a>
				</div>	
 			</div>
		</div>
	</div>
</body>
</html>
	

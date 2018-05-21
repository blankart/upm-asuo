<script type="text/javascript">
	
     $(document).ready(function(){


        $('#forgotPasswordForm').on("submit",function(e){
       			var email = document.getElementById('email').value;
       			
               e.preventDefault();
               $.ajax({
                  type: "post",
                  url :"<?php echo base_url(); ?>/resetPassword", 
                  async: false,
                  cache: false,
                  contentType: false,
                  processData: false,
                  data: new FormData(this),
                  success : function (data){
                      swal({title: "Success!", text: "A new password has been sent to " +email+ ".", type: "success"},
                        function(){
                        	document.getElementById('email').value = '';
                            location.reload();
                        }
                     );
                  },
                  error: function(XMLHttpRequest, textStatus, errorThrown) { 
                     //alert("Status: " + textStatus + " | Error: " + errorThrown); 
                     swal("Error!", "An error has occurred!", "error");
                  }   
            });
          });
        });

</script>
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
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Forgot Password?</h4>
							<form method="POST" id ='forgotPasswordForm'>
								<div class="form-group">
									<label for="email">Please enter your email address</label>
									<input id="email" type="email" maxlength="50" class="form-control" id="email" name="email" value="" required autofocus placeholder="sample@up.edu.ph">
									<div class="form-text text-muted">
										<small>By clicking "Reset Password" we will send a password reset link to the email provided.</small>
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
				</div>
			</div>
		</div>
	</section>
</body>
</html>
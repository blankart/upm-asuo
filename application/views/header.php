<?php
	if (isset($this->session->userdata['logged_in'])) {
		if($this->session->userdata['account_type'] == 'student'){
			$first_name = ($this->session->userdata['first_name']);
			$username = ($this->session->userdata['username']);
			$email = ($this->session->userdata['email']);
		}
		if($this->session->userdata['account_type'] == 'admin'){
			$username = ($this->session->userdata['username']);
            $admin_name = ($this->session->userdata['admin_name']);
		}
		if($this->session->userdata['account_type'] == 'org'){
			$nsacronym = ($this->session->userdata['nsacronym']);
			$acronym = ($this->session->userdata['acronym']);
			$email = ($this->session->userdata['email']);
		}
	}
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>UP Organizations</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/my-login.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/material-search.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sweetalert.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/stylesheet.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/animate.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/org.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/stud.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <style type="text/css">
            body {
            	background-image: url(<?php echo base_url();?>img/BG.jpg);
            	background-attachment: fixed;
            	margin-left: 0px;
            	margin-right: 0px;
            }
        </style>
    </head>

    <body>
    	

        <nav class="navbar fixed-top navbar-expand-xl navbar-dark" id='nav-bar'>
        	<img src="<?php echo base_url();?>img/UP Logo.png" width="35px" class="img-fluid">
            <a class="navbar-brand" href="<?php echo base_url();?>login">
            	<?php if (!isset($this->session->userdata['logged_in'])) 
            	echo "University of the Philippines Manila";
            	else echo "<strong>ASUO</strong>";
             	?>
        </a>

            </button>
            <div class="collapse navbar-collapse justify-content-end" id="nav-content">
                <ul class="navbar-nav">
                    <?php
		 if(isset($_SESSION['logged_in']) == TRUE){ 
		 	if($this->session->userdata['account_type'] == 'student'){
				echo "<div id='loggedInAs'>
				logged in as: <a>".$email."</a>
				</div>
				<div id='searchButton'>
				<a href='#search'><i class='fas fa-search'></i>Search for Organizations</a>
				</div>
				<li class='nav-item'>
				<a class='nav-link' href='".base_url()."student/".$username."'>".$first_name."</a>
		  		</li>
		  		<li class='nav-item'>
		  		<a class='nav-link' href='#' data-toggle='modal' data-target='#changestudentpassword'>Change Password</a>
		  		</li>
		  		<li class='nav-item'>
		  		<a class='nav-link' href='".base_url()."logout'>Log Out</a>
		  		</li>";
		  	}
		  	if($this->session->userdata['account_type'] == 'org'){
				echo "<div id='loggedInAs'>
				logged in as: <a>".$email."</a>
				</div>
				<li class='nav-item'>
				<a class='nav-link' href='".base_url()."org/".$nsacronym."'>".$acronym."</a>
		  		</li>
		  		<li class='nav-item'>
		  		<a class='nav-link' href='#' data-toggle='modal' data-target='#changeorgpassword'>Change Password</a>
		  		</li>
		  		<li class='nav-item'>
		  		<a class='nav-link' href='".base_url()."logout'>Log Out</a>
		  		</li>";
		  	}
		  	if($this->session->userdata['account_type'] == 'admin'){
				echo "<li class='nav-item'>
                </li>
				<a class='nav-link' href='".base_url()."admin/".$username."'>".$admin_name."</a>
		  		</li>
		  		<li class='nav-item'>
		  		<a class='nav-link' href='#' data-toggle='modal' data-target='#changeadminpassword'>Change Password</a>
		  		</li>
		  		<li class='nav-item'>
		  		<a class='nav-link' href='".base_url()."logout'>Log Out</a>
		  		</li>";
		  	}
		 }
		 else{
			echo "<li class='nav-item'>
	  		<a class='nav-link' href='".base_url()."login'>Login</a>
	  		</li>";
		 }
		 ?>
                </ul>
        </nav>

         <script src="<?php echo base_url();?>js/jquery.min.js"></script>
        <script src="<?php echo base_url();?>js/my-login.js"></script>
        <script src="<?php echo base_url();?>js/jquery-3.3.1.js"></script>
        <script src="<?php echo base_url();?>js/multi-step-modal.js"></script>
        <script src="<?php echo base_url();?>js/real-time-search.js"></script>
        <script src="<?php echo base_url();?>js/sweetalert.js"></script>
        <script src="<?php echo base_url();?>js/sweetalert.min.js"></script>
	        <script src="<?php echo base_url();?>js/registerOrg.js"></script>
	        <script src="<?php echo base_url();?>js/popper.min.js"></script>
	        <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
	        <script>
    		$(window).scroll(function(){
    			if ($(this).scrollTop() > 50){
    				$('#nav-bar').addClass('opaque');
    			}
    			else{
    				$('#nav-bar').removeClass('opaque');
    			}
    		});
    	</script>
    </body>

    </html>
    
<?php
	if (isset($this->session->userdata['logged_in'])) {
		if($this->session->userdata['account_type'] == 'student'){
			$first_name = ($this->session->userdata['first_name']);
			$username = ($this->session->userdata['username']);
			$email = ($this->session->userdata['email']);
			$profile_pic = ($this->session->userdata['profilepic']);
		}
		if($this->session->userdata['account_type'] == 'admin'){
			$username = ($this->session->userdata['username']);
            $admin_name = ($this->session->userdata['admin_name']);
		}
		if($this->session->userdata['account_type'] == 'org'){
			$nsacronym = ($this->session->userdata['nsacronym']);
			$acronym = ($this->session->userdata['acronym']);
			$email = ($this->session->userdata['email']);
			$org_logo = ($this->session->userdata['org_logo']);
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
            	background-repeat: no-repeat;
            	background-size: cover;
            	margin-left: 0px;
            	margin-right: 0px;
            }
            .cookiealert {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    margin: 0 !important;
    z-index: 999;
    opacity: 0;
    border-radius: 0;
    background: #212327 url("<?php echo base_url();?>img/cubes.png");
    transform: translateY(100%);
    transition: all 500ms ease-out;
    color: #ecf0f1;
}

.cookiealert.show {
    opacity: 1;
    transform: translateY(0%);
    transition-delay: 1000ms;
}

.cookiealert a {
    text-decoration: underline
}

.cookiealert .acceptcookies {
    margin-left: 10px;
    vertical-align: baseline;
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
				<a class='nav-link' href='".base_url()."student/".$username."'><img style='margin-right: 2px; border-radius: 50%;' width='25' src='".base_url().'assets/student/profile_pic/'.$profile_pic.'?'.rand(1, 1000)."'> ".$first_name."</a>
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
				<a class='nav-link' href='".base_url()."org/".$nsacronym."'><img style='margin-right: 2px; border-radius: 50%;' width='25' src='".base_url().'assets/org/logo/'.$org_logo.'?'.rand(1, 100)."'> ".$acronym."</a>
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
	        	$(document).on({
    			ajaxStart: function(){
        $('.loadingscreen').show();
    },
    ajaxStop: function(){
    		//setTimeout(function(){
    			$('.loadingscreen').hide(); 
    		//}, 500);
    		
    }
  });
    		$(window).scroll(function(){
    			if ($(this).scrollTop() > 50){
    				$('#nav-bar').addClass('opaque');
    			}
    			else{
    				$('#nav-bar').removeClass('opaque');
    			}
    		});
    		(function () {
    "use strict";

    var cookieAlert = document.querySelector(".cookiealert");
    var acceptCookies = document.querySelector(".acceptcookies");
    cookieAlert.offsetHeight;

    if (!getCookie("acceptCookies")) {
        cookieAlert.classList.add("show");
    }

    acceptCookies.addEventListener("click", function () {
        setCookie("acceptCookies", true, 60);
        cookieAlert.classList.remove("show");
    });
})();

// Cookie functions stolen from w3schools
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

    	</script>
    	<div class="alert alert-dismissible text-center cookiealert" role="alert">
    <div class="cookiealert-container">
        <b>Do you like cookies?</b> &#x1F36A; We use cookies to ensure you get the best experience on our website.

        <button type="button" class="btn btn-primary btn-sm acceptcookies" aria-label="Close">
            I agree
        </button>
    </div>
</div>
    </body>


    </html>
    
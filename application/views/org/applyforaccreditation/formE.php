<?php 
	$dbhandle = new mysqli('localhost','root','','asuo');
	echo $dbhandle->connect_error;

	$query = "SELECT * FROM studentprofile";
	$res = $dbhandle->query($query);

	$row=$res->fetch_assoc();

	//other db
	$query = "SELECT * FROM studentaccount";
	$res2 = $dbhandle->query($query);

	$row2=$res2->fetch_assoc();
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Form E: Members' Profile</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/phases.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sidenav.css"> 
		<script type="text/javascript" src="<?php echo base_url();?>js/script.js"></script>
	</head>

	<body>
   		<div class="animated fadeIn" style="background-color: rgb(255,255,255); margin-top: 110px; margin-left: 22%; margin-right: 1%; padding-top: 10px; box-shadow: 0 0 40px rgba(0,0,0,.50); padding-bottom: 50px; border-radius: 10px;">
            <div class="col-4">
            <!-- insert sidenav -->
                <div class="sidenav">
                    <li><a href="<?php echo base_url(); ?>org/applyforaccreditation">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formA">Accreditation Application</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formB">Consent of Adviser</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formC">Organization Profile</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formD">Officers' Profile</a></li>
                    <li class="active"><a href="<?php echo base_url(); ?>org/formE">Members' Profile</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formF">Projects</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formG">Financial Report</a></li>
                </div>
            </div>
            <!-- Page Content -->
			<div class="main">
				<h1>Form E: Members' Profile</h1>
				<!-- add pages -->
				<form id="multiphase" onsubmit="return false">
					<img src="<?php echo base_url();?>img/logo.jpg" alt="<?php echo $row['first_name']. ' ' . $row['middle_name']. ' ' . $row['last_name']; ?>" style="float:left;">&nbsp;&nbsp;
					Name:&nbsp;&nbsp;<input type="text" id="name" name="name" id="name" value="<?php echo $row['first_name']. ' ' . $row['middle_name']. ' ' . $row['last_name']; ?>" disabled><br>&nbsp;&nbsp;
					Year:&nbsp;&nbsp;<input type="text" name="yearLvl" id="yearLvl" value="<?php echo $row['year_level']; ?>" disabled>&nbsp;&nbsp;
					Course:&nbsp;&nbsp;<input type="text" name="Course" id="Course" value="<?php echo $row['course']; ?>" disabled><br>&nbsp;&nbsp;
					Address:&nbsp;&nbsp;<input type="text" name="add" id="add" disabled><br>&nbsp;&nbsp;
					Phone:&nbsp;&nbsp;<input type="text" name="phone" id="phone" disabled>&nbsp;&nbsp;
					Email:&nbsp;&nbsp;<input type="text" name="mail" id="mail" value="<?php echo $row2['up_mail'];?>" disabled><br><br>
				
					<button class="button">Next</button>
				</form>
			</div>
		</div>
	</body>
</html>
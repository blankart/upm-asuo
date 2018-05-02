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
   <div class="animated fadeIn" style="background-color: rgb(255,255,255); margin-top: 60px; padding-top: 50px; box-shadow: 0 0 40px rgba(0,0,0,.50); padding-bottom: 500px;">
        <!-- div class="container" -->
            <!-- div class="row" -->
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
				Name: <input type="text" name="name" id="name" value="<?php echo $row['first_name']. ' ' . $row['middle_name']. ' ' . $row['last_name']; ?>" disabled><br>
				Year/ Course: <input type="text" name="course" id="course" value="<?php echo $row['year_level']. ' ' .$row['course']; ?>" disabled><br>
				Address: <input type="text" name="add" id="add" disabled><br>
				Phone: <input type="text" name="phone" id="phone" disabled><br>
				Email: <input type="text" name="mail" id="mail" value="<?php echo $row2['up_mail'];?>" disabled><br><br>
				Photo: <br><br>

				<button class="button">Next</button><br><br><br>
			</form>
		</div>
	</div>
	</body>
</html>
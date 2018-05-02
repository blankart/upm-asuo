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
		<title>Form D: Officers' Profile</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/phases.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sidenav.css">
	</head>

	<body>
		<!-- Sidebar -->
		<div class="sidenav">
            <li><a href="applyforaccreditation.php">Home</a></li>
          	<li><a href="formA.php">Accreditation Application</a></li>
           	<li><a href="formB.php">Consent of Adviser</a></li>
           	<li><a href="formC.php">Organization Profile</a></li>
           	<li class="active"><a href="formD.php">Officers' Profile</a></li>
            <li><a href="formE.php">Members' Profile</a></li>
            <li><a href="formF.php">Projects</a></li>
            <li><a href="formG.php">Financial Report</a></li>
		</div>

		<!-- Page Content -->
		<div class="main">
			<h1>Form D: Officers' Profile</h1><br>
			<!-- add pages -->
			<form id="multiphase" onsubmit="return false">
				<!-- insert photo -->
				Name: <input type="text" name="name" id="name" value="<?php echo $row['first_name']. ' ' . $row['middle_name']. ' ' . $row['last_name']; ?>" disabled><br>
				Position: <input type="text" name="pos" id="pos" disabled><br>
				Year/ Course: <input type="text" name="course" id="course" value="<?php echo $row['year_level']. ' ' .$row['course']; ?>" disabled><br>
				Address: <input type="text" name="add" id="add" disabled><br>
				Phone: <input type="text" name="phone" id="phone" disabled><br>
				Email: <input type="text" name="mail" id="mail" value="<?php echo $row2['up_mail'];?>" disabled><br>
				Other Contact Details: <input type="text" name="more" id="more" disabled><br><br>
				
				<button class="button">Next</button>
			</form><br><br>
			
			<!-- button class="button">Submit</button-->

		</div>
	</body>
</html>
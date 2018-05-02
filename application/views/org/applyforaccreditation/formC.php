<?php 
	$dbhandle = new mysqli('localhost','root','','asuo');
	echo $dbhandle->connect_error;

	$query = "SELECT * FROM organizationprofile";
	$res = $dbhandle->query($query);

	$row=$res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Form C: Organization Profile</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/phases.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sidenav.css">
		<script src="<?php echo base_url();?>js/script.js"></script>
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
                        <li class="active"><a href="<?php echo base_url(); ?>org/formC">Organization Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formD">Officers' Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formE">Members' Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formF">Projects</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formG">Financial Report</a></li>
                    </div>
                </div>
                    <!-- Page Content -->
		<div class="main">
			<h1>Form C: Organization Profile</h1>
			<!-- progress bar -->
			<progress id="progressBar" class="progressBar" value="0" max="100"></progress><br><br>

			<!-- form -->
			<form id="multiphase2" onsubmit="return false">
				<div id="cphase1">
					Name of Organization: <input type="text" name="orgName" value="<?php echo $row['org_name']; ?>" disabled><br>
					Acronym: <input type="text" name="acronym" value="<?php echo $row['acronym']; ?>" disabled><br>
					Mailing Address: <input type="text" name="address"><br>
					Email Address: <input type="text" name="email" disabled><br>
					Website: <input type="text" name="website" value="<?php echo $row['org_website']; ?>" disabled><br> 
					Date Established: <input type="text" name="established" value="<?php echo $row['date_established']; ?>" disabled><br><br>
					<button class="button" onclick="processcPhase1()">Continue</button>
				</div>

				<div id="cphase2">
					Total Number of Members: <input type="text" name="numMembers" disabled><br><br>
					<!--
					<table>
						<tr>
							Membership Distribution
						</tr>
						<tr>
							<td></td>
							<td>FIRST YEAR</td>
							<td>SECOND YEAR</td>
							<td>THIRD YEAR</td>
							<td>FOURTH YEAR</td>
							<td>MASTERAL STUDENTS</td>
							<td>DOCTORAL STUDENTS</td>
							<td>TOTAL</td>
						</tr>
						<tr>
							<td>MALE</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</table>
					-->
					
					<button class="button" onclick="processcPhase2()">Continue</button>
					<button class="button" onclick="backc1()">Back</button>
				</div>
			
				<div id="cphase3">
					Is your organization incorporated with the Securities and Exchange Commission(SEC)?<br>
					<input type="radio" name="no" value="no">No<br>
					<input type="radio" name="yes" value="yes">Yes, when?
					<input type="text" name="when"><br><br>

					<button class="button" onclick="processcPhase3()">Continue</button>
					<button class="button" onclick="backc2()">Back</button>
				</div>

				<!-- review details before submitting-->
				<div id="show_all_data">
					First Name: <span id="display_fname"></span><br>

					<button class="button">Submit</button>
					<button class="button" onclick="submitForm()">Submit Data</button>
					<button class="button" onclick="backc3()">Back</button>
				</div>
			</form>
		</div>
	</div>
	</body>
</html>
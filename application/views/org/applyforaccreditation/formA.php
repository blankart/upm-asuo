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
		<title>Form A: Accreditation Application</title>
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
                        <li class="active"><a href="<?php echo base_url(); ?>org/formA">Accreditation Application</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formB">Consent of Adviser</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formC">Organization Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formD">Officers' Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formE">Members' Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formF">Projects</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formG">Financial Report</a></li>
                    </div>
                </div>
                    <!-- Page Content -->
					<div class="main">
					<h1>Form A: Accreditation Application</h1>
					<!-- progress bar -->
					<progress id="progressBar" class="progressBar" value="0" max="100"></progress><br><br>

					<!-- form -->
					<form id="multiphase" onsubmit="return false">
						<div id="phase1">
							<table>
								<tr>
									<td>Date Filed:</td>
									<td><input type="date" id="dateFiled" name="dateFiled" value="<?php echo date('Y-m-d'); ?>" disabled/></td>
								</tr>
							</table>

						<button class="button" onclick="processPhase1()">Continue</button>
				</div><br><br>

				<div id="phase2">
					<table>
						<tr>
							<td>Organization Name:</td>
							<td><input type="text" id=" orgName" name="orgName" value="<?php echo $row['org_name']; ?>" disabled/></td>
							<td></td>
							<td><input type="radio" name="stay" id="new" value="new">New
								<input type="radio" name="stay" id="old" value="old">Old |</td>
							<td><input type="text" name="years" placeholder="years in existence..."></td>
						</tr>

					</table><br>

					<button class="button" onclick="processPhase2()">Continue</button>
					<button class="button" onclick="back1()">Back</button>
				</div>

				<div id="phase3">
					<table>
						<tr>
							<td>Category:</td>
							<td><input type="text" name="category" value="<?php echo $row['org_category']; ?>" disabled></td>
						</tr>
					</table><br>

					<button class="button" onclick="processPhase3()">Continue</button>
					<button class="button" onclick="back2()">Back</button>
				</div>

				<div id="phase4">
					Name of Adviser:<input type="text" name="adviser">
					Position/Designation:<input type="text" name="adviserPos">
					College/Unit:<input type="text" name="adviserUnit">
					<br><br>

					<button class="button" onclick="processPhase4()">Continue</button>
					<button class="button" onclick="back3()">Back</button>
				
				</div>

				<div id="phase5">
					Contact Person: <input type="text" name="contactPerson"><br>
					Position in Organization: <input type="text" name="contactPos"><br>
					Address: <input type="text" name="contactAddress"><br>
					Telephone No.: <input type="text" name="contactPhone">
					Mobile No.: <input type="text" name="contactMobile"><br>
					Email: <input type="text" name="contactMail"><br>
					Other Contact Details: <input type="text" name="contactOthers"><br><br>

					<button class="button" onclick="processPhase5()">Continue</button>
					<button class="button" onclick="back4()">Back</button>

				</div>

				<div id="phase6">
					Objectives of Organization:<br>
						<input type="text" id="objectives" name="objectives" value="<?php echo $row['objectives'];?>" disabled><br><br>
					Brief Description of Organization:<br>
						<input type="text" id="description" name="description" value="<?php echo $row['description']; ?>" disabled><br><br>

					<button class="button" onclick="processPhase6()">Continue</button>
					<button class="button" onclick="back5()">Back</button>
				</div>

				<!-- review details before submitting-->
				<div id="show_all_data">
					*show overview of data inputted*<br>

					<!-- add sweet alert -->
					<button class="button">Submit</button>
					<button class="button" onclick="submitForm()">Save</button>
					<button class="button" onclick="back6()">Back</button>
				</div>
			</form>

		</div>
	</div>
</div>
</div>
	</body>
</html>
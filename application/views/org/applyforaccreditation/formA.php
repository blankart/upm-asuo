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
		<div class="animated fadeIn" style="background-color: rgb(255,255,255); margin-top: 110px; margin-left: 22%; margin-right: 1%; padding-top: 10px; box-shadow: 0 0 40px rgba(0,0,0,.50); padding-bottom: 50px; border-radius: 10px;">
            <div class="col-4">
				<!-- sidenav -->
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
						Date Filed:&nbsp;&nbsp;<input type="date" id="dateFiled" name="dateFiled" value="<?php echo date('Y-m-d'); ?>" disabled/>
						<br><br><br>
						<button class="button" onclick="processPhase1()">Continue</button>
						
					</div>

					<div id="phase2">
						Organization Name:&nbsp;&nbsp;<input type="text" id="orgName" name="orgName" value="<?php echo $row['org_name']; ?>" disabled/>&nbsp;	
						<input type="radio" name="stay" id="new" value="new">&nbsp; New &nbsp; &nbsp;
						<input type="radio" name="stay" id="old" value="old">&nbsp; Old &nbsp; |
						<input type="text" id ="years" name="years" placeholder="years in existence...">
						<br><br><br>

						<button class="button" onclick="processPhase2()">Continue</button>
						<button class="button" onclick="back1()">Back</button>
					</div>

					<div id="phase3">
						Category:&nbsp;&nbsp;<input type="text" id="category" name="category" value="<?php echo $row['org_category']; ?>" disabled>
						<br><br><br>

						<button class="button" onclick="processPhase3()">Continue</button>
						<button class="button" onclick="back2()">Back</button>
					</div>

					<div id="phase4">
						Name of Adviser:&nbsp;&nbsp;<input type="text" id="adviser" name="adviser">
						Position/Designation:&nbsp;&nbsp;<input type="text" id="adviserPos" name="adviserPos">&nbsp;&nbsp;
						College/Unit:&nbsp;&nbsp;<input type="text" id="adviserUnit" name="adviserUnit">
						<br><br>

						<button class="button" onclick="processPhase4()">Continue</button>
						<button class="button" onclick="back3()">Back</button>
					</div>

					<div id="phase5">
						Contact Person:&nbsp;&nbsp;<input type="text" id="contactPerson" name="contactPerson">
						Position in Organization:&nbsp;&nbsp;<input type="text" id="contactPos" name="contactPos" placeholder="enter position">&nbsp;&nbsp;
						Email:&nbsp;&nbsp;<input type="text" id="contactMail" name="contactMail" placeholder="sample@up.edu.ph">
						Address:&nbsp;&nbsp;<input type="text" id="contactAddress" name="contactAddress" placeholder="enter address">
						Telephone No.:&nbsp;&nbsp;<input type="text" id="contactPhone" name="contactPhone" placeholder="xxx-xx-xx">&nbsp;&nbsp;
						Mobile No.:&nbsp;&nbsp;<input type="text" id="contactMobile" name="contactMobile" placeholder="xxx-xxx-xxxx">&nbsp;&nbsp;
						Other Contact Details:&nbsp;&nbsp;<input type="text" id="contactOthers" name="contactOthers">
						<br><br>

						<button class="button" onclick="processPhase5()">Continue</button>
						<button class="button" onclick="back4()">Back</button>
					</div>

					<div id="phase6">
						Objectives of Organization:
						<input type="text" id="objectives" name="objectives" value="<?php echo $row['objectives'];?>" disabled><br>
						Brief Description of Organization:
						<input type="text" id="description" name="description" value="<?php echo $row['description']; ?>" disabled><br><br>

						<button class="button" onclick="processPhase6()">Continue</button>
						<button class="button" onclick="back5()">Back</button>
					</div>

					<!-- review details before submitting-->
					<div id="show_all_data">
						*show overview of data inputted*<br>

						<!-- add sweet alert -->
						<button class="button" onclick="submitForm()">Save</button>
						<button class="button" onclick="back6()">Back</button>
					</div>
				</form>

			</div>
		</div>
	</body>
</html>
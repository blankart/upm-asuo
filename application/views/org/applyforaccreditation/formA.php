<!DOCTYPE html>
<html>
	<head>
		<title>Form A: Accreditation Application</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/phases.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sidenav.css">
		<script src="<?php echo base_url();?>js/script.js"></script>
		<!-- transferred script to formA.js -->
		<script type="text/javascript" src="<?php echo base_url(); ?>js/formA.js"></script>
	</head>

	<body>
		<div class="animated fadeIn" id="panel">
            <div class="col-4">
				<!-- sidenav -->
                <div class="sidenav">
                	<?php if($org_status == "Accredited"){ ?>
                	<ul class="menu">
                        <li><a href="<?php echo base_url(); ?>org/applyforaccreditation">Home</a></li>
                        <li class="active"><a href="<?php echo base_url(); ?>org/formA">Accreditation Application</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formB">Consent of Adviser</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formC">Organization Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formD">Officers' Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formE">Members' Profile</a></li>
                      	<li><a href="<?php echo base_url(); ?>org/formF">Activity Report</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formG">Financial Report</a></li>
                      	<li><a href="<?php echo base_url(); ?>org/plans">Plans</a></li>
                    </ul>

                    <?php } else{ ?>
                    <ul class="menu">
                        <li><a href="<?php echo base_url(); ?>org/applyforaccreditation">Home</a></li>
                        <li class="active"><a href="<?php echo base_url(); ?>org/formA">Accreditation Application</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formB">Consent of Adviser</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formC">Organization Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formD">Officers' Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formE">Members' Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/plans">Plans</a></li>
                    </ul>
                    <?php } ?>
                <button class="submitAll" onclick="location.href = '<?php echo base_url(); ?>org/submitAll';">Submit All</button>  
                </div>
            </div>
            
			<!-- Page Content -->
			<div class="main">
				<h1>Form A: Accreditation Application</h1>
				<!-- progress bar -->
				<progress id="progressBar" class="progressBar" value="0" max="100"></progress><br><br>

				<!-- form -->
				<form id="multiphase" onsubmit="return false" method="POST" action="saveFormA">
					<div id="phase1">
						Date Filed:&nbsp;&nbsp;<input type="date" id="dateFiled" name="dateFiled" value="<?php echo date('Y-m-d'); ?>" disabled/>
						<br><br>
						<button class="btn btn-danger" type="button" onclick="processPhase1()">Continue</button>
						
					</div>

					<div id="phase2">
						Organization Name:&nbsp;&nbsp;<input type="text" id="orgName" name="orgName" value="<?php echo $org_name; ?>" disabled/>&nbsp;	
						<input type="radio" name="data[stay]" id="new" value="new">&nbsp; New &nbsp; &nbsp;
						<input type="radio" name="data[stay]" id="old" value="old">&nbsp; Old &nbsp; |
						<input type="text" id ="years" name="data[experience]" value="<?php echo $experience ?>">
						<br><br><br>

						<button class="btn btn-danger" type="button" onclick="back1()">Back</button>
						<button class="btn btn-danger" type="button" onclick="processPhase2()">Continue</button>
					</div>

					<div id="phase3">
						Category:&nbsp;&nbsp;<input type="text" id="category" name="category" value="<?php echo $org_category ?>" disabled>
						<br><br><br>

						<button class="btn btn-danger" type="button" onclick="back2()">Back</button>
						<button class="btn btn-danger" type="button" onclick="processPhase3()">Continue</button>
					</div>

					<div id="phase4">
						Name of Adviser:&nbsp;&nbsp;<input type="text" id="adviser" onkeyup="incomplete1()" name="data[adviser]" value="<?php echo $adviser ?>" required>
						Position/Designation:&nbsp;&nbsp;<input type="text" id="adviserPos" onkeyup="incomplete1()" name="data[adviser_position]" value="<?php echo $adviser_position ?>" required>&nbsp;&nbsp;
						College/Unit:&nbsp;&nbsp;<input type="text" id="adviserUnit" onkeyup="incomplete1()" name="data[adviser_college]" value="<?php echo $adviser_college ?>" required>
						<br><br>

						<button class="btn btn-danger" type="button" onclick="back3()">Back</button>
						<button class="btn btn-danger" type="button" id="phase4but" onclick="processPhase4()" disabled>Continue</button>
					</div>

					<div id="phase5">
						Contact Person:&nbsp;&nbsp;<input type="text" id="contactPerson" onkeyup="incomplete2()" name="data[contact_person]" value="<?php echo $contact_person ?>" required>
						Position in Organization:&nbsp;&nbsp;<input type="text" id="contactPos" onkeyup="incomplete2()" name="data[contact_position]" value="<?php echo $contact_position ?>" required>&nbsp;&nbsp;
						Email:&nbsp;&nbsp;<input type="email" id="contactMail" onkeyup="incomplete2()" name="data[contact_email]"  value="<?php echo $contact_email ?>" required>
						Address:&nbsp;&nbsp;<input type="text" id="contactAddress" onkeyup="incomplete2()" name="data[contact_address]"  value="<?php echo $contact_address ?>" required>
						Telephone No.:&nbsp;&nbsp;<input type="text" id="contactPhone" onkeyup="incomplete2()" name="data[contact_tel]"  value="<?php echo $contact_tel ?>" required>&nbsp;&nbsp;
						Mobile No.:&nbsp;&nbsp;<input type="text" id="contactMobile" onkeyup="incomplete2()" name="data[contact_mobile]"  value="<?php echo $contact_mobile ?>" required>&nbsp;&nbsp;
						Other Contact Details:&nbsp;&nbsp;<input type="text" id="contactOthers" name="data[contact_other_details]" placeholder="N/A if none" value="<?php echo $contact_other_details ?>" required>
						<br><br>

						<button class="btn btn-danger" type="button" onclick="back4()">Back</button>
						<button class="btn btn-danger" type="button" id="phase5but" onclick="processPhase5()" disabled>Continue</button>
					</div>

					<div id="phase6">
						Objectives of Organization:<br>
						<textarea rows="2" cols="100%" id="objectives" name="objectives" style="resize: none;" placeholder="<?php echo $objectives?>" disabled></textarea><br><br>
						Brief Description of Organization:<br>
						<textarea rows="2" cols="100%" id="description" name="description" style="resize: none;" placeholder="<?php echo $description ?>" disabled></textarea><br><br>

						<button class="btn btn-danger" type="button" onclick="back5()">Back</button>
						<button class="btn btn-danger" type="button" onclick="submitForm()">Save</button>
					</div>
					<input type="hidden" name="data[app_id]" value="<?php echo $app_id;?>">
				</form>
			</div>
		</div>
	</body>
</html>
<<<<<<< HEAD
<script type="text/javascript">
	function inStay(){
      var inStay = "<?php echo $stay; ?>"

      if(inStay == "new")
         document.getElementById("new").checked = true;
      else if(inStay == "old"){
         document.getElementById("old").checked = true; 
      }
   }
   function activateText(value){
      var textbox = document.getElementById("years");

      if(value == "old"){
         textbox.disabled = false;
      } else {
         textbox.disabled = true;
      }
   }

   window.onload = inStay;
</script>
=======
>>>>>>> a99caad95721322dd31ba2be9118983ed8616bf6
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
                	<?php if($org_status == "Accredited"){ ?>
                    <li><a href="<?php echo base_url(); ?>org/applyforaccreditation">Home</a></li>
                    <li class="active"><a href="<?php echo base_url(); ?>org/formA">Accreditation Application</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formB">Consent of Adviser</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formC">Organization Profile</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formD">Officers' Profile</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formE">Members' Profile</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formF">Projects</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formG">Financial Report</a></li>

                    <?php } else{ ?>
                    <li><a href="<?php echo base_url(); ?>org/applyforaccreditation">Home</a></li>
                    <li class="active"><a href="<?php echo base_url(); ?>org/formA">Accreditation Application</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formB">Consent of Adviser</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formC">Organization Profile</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formD">Officers' Profile</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formE">Members' Profile</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formF">Projects</a></li>
                    <?php } ?>
                    
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
						<br><br><br>
						<button class="button" onclick="processPhase1()">Continue</button>
						
					</div>

					<div id="phase2">
						Organization Name:&nbsp;&nbsp;<input type="text" id="orgName" name="orgName" value="<?php echo $org_name; ?>" disabled/>&nbsp;	
<<<<<<< HEAD
						<input type="radio" name="data[stay]" id="new" onclick="activateText(this.value)" value="new">&nbsp; New &nbsp; &nbsp;
						<input type="radio" name="data[stay]" id="old"  onclick="activateText(this.value)" value="old">&nbsp; Old &nbsp; |
						<input type="text" id ="years" name="data[experience]" value="<?php echo $experience ?>">
=======
						<input type="radio" name="stay" id="new" value="new">&nbsp; New &nbsp; &nbsp;
						<input type="radio" name="stay" id="old" value="old">&nbsp; Old &nbsp; |
						<input type="text" id ="years" name="years" placeholder="years in existence...">
>>>>>>> a99caad95721322dd31ba2be9118983ed8616bf6
						<br><br><br>

						<button class="button" onclick="processPhase2()">Continue</button>
						<button class="button" onclick="back1()">Back</button>
					</div>

					<div id="phase3">
<<<<<<< HEAD
						Category:&nbsp;&nbsp;<input type="text" id="category" name="category" value="<?php echo $org_category ?>" disabled>
=======
						Category:&nbsp;&nbsp;<input type="text" id="category" name="category" value="<?php echo $org_category; ?>" disabled>
>>>>>>> a99caad95721322dd31ba2be9118983ed8616bf6
						<br><br><br>

						<button class="button" onclick="processPhase3()">Continue</button>
						<button class="button" onclick="back2()">Back</button>
					</div>

					<div id="phase4">
						Name of Adviser:&nbsp;&nbsp;<input type="text" id="adviser" name="data[adviser]" value="<?php echo $adviser ?>">
						Position/Designation:&nbsp;&nbsp;<input type="text" id="adviserPos" name="data[adviser_position]" value="<?php echo $adviser_position ?>">&nbsp;&nbsp;
						College/Unit:&nbsp;&nbsp;<input type="text" id="adviserUnit" name="data[adviser_college]" value="<?php echo $adviser_college ?>">
						<br><br>

						<button class="button" onclick="processPhase4()">Continue</button>
						<button class="button" onclick="back3()">Back</button>
					</div>

					<div id="phase5">
						Contact Person:&nbsp;&nbsp;<input type="text" id="contactPerson" name="data[contact_person]" value="<?php echo $contact_person ?>">
						Position in Organization:&nbsp;&nbsp;<input type="text" id="contactPos" name="data[contact_position]" value="<?php echo $contact_position ?>">&nbsp;&nbsp;
						Email:&nbsp;&nbsp;<input type="text" id="contactMail" name="data[contact_email]"  value="<?php echo $contact_email ?>">
						Address:&nbsp;&nbsp;<input type="text" id="contactAddress" name="data[contact_address]"  value="<?php echo $contact_address ?>">
						Telephone No.:&nbsp;&nbsp;<input type="text" id="contactPhone" name="data[contact_tel]"  value="<?php echo $contact_tel ?>">&nbsp;&nbsp;
						Mobile No.:&nbsp;&nbsp;<input type="text" id="contactMobile" name="data[contact_mobile]"  value="<?php echo $contact_mobile ?>">&nbsp;&nbsp;
						Other Contact Details:&nbsp;&nbsp;<input type="text" id="contactOthers" name="data[contact_other_details]" value="<?php echo $contact_other_details ?>">
						<br><br>

						<button class="button" onclick="processPhase5()">Continue</button>
						<button class="button" onclick="back4()">Back</button>
					</div>

					<div id="phase6">
						Objectives of Organization:
<<<<<<< HEAD
						<input type="text" id="objectives" name="objectives" value="<?php echo $objectives?>" disabled><br>
						Brief Description of Organization:
						<input type="text" id="description" name="description" value="<?php echo $description ?>" disabled><br><br>
=======
						<input type="text" id="objectives" name="objectives" value="<?php echo $objectives;?>" disabled><br>
						Brief Description of Organization:
						<input type="text" id="description" name="description" value="<?php echo $description; ?>" disabled><br><br>
>>>>>>> a99caad95721322dd31ba2be9118983ed8616bf6

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
					<input type="hidden" name="data[app_id]" value="<?php echo $app_id;?>">
				</form>

			</div>
		</div>
	</body>
</html>
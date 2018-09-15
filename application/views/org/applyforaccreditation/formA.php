<script>//form validation


	function nameFormatCheck(input) {  
    var regex_num = new RegExp('^[0-9]*$');
    var regex = new RegExp("^[a-zA-Z]+( [a-zA-Z]+)*$");
    var value =  input.value;
    
    if( regex_num.test(value) )
       input.setCustomValidity("Numbers are not allowed!");   
    else if( !regex.test(value) )
      input.setCustomValidity("Special characters are not allowed!");   
    else 
      input.setCustomValidity("");      
  }

  function noSpecialCharactersAndExtraSpacesCheck(input){

        var regex = new RegExp("^[a-zA-Z0-9]+( [a-zA-Z0-9]+)*$");
        var value =  input.value;
        
        if( !regex.test(value) )
          input.setCustomValidity("Special characters and extra spaces are not allowed!");   
        else 
          input.setCustomValidity("");    
    }

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

<!DOCTYPE html>
<html>
	<head>
		<title>Form A: Accreditation Application</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/phases.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/home.css">
		<script src="<?php echo base_url();?>js/script.js"></script>
	</head>

	<body>
    <div id="panel" class='animated fadeIn'>
        <div class="container">
            <div class="row">
                <!-- menu -->
                <div class="col-4">
                    <div class="card" id="ProfileDetails">
                        <?php if($org_accred_status == "old"){ ?>
                        <div class="card-body">
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/applyforaccreditation';"><i style='float: left;'></i>Home</button>
                            <button class="btn btn-secondary btn-block active" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formA';"><i style='float: left;'></i>Accreditation Application</button> 
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formB';"><i style='float: left;'></i>Adviser's Consent</button>
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formC';"><i style='float: left;'></i>Organization Profile</button>
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formD';"><i style='float: left;'></i>Officers' Profile</button>
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formE';"><i style='float: left;'></i>Members' Profile</button>
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formF';"><i style='float: left;'></i>Activity Report</button>
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formG';"><i style='float: left;'></i>Financial Report</button>
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/plans';"><i style='float: left;'></i>Plans</button> 
                            <button class="btn btn-warning btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/submitAll';"><i style='float: left;'></i>Checklist</button> 
                        </div>
                        <?php } else{ ?>
                        <div class="card-body">
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/applyforaccreditation';"><i style='float: left;'></i>Home</button>
                            <button class="btn btn-secondary btn-block active" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formA';"><i style='float: left;'></i>Accreditation Application</button> 
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formB';"><i style='float: left;'></i>Adviser's Consent</button>
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formC';"><i style='float: left;'></i>Organization Profile</button>
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formD';"><i style='float: left;'></i>Officers' Profile</button>
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formE';"><i style='float: left;'></i>Members' Profile</button> 
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/plans';"><i style='float: left;'></i>Plans</button> 
                            <button class="btn btn-warning btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/submitAll';"><i style='float: left;'></i>Checklist</button>
                        </div>
                        <?php } ?>

                    </div>
                </div>
            
			<!-- Page Content -->
               <div class="col-8">
                    <div class="card" style="box-shadow: 0 0 40px rgba(0,0,0,.2); height: 500px;">
                        <div class='card-header home-header'>
                           <h4 id="pd">Accreditation Application</h4> 
                        </div>

                        <div class="card-body" style='overflow-y: scroll;'>
							<!-- progress bar -->
							<progress id="progressBar" class="progressBar" value="0" max="100"></progress><br><br>

							<!-- form -->
							<form id="multiphase" onsubmit="return false" method="POST" action="saveFormA">
								<div id="phase1">
									Date Filed:<br>
										<input type="date" id="dateFiled" name="dateFiled" value="<?php echo date('Y-m-d'); ?>" disabled/><br><br>
									<button class="btn btn-danger" type="button" onclick="processPhase1()">Continue</button><br><br>
								</div>

								<div id="phase2">
									Organization Name:<br>
										<input type="text" id="orgName" name="orgName" value="<?php echo $org_name; ?>" disabled/><br>	
									<input type="radio" name="data[stay]" id="new" value="new">&nbsp; New &nbsp; &nbsp;
									<input type="radio" name="data[stay]" id="old" value="old">&nbsp; Old &nbsp; |
									<input type="text" id ="years" name="data[experience]" value="<?php echo $experience ?>">
									<br><br><br>

									<button class="btn btn-danger" type="button" onclick="back1()">Back</button>
									<button class="btn btn-danger" type="button" onclick="processPhase2()">Continue</button>
								</div>

								<div id="phase3">
									Category:<br>
										<input type="text" id="category" name="category" value="<?php echo $org_category ?>" disabled>
									<br><br><br>

									<button class="btn btn-danger" type="button" onclick="back2()">Back</button>
									<button class="btn btn-danger" type="button" onclick="processPhase3()">Continue</button>
								</div>

								<div id="phase4">
									Name of Adviser:<br>
										<input type="text" id="adviser" onkeyup="incomplete1()" name="data[adviser]" value="<?php echo $adviser ?>" required>
									Position/Designation:<br>
										<input type="text" id="adviserPos" onkeyup="incomplete1()" name="data[adviser_position]" value="<?php echo $adviser_position ?>" required>
									College/Unit:<br>
										<input type="text" id="adviserUnit" onkeyup="incomplete1()" name="data[adviser_college]" value="<?php echo $adviser_college ?>" required>
									<br><br>

									<button class="btn btn-danger" type="button" onclick="back3()">Back</button>
									<button class="btn btn-danger" type="button" id="phase4but" onclick="processPhase4()" disabled>Continue</button>
								</div>

								<div id="phase5">
								Contact Person:><br>
									<input type="text" id="contactPerson" onkeyup="incomplete2()" name="data[contact_person]" value="<?php echo $contact_person ?>" required>
								Position in Organization:<br>
									<input type="text" id="contactPos" onkeyup="incomplete2()" name="data[contact_position]" value="<?php echo $contact_position ?>" required>
								Email:<br>
									<input type="email" id="contactMail" onkeyup="incomplete2()" name="data[contact_email]"  value="<?php echo $contact_email ?>" required>
								Address:<br>
									<input type="text" id="contactAddress" onkeyup="incomplete2()" name="data[contact_address]"  value="<?php echo $contact_address ?>" required>
								Tel. No.:<br>
									<input type="text" id="contactPhone" onkeyup="incomplete2()" name="data[contact_tel]"  value="<?php echo $contact_tel ?>" required>
								Mobile No.:<br>
									<input type="text" id="contactMobile" onkeyup="incomplete2()" name="data[contact_mobile]"  value="<?php echo $contact_mobile ?>" required>
								Other Contact Details:<br>
									<input type="text" id="contactOthers" name="data[contact_other_details]" placeholder="N/A if none" value="<?php echo $contact_other_details ?>" required>
								<br><br>

								<button class="btn btn-danger" type="button" onclick="back4()">Back</button>
								<button class="btn btn-danger" type="button" id="phase5but" onclick="processPhase5()" disabled>Continue</button>
								</div>

								<div id="phase6">
									Objectives of Organization:<br>
										<textarea id="objectives" name="objectives" placeholder="<?php echo $objectives?>" disabled></textarea><br><br>
									Brief Description of Organization:<br>
										<textarea id="description" name="description" placeholder="<?php echo $description ?>" disabled></textarea><br><br>

									<button class="btn btn-danger" type="button" onclick="back5()">Back</button>
									<button class="btn btn-danger" type="button" onclick="submitForm()">Save</button>
								</div>
							<input type="hidden" name="data[app_id]" value="<?php echo $app_id;?>">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
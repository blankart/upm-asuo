<script type="text/javascript">
	
   function incSEC(){
      var incSEC = "<?php echo $incSEC; ?>";

      if(incSEC == 1){
         document.getElementById("yes").checked = true;
         document.getElementById('when').value = "<?php echo $sec_years; ?>";
      }
      else{
         document.getElementById("no").checked = true; 
         document.getElementById("when").disabled = true;
      }

   }
   //ALDRIN
   function submitFormC(){
   	$.ajax({
              type: "post",
           		url :"<?php echo base_url(); ?>org/viewFormC", 
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                //data: new FormData(this),
                  		success : function (/*data*/){
                      		swal({title: "Success!", text: "Form now ready for review!", type: "success"},
                        		function(){ 
                              location.href = "<?php echo base_url(); ?>org/viewFormC";
                              //location.reload();
                        		}
                     		);
                  		},
                  		error: function(XMLHttpRequest, textStatus, errorThrown) { 
                     		//alert("Status: " + textStatus + " | Error: " + errorThrown); 
                     		swal("Error!", "Your file may be too large or not of valid type! (PDF only)", "error");
                  		}   
                 	});
   }

   function activateText(value){
      var textbox = document.getElementById("when");

      if(value == "yes"){
         textbox.disabled = false;
      } else {
         textbox.disabled = true;
      }
   }
   window.onload=incSEC;
</script>

<!DOCTYPE html>
<html>
	<head>
		<title>Form C: Organization Profile</title>
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
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formA';"><i style='float: left;'></i>Accreditation Application</button> 
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formB';"><i style='float: left;'></i>Adviser's Consent</button>
                            <button class="btn btn-secondary btn-block active" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formC';"><i style='float: left;'></i>Organization Profile</button>
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
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formA';"><i style='float: left;'></i>Accreditation Application</button> 
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formB';"><i style='float: left;'></i>Adviser's Consent</button>
                            <button class="btn btn-secondary btn-block active" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formC';"><i style='float: left;'></i>Organization Profile</button>
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
                  <div class="card" style="box-shadow: 0 0 40px rgba(0,0,0,.2); height: 700px;">
                    <div class='card-header home-header'>
                      <h4 id="pd">Organization Profile</h4> 
                    </div>

                    <div class="card-body">
                      <div class="card-body" style='overflow-y: scroll;'>
			                  <!-- progress bar -->
			                  <progress id="progressBar" class="progressBar" value="0" max="100"></progress><br><br>

			                  <!-- form -->
			                  <form id="multiphase2" onsubmit="return false">
				                  <div id="cphase1">
                            Name of Organization:<br>
                              <input type="text" id="orgName" name="orgName" value="<?php echo $org_name; ?>" disabled>
                            Acronym:<br>
                              <input type="text" id="acronym" name="acronym" value="<?php echo $acronym; ?>" disabled>
                            Mailing Address<br>
                              <input type="text" id="address" name="address" value="<?php echo $mailing_address; ?>" disabled> 
                            Email Address:<br>
                              <input type="text" id="email" name="email" value="<?php echo $org_email; ?>" disabled>
                            Website:<br>
                            <input type="text" id="website" name="website" value="<?php echo $org_website; ?>" disabled>
                            Date Established:<br>
                              <input type="text" id="established" name="established" value="<?php echo $date_established; ?>" disabled>

                            <br><br>

					                  <button class="btn btn-danger" type="button" onclick="processcPhase1()">Continue</button>
				                  </div>

				                  <div id="cphase2">
                            Total Number of Members:<br>
                              <input type="text" id="numMembers" name="numMembers" value ="<?php echo array_sum($tally);?>" disabled><br><br>
		
					                    <button class="btn btn-danger" type="button" onclick="backc1()">Back</button>
					                    <button class="btn btn-danger" type="button" onclick="processcPhase2()">Continue</button>
				                  </div>
			
				                  <div id="cphase3">
					                  Is your organization incorporated with the Securities and Exchange Commission(SEC)? &nbsp;&nbsp;
					                    <input type="radio" id="no" name="incSEC" value="no" onclick="activateText(this.value)" disabled>&nbsp; No &nbsp;&nbsp;
					                    <input type="radio" id="yes" name="incSEC" onclick="activateText(this.value)" value="yes" disabled>&nbsp; Yes,&nbsp;when?&nbsp;&nbsp;
					                    <input type="text" id="when" name="when" placeholder="year" disabled>
					                   
                              <br><br>

					                    <button class="btn btn-danger" type="button" onclick="backc2()">Back</button>
					                    <button class="btn btn-danger" type="button" onclick="submitFormC()">Save</button>
				                  </div>
			                  </form>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
    	</body>
</html>
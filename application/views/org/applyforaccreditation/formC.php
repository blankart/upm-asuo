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
           		url :"<?php echo base_url(); ?>org/uploadFormC", 
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                //data: new FormData(this),
                  		success : function (/*data*/){
                      		swal({title: "Success!", text: "You have successfully uploaded your file!", type: "success"},
                        		function(){ 
                           			location.reload();
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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sidenav.css">
		<script src="<?php echo base_url();?>js/script.js"></script>
	</head>

	<body>
   		<div class="animated fadeIn" id="panel">
            <div class="col-4">
                <!-- insert sidenav -->
                <div class="sidenav">
                	<?php if($org_accred_status == "old"){ ?>
                	<ul class="menu">
                        <li><a href="<?php echo base_url(); ?>org/applyforaccreditation">Home</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formA">Accreditation Application</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formB">Consent of Adviser</a></li>
                        <li class="active"><a href="<?php echo base_url(); ?>org/formC">Organization Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formD">Officers' Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formE">Members' Profile</a></li>
                      	<li><a href="<?php echo base_url(); ?>org/formF">Activity Report</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formG">Financial Report</a></li>
                      	<li><a href="<?php echo base_url(); ?>org/plans">Plans</a></li>
                    </ul>

                    <?php } else{ ?>
                    <ul class="menu">
                        <li><a href="<?php echo base_url(); ?>org/applyforaccreditation">Home</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formA">Accreditation Application</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formB">Consent of Adviser</a></li>
                        <li class="active"><a href="<?php echo base_url(); ?>org/formC">Organization Profile</a></li>
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
			<h1>Form C: Organization Profile</h1>
			<!-- progress bar -->
			<progress id="progressBar" class="progressBar" value="0" max="100"></progress><br><br>

			<!-- form -->
			<form id="multiphase2" onsubmit="return false">
				<div id="cphase1">
					Name of Organization:&nbsp;&nbsp;<input type="text" id="orgName" name="orgName" value="<?php echo $org_name; ?>" disabled>&nbsp;&nbsp;&nbsp;
					Acronym:&nbsp;&nbsp;<input type="text" id="acronym" name="acronym" value="<?php echo $acronym; ?>" disabled>
					Mailing Address:&nbsp;&nbsp;<input type="text" id="address" name="address" value="<?php echo $mailing_address; ?>" disabled> 
					Email Address:&nbsp;&nbsp;<input type="text" id="email" name="email" value="<?php echo $org_email; ?>" disabled>&nbsp;&nbsp;
					Website:&nbsp;&nbsp;<input type="text" id="website" name="website" value="<?php echo $org_website; ?>" disabled>&nbsp;&nbsp;
					Date Established:&nbsp;&nbsp;<input type="text" id="established" name="established" value="<?php echo $date_established; ?>" disabled>
					<br><br>

					<button class="btn btn-danger" type="button" onclick="processcPhase1()">Continue</button>
				</div>

				<div id="cphase2">
					Total Number of Members:&nbsp;&nbsp;<input type="text" id="numMembers" name="numMembers" value ="<?php 
					echo array_sum($tally);

					 ?>" disabled><br><br>
		
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
					<button class="btn btn-danger" type="button" onclick="processcPhase3()">Continue</button>
				</div>
			</form>

			<!-- review details before submitting-->
			<div class="myBtn" id="show_dataPrev">
				<object data="<?php echo base_url(); ?>org/viewFormC" type="pdf" width="100%" height="500">
					<iframe src="<?php echo base_url(); ?>org/viewFormC" style="border: none;" width="100%" height="400">This browser does not support PDFs. Please download the PDF to view it: <a href="<?php echo base_url(); ?>org/formCpdf">Download PDF</a>
					</iframe>
				</object>
				<br><br>
			</div>
		</div>
	</div>
	</body>
</html>
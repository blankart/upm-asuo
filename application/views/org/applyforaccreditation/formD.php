<!DOCTYPE html>
<html>
	<head>
		<title>Form D: Officers' Profile</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sidenav.css">
	</head>

	<body>
   		<div class="animated fadeIn" style="background-color: rgb(255,255,255); margin-top: 110px; margin-left: 22%; margin-right: 1%; padding-top: 10px; box-shadow: 0 0 40px rgba(0,0,0,.50); padding-bottom: 50px; border-radius: 10px;">
            <div class="col-4">
            <!-- insert sidenav -->
                <div class="sidenav">
                    <?php if($org_status == "Accredited"){ ?>
                    <li><a href="<?php echo base_url(); ?>org/applyforaccreditation">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formA">Accreditation Application</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formB">Consent of Adviser</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formC">Organization Profile</a></li>
                    <li class="active"><a href="<?php echo base_url(); ?>org/formD">Officers' Profile</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formE">Members' Profile</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formF">Projects</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formG">Financial Report</a></li>

                    <?php } else{ ?>
                    <li><a href="<?php echo base_url(); ?>org/applyforaccreditation">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formA">Accreditation Application</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formB">Consent of Adviser</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formC">Organization Profile</a></li>
                    <li class="active"><a href="<?php echo base_url(); ?>org/formD">Officers' Profile</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formE">Members' Profile</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formF">Projects</a></li>
                    <?php } ?>
                    
                </div>
            </div>
            
            <!-- Page Content -->
			<div class="main">
			<h1>Form D: Officers' Profile</h1>
				<object data="<?php echo base_url(); ?>org/viewFormD" type="pdf" width="100%" height="400">
					<iframe src="<?php echo base_url(); ?>org/viewFormD" style="border: none;" width="100%" height="400">This browser does not support PDFs. Please download the PDF to view it: <a href="<?php echo base_url(); ?>org/formDpdf">Download PDF</a>
					</iframe>
				</object>

				<button class="button">Save</button><br><br>
			</div>
		</div>
	</body>
</html>
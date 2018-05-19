<!DOCTYPE html>
<html>
	<head>
		<title>Form D: Officers' Profile</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sidenav.css">
	</head>

	<body>
   		<div class="animated fadeIn" id="panel">
            <div class="col-4">
            <!-- insert sidenav -->
                <?php if($org_status == "Accredited"){ ?>
                <ul class="menu">
                        <li><a href="<?php echo base_url(); ?>org/applyforaccreditation">Home</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formA">Accreditation Application</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formB">Consent of Adviser</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formC">Organization Profile</a></li>
                        <li class="active"><a href="<?php echo base_url(); ?>org/formD">Officers' Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formE">Members' Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formF">Activity Report</li>
                        <li><a href="<?php echo base_url(); ?>org/formG">Financial Report</a></li>
                        <li><a href="<?php echo base_url(); ?>org/plans">Plans</a></li>
                    </ul>

                    <?php } else{ ?>
                    <ul class="menu">
                        <li><a href="<?php echo base_url(); ?>org/applyforaccreditation">Home</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formA">Accreditation Application</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formB">Consent of Adviser</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formC">Organization Profile</a></li>
                        <li class="active"><a href="<?php echo base_url(); ?>org/formD">Officers' Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formE">Members' Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/plans">Plans</a></li>
                    </ul>
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
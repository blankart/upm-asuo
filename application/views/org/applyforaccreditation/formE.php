<!DOCTYPE html>
<html>
	<head>
		<title>Form E: Members' Profile</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sidenav.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/upload.css">

        <script>
            function openWin() {
                window.open("applyforaccreditation/formE.pdf"); //change location
            }
        </script>
	</head>

	<body>
   		<div class="animated fadeIn" id="panel">
            <div class="col-4">
            <!-- insert sidenav -->
                <div class="sidenav">
                    <?php if($org_status == "Accredited"){ ?>
                    <ul class="menu">
                        <li><a href="<?php echo base_url(); ?>org/applyforaccreditation">Home</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formA">Accreditation Application</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formB">Consent of Adviser</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formC">Organization Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formD">Officers' Profile</a></li>
                        <li class="active"><a href="<?php echo base_url(); ?>org/formE">Members' Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formF">Projects</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formG">Financial Report</a></li>
                    </ul>
                    
                    <?php } else{ ?>
                    <ul class="menu">
                        <li><a href="<?php echo base_url(); ?>org/applyforaccreditation">Home</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formA">Accreditation Application</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formB">Consent of Adviser</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formC">Organization Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formD">Officers' Profile</a></li>
                        <li class="active"><a href="<?php echo base_url(); ?>org/formE">Members' Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formF">Projects</a></li>
                    </ul>
                    <?php } ?>

                </div>
            </div>
            <!-- Page Content -->
			<div class="main">
			<h1>Form E: Members' Profile</h1>
                <object data="<?php echo base_url(); ?>org/viewFormE" type="pdf" width="100%" height="400">
                    <iframe src="<?php echo base_url(); ?>org/viewFormE" style="border: none;" width="100%" height="400">This browser does not support PDFs. Please download the PDF to view it: <a href="<?php echo base_url(); ?>org/formDpdf">Download PDF</a>
                    </iframe>
                </object>

                <button class="button">Save</button><br><br>
			</div>
		</div>
	</body>
</html>
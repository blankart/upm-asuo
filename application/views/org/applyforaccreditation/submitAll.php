<!DOCTYPE html>

<script type="text/javascript">
	function noFileUpload(){
		swal('Warning', 'You have not uploaded yet!', 'warning');
	}

</script>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="UPCS" name="author">
        <title>Accreditation Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/table.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sidenav.css">
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
                <h1>Review All Forms Before Submitting</h1>
                <table>
                    <tr>
                        <th id="header">Accreditation Form</th>
                        <th id="header">Action</th>
                    </tr>
                    <tr>
                        <td>Form A: Accreditation Application</td>
                        <td align="center"><button class="btn btn-danger" onclick="

                        <?php if($form_A != 'No Submission'){ ?>
                        	window.open('<?php echo base_url(); ?>/assets/org/accreditation/form_A/<?php echo $form_A; ?>')
                        <?php } else {?>
                        	noFileUpload()
                        <?php } ?>

                        ">View</button>
                    </tr>
                    <tr>
                        <td>Form B: Adviser's Consent</td>
                        <td align="center"><button class="btn btn-danger" onclick="

                        <?php if($form_B != 'No Submission'){ ?>
                        	window.open('<?php echo base_url(); ?>/assets/org/accreditation/form_B/<?php echo $form_B; ?>')
                        <?php } else {?>
                        	noFileUpload()
                        <?php } ?>


                        ">View</button>
                    </tr>
                    <tr>
                        <td>Form C: Organization Profile</td>
                        <td align="center"><button class="btn btn-danger" onclick="window.open('<?php echo base_url(); ?>org/viewFormC');">View</button>
                    </tr>
                    <tr>
                        <td>Form D: Officers' Profile</td>
                        <td align="center"><button class="btn btn-danger" onclick="window.open('<?php echo base_url(); ?>org/viewFormD');">View</button>
                    </tr>
                    <tr>
                        <td>Form E: Members' Profile</td>
                        <td align="center"><button class="btn btn-danger" onclick="window.open('<?php echo base_url(); ?>org/viewFormE');">View</button>
                    </tr>
                    
                    <?php if($org_status == "Accredited"){ ?>
                        <tr>
                            <td>Form F: Activity Report</td>
                            <td align="center"><button class="btn btn-danger" onclick="

                            <?php if($form_F != 'No Submission'){ ?>
                        		window.open('<?php echo base_url(); ?>/assets/org/accreditation/form_F/<?php echo $form_F; ?>')
                        	<?php }else {?>
                        		noFileUpload()
                       		<?php } ?>

                            ">View</button>
                        </tr>
                        <tr>
                            <td>Form G: Financial Report</td>
                            <td align="center"><button class="btn btn-danger" onclick="

                            <?php if($form_G != 'No Submission'){ ?>
                        		window.open('<?php echo base_url(); ?>/assets/org/accreditation/form_G/<?php echo $form_G; ?>')
                        	<?php }else {?>
                        		noFileUpload()
                       		<?php } ?>

                            ">View</button>
                        </tr>
                    
                    <?php } ?>

                    <tr>
                        <td>Plans</td>
                        <td align="center"><button class="btn btn-danger" onclick="

  						<?php if($plans != 'No Submission'){ ?>
                        	window.open('<?php echo base_url(); ?>/assets/org/accreditation/plans/<?php echo $plans; ?>')
                        <?php }else {?>
                        	noFileUpload()
                        <?php } ?>

                        ">View</button>
                    </tr>

                    <tr>
                        <td>Constitution</td>
                        <td align="center"><button class="btn btn-danger" onclick="

                        <?php if($constitution != 'No uploads yet'){ ?>
                        	window.open('<?php echo base_url(); ?>/assets/org/constitution/<?php echo $constitution; ?>')
                        <?php }else {?>
                        	noFileUpload()
                        <?php } ?>

                        ">View</button>
                    </tr>

                </table>
                <br><br>
                <div class="myBtn">
                    <button class="btn btn-danger">Submit Application</button>
                </div>   
            </div>  
        </div>
    </body>

</html>
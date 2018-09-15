<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="UPCS" name="author">
        <title>Accreditation Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/org.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/home.css">
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
                            <button class="btn btn-secondary btn-block active" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/applyforaccreditation';"><i style='float: left;'></i>Home</button>
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formA';"><i style='float: left;'></i>Accreditation Application</button> 
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
                            <button class="btn btn-secondary btn-block active" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/applyforaccreditation';"><i style='float: left;'></i>Home</button>
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formA';"><i style='float: left;'></i>Accreditation Application</button> 
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

                <!-- body -->
                <div class="col-8">
                    <div class="card" style="box-shadow: 0 0 40px rgba(0,0,0,.2); height: 600px;">
                        <div class='card-header home-header'>
                           <h4 id="pd">Requirements for Accreditation</h4> 
                        </div>

                        <div class="card-body" style='overflow-y: scroll;'>
                            &nbsp;1.&nbsp;&nbsp;Complete this document list on or before <b><?php if($end_date != false){  echo date("F j, Y g:i:s a ", strtotime($end_date)); } ?></b><br><br>
                            <table>
                                <tr align="center">
                                    <th></th>
                                    <th>Previously Accredited/Old Organization</th>
                                    <th></th>
                                    <th>New Organization</th>
                                </tr>
                                <tr align="center">
                                    <td>FORM</td>
                                    <td></td>
                                    <td>FORM</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td align="center">A</td>
                                    <td>Application Form</td>
                                    <td align="center">A</td>
                                    <td>Application Form</td>
                                </tr>
                                <tr>
                                    <td align="center">B</td>
                                    <td>Adviser's Consent</td>
                                    <td align="center">B</td>
                                    <td>Adviser's Consent</td>
                                </tr>
                                <tr>
                                    <td align="center">C</td>
                                    <td>Organization Profile</td>
                                    <td align="center">C</td>
                                    <td>Organization Profile</td>
                                </tr>
                                <tr>
                                    <td align="center">D</td>
                                    <td>Officers' Profile</td>
                                    <td align="center">D</td>
                                    <td>Officers' Profile</td>
                                </tr>   
                                <tr>
                                    <td align="center">E</td>
                                    <td>Members' Profile</td>
                                    <td align="center">E</td>
                                    <td>Members' Profile</td>
                                </tr>
                                <tr>
                                    <td align="center">F</td>
                                    <td>Activity Report of Previous Academic Year</td>
                                    <td></td>
                                    <td>Plans for the Academic Year</td>
                                </tr>
                                <tr>
                                    <td align="center">G</td>
                                    <td>Financial Statement</td>
                                    <td></td>
                                    <td>Constitution and By-Laws</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Tentative Plans for Current Academic Year</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Amended Constitution and By-Laws(if applicable)</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table><br>

                            <!-- table 2 -->
                            <h2>Accreditation is based on</h2>
                            <table>
                            <tr>
                                <th>Requirements</th>
                                <th>Points</th>
                            </tr>
                            <tr>
                                <td>Fully-documented and completed activities that conform to the organization's objectives and goals with participation of at least 50% of the members</td>
                                <td align="right">30</td>
                            </tr>
                            <tr>
                                <td>Participation and/or assistance by at least 20% of its members in University/College programs/projects/ activities (including participation in the CAS Student Summit and attendance of Gender Sensitivity seminar by at least 50% of members)</td>
                                <td align="right">30</td>
                            </tr>
                            <tr>
                                <td>Contribution to student welfare, service to others/community (including PGH outreach programs, participation in national, local or any welfare/civic institutions) by at least 20% of members</td>
                                <td align="right">10</td>
                            </tr>
                            <tr>
                                <td>Growth in terms of increased membership, expanded programs</td>
                                <td align="right">10</td>
                            </tr>
                            <tr>
                                <td>Maintenance of tambayan and/or judicious use of College facilities/equipment (including adherence to posting rules and regulations)</td>
                                <td align="right">10</td>
                            </tr>
                            <tr>
                                <td>Attendance in meetings and general assemblies called by the OSS and/or Council of Student Organizations</td>
                                <td align="right">10</td>
                            </tr>
                            <tr>
                                <td><b>TOTAL</b></td>
                                <td align="right"><b>100</b></td>
                            </tr>
                            </table><br><br>
                            <!-- end of table 2 -->

                            <h2>Accreditation Points:</h2>
                            &nbsp;0-50&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;No accreditation can be granted<br>

                            &nbsp;51-60&nbsp;&nbsp;>&nbsp;Probation Status- Organization shall be advised to perform better (rights and privileges accorded to organizations with full accreditation are withheld such as voting power during General Assemblies, less prioritization in the use of facilities and tambayan assignment)<br>

                            &nbsp;61-100&nbsp;>&nbsp;Full Accreditation for a year<br>

                            <blockquote><b>NOTE:</b> Newly established student organizations are given probationary status upon completion of the requirements (rights and privileges accorded to organizations with full accreditation are not yet granted such as voting power during General Assemblies, less prioritization in the use of facilities and tambayan assignment)</blockquote>
                            
                            <button class="btn btn-danger left-align" onclick="location.href = '<?php echo base_url(); ?>org/formA';">Proceed</button><br><br><br>
                            
                        </div>

                    </div>
                </div>
            </div>  
        </div>
        
    </div>

    </body>

</html>
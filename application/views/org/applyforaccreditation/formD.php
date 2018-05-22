<!DOCTYPE html>
<html>
    <head>
        <title>Form D: Officers' Profile</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sidenav.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/upload.css">

        <script>
            function openWin() {
                window.open("applyforaccreditation/formD.pdf"); //change location
            }
            function submitFormD(){
    $.ajax({
                type: "post",
                url :"<?php echo base_url(); ?>org/uploadFormD", 
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
                        <li class="active"><a href="<?php echo base_url(); ?>org/formD">Officers' Profile</a></li>
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
                        <li class="active"><a href="<?php echo base_url(); ?>org/formD">Officers' Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formE">Members' Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/plans">Plans</a></li>
                    </ul>
                    <?php } ?>
                <button class="submitAll" onclick="location.href = '<?php echo base_url(); ?>org/submitAll';">Submit All</button>
                </div>
            </div>
            <!-- Page Content -->
            <div class="main">
            <h1>Form D: Officers' Profile</h1>
                <object data="<?php echo base_url(); ?>org/viewFormD" type="pdf" width="100%" height="400">
                    <iframe src="<?php echo base_url(); ?>org/viewFormD" style="border: none;" width="100%" height="400">This browser does not support PDFs. Please download the PDF to view it: <a href="<?php echo base_url(); ?>org/formDpdf">Download PDF</a>
                    </iframe>
                </object>
                <br><br>
                <div class="myBtn">
                    <button class="btn btn-danger" onclick='submitFormD()'>Save</button><br><br>
                </div>
            </div>
        </div>
    </body>
</html>
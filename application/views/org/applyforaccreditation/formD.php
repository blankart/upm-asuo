<!DOCTYPE html>
<html>
    <head>
        <title>Form D: Officers' Profile</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/home.css">
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
                            swal({title: "Success!", text: "Form has been uploaded! You can preview your forms on the Checklist tab on your menu.", type: "success"},
                                function(){ 
                                     window.location.href = "<?php echo base_url(); ?>org/formE";
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
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formC';"><i style='float: left;'></i>Organization Profile</button>
                            <button class="btn btn-secondary btn-block active" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formD';"><i style='float: left;'></i>Officers' Profile</button>
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
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formC';"><i style='float: left;'></i>Organization Profile</button>
                            <button class="btn btn-secondary btn-block active" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formD';"><i style='float: left;'></i>Officers' Profile</button>
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
                           <h4 id="pd">Officers' Profile</h4> 
                        </div>

                        <div class="card-body" style='overflow-y: scroll;'>
                            <object data="<?php echo base_url(); ?>org/viewFormD" type="pdf" width="100%" height="400">
                                <iframe src="<?php echo base_url(); ?>org/viewFormD" style="border: none;" width="0%" height="0">This browser does not support PDFs. Please download the PDF to view it: <a href="<?php echo base_url(); ?>org/formDpdf" target="_blank">Download PDF</a>
                                </iframe>
                            </object>
                            <a href="<?php echo base_url(); ?>org/formDpdf" target="_blank">Preview Form D before uploading</a><br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>
  <!DOCTYPE html>
<html class="no-js">
	<head>
		<title>Form G: Financial Report</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/home.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/upload.css"/>
		<script src="<?php echo base_url();?>js/pdf.js"></script>
    	<script src="<?php echo base_url();?>js/pdf.worker.js"></script>
		<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>

		<script>
			$(document).ready(function(){
        		$('#uploadFormG').on("submit",function(e){
              e.preventDefault();
               		$.ajax({
                  		type: "post",
                  		url :"<?php echo base_url(); ?>org/uploadFormG", 
                  		async: false,
                  		cache: false,
                  		contentType: false,
                  		processData: false,
                  		data: new FormData(this),
                  		success : function (data){
                      		swal({title: "Success!", text: "Form has been uploaded! You can preview your forms on the Checklist tab on your menu.", type: "success"},
                        		function(){ 
                           			window.location.href = "<?php echo base_url(); ?>org/plans";
                        		}
                     		);
                  		},
                  		error: function(XMLHttpRequest, textStatus, errorThrown) { 
                     		//alert("Status: " + textStatus + " | Error: " + errorThrown); 
                     		swal("Error!", "Your file may be too large or not of valid type! (PDF only)", "error");
                  		}   
                 	});
        		});
      		});

			function _(x){
      			return document.getElementById(x);
    		}

		    function showPrev(){
      			_("cont1").style.display = "none";
      			_("cont2").style.display = "block";
    		}

    		function back(){
      			_("cont1").style.display = "block";
      			_("cont2").style.display = "none";
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
                        <div class="card-body">
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/applyforaccreditation';"><i style='float: left;'></i>Home</button>
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formA';"><i style='float: left;'></i>Accreditation Application</button> 
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formB';"><i style='float: left;'></i>Adviser's Consent</button>
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formC';"><i style='float: left;'></i>Organization Profile</button>
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formD';"><i style='float: left;'></i>Officers' Profile</button>
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formE';"><i style='float: left;'></i>Members' Profile</button>
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formF';"><i style='float: left;'></i>Activity Report</button>
                            <button class="btn btn-secondary btn-block active" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/formG';"><i style='float: left;'></i>Financial Report</button>
                            <button class="btn btn-secondary btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/plans';"><i style='float: left;'></i>Plans</button> 
                            <button class="btn btn-warning btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="location.href = '<?php echo base_url(); ?>org/submitAll';"><i style='float: left;'></i>Checklist</button> 
                        </div>
                    </div>
                </div>
            
      <!-- Page Content -->
               <div class="col-8">
                    <div class="card" style="box-shadow: 0 0 40px rgba(0,0,0,.2); height: 500px;">
                        <div class='card-header home-header'>
                           <h4 id="pd">Form G: Financial Report</h4> 
                        </div>

                        <div class="card-body">
                          <div class="content" id="cont1">
                            <div class="box">
                            <form enctype="multipart/form-data" method='POST' id='uploadFormG'>
                              <input type="file" name="formF" id="file-to-upload" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" accept="application/pdf" multiple/>
                              <label for="file-to-upload"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose a file&hellip;</span></label>                     
                              <br><br><br><br><br><br><br>
                
                              <div class="myBtn">
                                <button class="btn btn-danger" id="prevBtn" onclick="document.getElementById('submitFormG').click();">Upload</button> 

                              </div>
                            </div>
                          </div>
                      </form>
                        <p>&nbsp;&nbsp;For the document template, &nbsp; <a href="<?php echo base_url(); ?>assets/org/accreditation/form_G/formG_template.docx" download>Click Here.</a></p>
            
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
        <script src="<?php echo base_url();?>js/custom-file-input.js"></script>
      </div>
  </body>
</html>
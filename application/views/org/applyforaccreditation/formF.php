<?php
	$dbhandle = new mysqli('localhost','root','','asuo');
	echo $dbhandle->connect_error;

	$query = "SELECT * FROM organizationaccount";
	$res = $dbhandle->query($query);

	$row=$res->fetch_assoc();

?>
<script>
	  $(document).ready(function(){
	  	$('#uploadFormF').on("submit",function(e){
               e.preventDefault();
               $.ajax({
                  type: "post",
                  url :"<?php echo base_url(); ?>org/uploadFormF", 
                  async: false,
                  cache: false,
                  contentType: false,
                  processData: false,
                  data: new FormData(this),
                  success : function (data){
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
          });

	  });	
</script>
<!DOCTYPE html>
<html class="no-js">
	<head>
		<title>Form F: Projects</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sidenav.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/upload.css"/>
		<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
	</head>

	<body>
   		<div class="animated fadeIn" style="background-color: rgb(255,255,255); margin-top: 110px; margin-left: 22%; margin-right: 1%; padding-top: 10px; box-shadow: 0 0 40px rgba(0,0,0,.50); padding-bottom: 35px; border-radius: 10px;">
            <div class="col-4">
                <!-- insert sidenav -->
                <div class="sidenav">
                	<?php if($org_status == "Accredited"){ ?>
                    <li><a href="<?php echo base_url(); ?>org/applyforaccreditation">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formA">Accreditation Application</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formB">Consent of Adviser</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formC">Organization Profile</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formD">Officers' Profile</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formE">Members' Profile</a></li>
                    <li class="active"><a href="<?php echo base_url(); ?>org/formF">Projects</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formG">Financial Report</a></li>

                    <?php } else{ ?>
                    <li><a href="<?php echo base_url(); ?>org/applyforaccreditation">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formA">Accreditation Application</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formB">Consent of Adviser</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formC">Organization Profile</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formD">Officers' Profile</a></li>
                    <li><a href="<?php echo base_url(); ?>org/formE">Members' Profile</a></li>
                    <li class="active"><a href="<?php echo base_url(); ?>org/formF">Projects</a></li>
                    <?php } ?>

                </div>
            </div>
            <!-- Page Content -->
			<div class="main">
				<?php 
					if($row['org_status'] == "Unaccredited"){
						echo "<h1>Form F: Plans for the Academic Year</h1>";
					}
					else{
						echo "<h1>Form F: Activity Report of Previous Academic Year</h1>";
					}
				?>

			<!-- h1>Form F: Projects</h1-->
				<div class="content">
					<div class="box">
						<form enctype="multipart/form-data" method='POST' id='uploadFormF'>
						<input type="file" name="formF" id="ff" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
						<label for="ff"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose a file&hellip;</span></label>
					<br><br>
                    <button class="button"  id ='submitFormF' onclick="document.getElementById('submitFormF').click();">Upload</button>
					</div>
				</div>
			</div>
		</div>
		<script src="<?php echo base_url();?>js/custom-file-input.js"></script>
	</body>
</html>
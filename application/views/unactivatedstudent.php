
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta content="UPCS" name="author">
    <title>UP Organizations</title>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
	<script>
		function studNumFormatCheck(input) {

    var regex_num = new RegExp('^[0-9]*$');
    var value =  input.value;

    if( !regex_num.test(value) )
       input.setCustomValidity("Input numbers only!");
    else{

      var regex = new RegExp('^[0-9]{9}');   

      if( !regex.test(value) )
          input.setCustomValidity("UP Student Numbers are exactly 9 digits!");   
      else 
        input.setCustomValidity("");    
    }      
  } 

   function contactNumFormatCheck(input){

    var regex_num = new RegExp('^[0-9]*$');
    var value =  input.value;

    if( !regex_num.test(value) )
       input.setCustomValidity("Input numbers only!");
    else{

      var regex = new RegExp('^[0-9]{11}');   

      if( !regex.test(value) )
          input.setCustomValidity("Contact numbers are exactly 11 digits!");   
      else 
        input.setCustomValidity("");    
    }   
  }

  function addressFormatCheck(input){

        var regex = new RegExp("^[a-zA-Z0-9\.\,\'\-\#]+( [a-zA-Z0-9\.\,\'\-]+)*$");
        var value =  input.value;
        
        if( !regex.test(value) ) 
          input.setCustomValidity("Special characters other than ' - , . # and extra spaces are not allowed!");    
        else 
          input.setCustomValidity("");    
    }

     $(document).ready(function(){

        $('#uploadProfilePicture').on("submit",function(e){

               e.preventDefault();
               $.ajax({
                  type: "post",
                  url :"<?php echo base_url(); ?>student/uploadProfilePicture", 
                  async: false,
                  cache: false,
                  contentType: false,
                  processData: false,
                  data: new FormData(this),
                  success : function (data){
                      swal({title: "Success!", text: "You have successfully changed your profile picture!", type: "success"},
                        function(){ 
                           location.reload();
                        }
                     );
                  },
                  error: function(XMLHttpRequest, textStatus, errorThrown) { 
                     //alert("Status: " + textStatus + " | Error: " + errorThrown); 
                     swal("Error!", "Your image may be too large or not of valid type! (JPG only)", "error");
                  }   
            });
          });


         $('#uploadForm5Form').on("submit",function(e){

            e.preventDefault();
             $.ajax({
               type: "post",
               url :"<?php echo base_url(); ?>student/uploadForm5", 
               async: false,
               cache: false,
               contentType: false,
               processData: false,
               data: new FormData(this),
               success : function (data){
                   swal({title: "Success!", text: "You have successfully uploaded your Form 5!", type: "success"},
                     function(){ 
                         location.reload();
                     }
                  );
               },
               error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  //alert("Status: " + textStatus + " | Error: " + errorThrown); 
                   swal("Error!", "Your file may be too large or not of valid type!\nJPG files only!", "error");
               }   
            });
        });



         $('#editProfileForm').on("submit",function(e){

            e.preventDefault();
             $.ajax({
               type: "post",
               url :"<?php echo base_url(); ?>student/editStudentProfile", 
               async: false,
               cache: false,
               contentType: false,
               processData: false,
               data: new FormData(this),
               success : function (data){

                   swal({title: "Success!", text: "You have successfully updated your profile!", type: "success"},
                     function(){ 
                         location.reload();
                     }
                  );
               },
               error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  //alert("Status: " + textStatus + " | Error: " + errorThrown); 
                   swal("Error!", "Update unsuccessful !", "error");
               }   
            });
        });
      });


   function showPreview() {
      var preview = document.querySelector('img[alt=avatar]');
      var file    = document.querySelector('input[type=file]').files[0];
      var reader
	  = new FileReader();

      reader.onloadend = function () {
      preview.src = reader.result;
   }

      if (file) {
         reader.readAsDataURL(file);
      } else {
         preview.src = "";
      }
   }
   function validateForm(){
      if((document.profileForm.name.value == "") || (document.profileForm.year.value == "") || (document.profileForm.email.value == "") || (document.profileForm.course.value == "") || (document.profileForm.phone.value == "") || (document.profileForm.form5.value == "") || (document.profileForm.add.value == "") || (document.profileForm.dp.value == "")){
      }else{
         swalSucc();
      }
   }
   function swalSucc(){
      swal("Saved!", "You have updated your profile!", "success");
   }

   function noUploads(){
      swal("Failed!", "You have not uploaded any Form 5 yet!", "warning");
   }

   function preload(){
     document.getElementById("sex").value = "<?php echo $sex; ?>";
     document.getElementById('year_level').value = "<?php echo $year_level; ?>";
     document.getElementById('course').value = "<?php echo $course; ?>";
   }

   window.onload = preload
	</script>
	<div class="wrapper animated bounceIn" style="margin-top: 80px;">
					
		<div class="container-fluid" id="body-container-fluid">
			<div class="container">
				<!---- for body container ---->								
				<div class="jumbotron">
				<h3 class="display-1"><center><i class="fa fa-frown-o fa-2x"></i></h3>
				<h3 class="display-3"><center>Unactivated Account</h3>
				<p class="lower-case"><center>Admin Notice:</p>
				<div class="text-center">
               <form enctype="multipart/form-data" method="POST" id="uploadProfilePicture">
                  <img src="<?php echo base_url().'assets/student/profile_pic/'.$profile_pic.'?'.rand(1, 1000); ?>" class="avatar img-thumbnail" alt="avatar" height="500px"  width="500px">

                  <br><br>
                  <label id="prof_pic" style="margin-left: 20em; padding: 10px; background: #cc0000; display: table; color: white; font-family: Lato; border-radius: 5%;">Change Profile Picture
                  <input type="file" style="display: none;" onchange="document.getElementById('submitProfilePic').click();" class="form-control" id = 'profile_pic' name = 'profile_pic'>
                   </label>

                  <button type="submit" style="display: none;" id = 'submitProfilePic'> </button>
               </form>
            </div>

            <form method="POST" id="editProfileForm">

               <div class="form-group">
                  <label class="col-lg control-label">Name</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" value = "<?php echo $first_name.' '.$middle_name.' '.$last_name; ?>" readonly required>
                </div>
               </div>

               <div class="form-group">
                  <label class="col-lg control-label">UP Mail</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" value = "<?php echo $up_mail; ?>"  required readonly>
                  </div>
               </div>

               <div class="form-group">
                  <label class="col-lg control-label">Student Number</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" maxlength="9" name="data[up_id]" value = "<?php echo $up_id; ?>" onkeyup="studNumFormatCheck(this)" required>
                  </div>
               </div>


                 <div class="form-group">
                  <label class="col-lg control-label">Course</label>
                  <div class="col-lg">
                       <select class="form-control" id="course" name="data[course]" required>
                        <option>BA Behavioral Sciences</option>
                        <option>BA Development Studies</option>
                        <option>BA Organizational Communication</option>
                        <option>BA Philippine Arts</option>
                        <option>BA Political Science</option>
                        <option>BA Social Sciences</option>
                        <option>BS Applied Physics</option>
                        <option>BS Biochemistry</option>
                        <option>BS Biology</option>
                        <option>BS Computer Science</option>
                        <option>BS Industrial Pharmacy</option>
                        <option>BS Nursing</option>
                        <option>BS Occupational Therapy</option>
                        <option>BS Pharmacy</option>
                        <option>BS Physical Therapy</option>
                        <option>BS Public Health</option>
                        <option>BS Speech Pathology</option>
                        <option>D Dental Medicine</option>
                        <option>D Medicine</option>
                        <option>Intarmed</option>
                        <option>Not Applicable</option>
                     </select>
                  </div>
               </div>

               <div class="form-group">
                  <label class="col-lg control-label">Year Level</label>
                  <div class="col-lg">
                     <select class="form-control" id="year_level" name="data[year_level]" required>
                        <option>1st Year</option>
                        <option>2nd Year</option>
                        <option>3rd Year</option>
                        <option>4th Year</option>
                        <option>5th Year</option>
                        <option>6th Year</option>
                        <option>7th Year</option>
                        <option>Masteral</option>
                        <option>Doctoral</option>
                     </select>
                  </div>
               </div>  

               <div class="form-group">
                  <label class="col-lg control-label">Sex</label>
                  <div class="col-lg">
                     <select class="form-control" id="sex" name="data[sex]" required>
                        <option>Male</option>
                        <option>Female</option>
                     </select>
                  </div>
               </div>           

               <div class="form-group">
                  <label class="col-lg control-label">Birthday</label>
                  <div class="col-lg">
                     <input class="form-control" type="date" name="data[birthday]" value = "<?php echo $birthday; ?>"  required>
                  </div>
               </div>

               <div class="form-group">
                  <label class="col-lg control-label">Address</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" maxlength="100" name="data[address]" value = "<?php echo $address; ?>" onkeyup="addressFormatCheck(this)" required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Phone</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" maxlength="11" name="data[contact_num]" value = "<?php echo $contact_num; ?>" onkeyup="contactNumFormatCheck(this)" required>
                  </div>
               </div>
         </div>
         <!-- Modal footer -->
         <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="submit" onclick="validateForm()" class="btn btn-danger">Save</button>
      </form>
         </div>
			<div class="form-group">
               <form enctype="multipart/form-data" id= 'uploadForm5Form' method="POST">
                 <div class="form-group">
                  <label id="form5Label" style="margin-left: 1em; padding: 10px; background: #cc0000; display: table; color: white; font-family: Lato; border-radius: 5%;">Upload Form 5
                     <input type="file" style="display: none;" class="form-control" id = 'form5' name = 'form5' onchange="document.getElementById('submitForm5').click();"></label>

                  <button type="button" class="btn btn-primary" style="margin-left: 1em" onclick="
                  <?php if ($form5 != "None"){ ?>
                     window.open('<?php echo base_url()."assets/student/form_5/".$form5; ?>') 
                  <?php }else { ?> 
                     noUploads() 
                  <?php } ?>" > Preview File</button>
                  <button type="submit" style="display: none;" id = 'submitForm5'> </button>
               </div>
            </form>
      </div>
					<a  href="<?php echo base_url().'logout'; ?>"><button type="button" class="btn btn-danger">Log Out</button></a>
				</div>	
 			</div>
		</div>
	</div>
</body>
</html>
	
<script>

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
</script>

<div class="modal animated bounceInUp" id="editProfile" data-backdrop="false" data-keyboard="false">
   <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title">Edit Profile</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body" style="height: 450px; overflow-y: auto;">

            <div class="text-center">
               <form enctype="multipart/form-data" method="POST" id="uploadProfilePicture">
                  <img src="<?php echo base_url().'assets/student/profile_pic/'.$profile_pic.'?'.rand(1, 100); ?>" class="avatar img-thumbnail" alt="avatar" height="500px"  width="500px">

                  <br><br>
                  <label id="prof_pic" style="margin-left: 20em; padding: 10px; background: #cc0000; display: table; color: white; font-family: Lato; border-radius: 5%;">Change Profile Picture
                  <input type="file" style="display: none;" onchange="document.getElementById('submitProfilePic').click();" class="form-control" id = 'profile_pic' name = 'profile_pic'>
                   </label>

                  <button type="submit" style="display: none;" id = 'submitProfilePic'> </button>
               </form>
            </div>

               <div class="form-group">
                  <label class="col-lg control-label">Name</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" name="name" value = "<?php echo $first_name.' '.$middle_name.' '.$last_name; ?>" readonly required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Year</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" name="data[year]" value = "<?php echo $year_level; ?>" readonly required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Course</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" name="data[course]" value = "<?php echo $course; ?>" required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Address</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" name="data[address]" value = "<?php echo $address; ?>" required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Phone</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" name="data[contact_num]" value = "<?php echo $contact_num; ?>" required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Email</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" name="est" value = "<?php echo $up_mail; ?>"  required readonly>
                  </div>
               </div>
         </div>
         <!-- Modal footer -->
         <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="submit" onclick="validateForm()" class="btn btn-danger">Save</button>
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
   </div>
</div>

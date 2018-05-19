<script>
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
            <form class="form-horizontal" role="form" name="profileForm">
            <div class="text-center">
               <img src="" class="avatar img-thumbnail" alt="avatar" height="200px">
               <h6>Upload profile picture.</h6>
               <input type="file" style="text-align: center;" onchange="showPreview()" class="form-control text-center" style="width: 250px" id="dp" required>
            </div>
               <div class="form-group">
                  <label class="col-lg control-label">Name</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" name="name" readonly required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Year</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" name="Year" readonly required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Course</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" name="course" required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Address</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" name="add" required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Phone</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" name="phone" required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Email</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" name="est" required readonly>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Upload Form5</label>
                  <div class="col-lg">
                     <input type="file" class="form-control" name="form5" style="width: 250px" required>
                  </div>
               </div>
         </div>
         <!-- Modal footer -->
         <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="submit" onclick="validateForm()" class="btn btn-danger">Save</button>
         </div>
         </form>
			<div class="form-group">
                  <label id="form5" style="margin-left: 1em; padding: 10px; background: #cc0000; display: table; color: white; font-family: Lato; border-radius: 5%;">Upload Form 5<input type="file" style="display: none;" class="form-control" id = 'form5' name = 'formFive' onchange="document.getElementById('submitForm5').click();"></label>
                  <button type="button" class="btn btn-info" style="margin-left: 1em"; id='previewForm5'>Preview File</button>
                  <button type="submit" style="display: none;" id = 'submitForm5'> </button>
               </div>
      </div>
   </div>
</div>

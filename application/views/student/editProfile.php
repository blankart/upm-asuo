<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/my-login.css">
<link rel="stylesheet" type="text/css" href="../css/animations.css">
<link rel="stylesheet" type="text/css" href="../css/material-search.css">
<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">



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
            <div class="text-center">
               <form enctype="multipart/form-data"  method="POST" id="changeLogoForm">
                  <img src="" class="avatar img-thumbnail" alt="avatar" height="500px"  width="500px">
                  <br><br>
                  <label id="orgLogo" style="margin-left: 20em; padding: 10px; background: #cc0000; display: table; color: white; font-family: Lato; border-radius: 5%;">Upload Logo<input type="file" style="display: none;" onchange="" class="form-control" id = 'profilePic' name = 'profilePic'></label>
                  <button type="submit" style="display: none;" id = 'submitLogo'> </button>
              </form>
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
         </div>
         <!-- Modal footer -->
         <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="submit" onclick="validateForm()" class="btn btn-danger">Save</button>
         </div>
         </form>
         <form enctype="multipart/form-data" id= 'uploadForm5' method="POST">
                 <div class="form-group">
                  <label id="consti" style="margin-left: 1em; padding: 10px; background: #cc0000; display: table; color: white; font-family: Lato; border-radius: 5%;">Upload Constitution<input type="file" style="display: none;" class="form-control" id = 'form5' name = 'fomr5' onchange=""></label>
                  <button type="button" class="btn btn-primary" style="margin-left: 1em" onclick="" > Preview File</button>
                  <button type="submit" style="display: none;" id = 'submitForm5'> </button>
               </div>
            </form>
      </div>
   </div>
</div>

<script src="../js/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../js/my-login.js"></script>
<script src="../js/jquery-3.3.1.js"></script>

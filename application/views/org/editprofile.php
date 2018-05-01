<script>
   function validateForm(){
      if((document.profileForm.orgname.value == "") || (document.profileForm.acronym.value == "") || (document.profileForm.email.value == "") || (document.profileForm.est.value == "") || (document.profileForm.page.value == "") || (document.profileForm.members.value == "") || (document.profileForm.consti.value == "") || (document.getElementById("objectives").value == "") || (document.getElementById("descrip").value == "")) {
      }else{
         swalSucc();
      }
   }
   function swalSucc(){
      swal("Saved!", "You have updated your profile!", "success");
   }
</script>
<div class="modal animated bounceInUp" id="editprofile" data-backdrop="static" data-keyboard="false">
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
               <img src="//placehold.it/100" class="avatar img-thumbnail" alt="avatar" style="border-radius: 50%">
               <h6>Upload organization logo.</h6>
               <input type="file" style="text-align: center;" class="form-control text-center" style="width: 250px">
            </div>
            <form class="form-horizontal" role="form" name="profileForm">
               <div class="form-group">
                  <label class="col-lg control-label">Organization Name</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" name="orgname" readonly required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Acronym</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" name="acronym">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Mailing Address</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" name="mAdd">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">E-mail</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" name="email" readonly required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Website/Page</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" name="page" required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Date Established</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" name="est" required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Total Number of Members</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" name="members" readonly required>
                  </div>
               </div>
               <br>
               <div class="form-group text-center">
                  <table id="memberDistribution" class="table table-bordered">
                     <thead><b>Membership Distribution</b></thead>
                     <tbody>
                        <tr>
                           <td></td>
                           <td>First Year</td>
                           <td>Second Year</td>
                           <td>Third Year</td>
                           <td>Fourth Year</td>
                           <td>Masteral</td>
                           <td>Doctoral</td>
                           <td>Total</td>
                        </tr>
                        <tr>
                           <td>Male</td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                        <tr>
                           <td>Female</td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                        <tr>
                           <td>Total</td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <br>
               <div class="form-group">
                  <label class="col-lg control-label"><b>Is your organization incorporated with the Securities and Exchange Commission(SEC)?</b></label>
                  <div class="col-lg">
                     <input type="radio" id="yes">Yes
                     <br>
                     <input type="radio" id="no">No
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Upload constitution</label>
                  <div class="col-lg">
                     <input type="file" class="form-control" name="consti" style="width: 250px" required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Objectives of Organization</label>
                  <div class="col-lg">
                     <textarea class="form-control" rows="3" id="objectives" required></textarea>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Brief Description of Organization</label>
                  <div class="col-lg">
                     <textarea class="form-control" rows="3" id="descrip" required></textarea>
                  </div>
               </div>
         </div>
         <!-- Modal footer -->
         <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="submit" onclick="validateForm()" class="btn btn-danger">Save</button>
         </div>
         </form>
      </div>
   </div>
</div>
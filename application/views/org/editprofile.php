<?php

   if($this->session->userdata['account_type'] == 'org'){
      $id = $this->session->userdata['user_id'];
   }

?>
<script>


   function showPreview() {
  var preview = document.querySelector('img[alt=avatar]');
  var file    = document.querySelector('input[type=file]').files[0];
  var reader  = new FileReader();

  reader.onloadend = function () {
    preview.src = reader.result;
  }

  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = "";
  }
}
   $(document).ready(function(){
        $("#saveChangesButton").click(function(){
              editProfile();
        });
      });

   function incSEC(){
      var incSEC = "<?php echo $profile['incSEC']; ?>"

      if(incSEC == 1)
         document.getElementById("yes").checked = true;
      else
         document.getElementById("no").checked = true;  
   }

   function swalSucc(){
      swal("Saved!", "You have updated your profile!", "success");
   }

   function swalFail(){
      swal("Failed!", "You cannot updated your profile now!", "error");
   }


   function editProfile(){
      var org_id = '<?php echo $id; ?>';
      var acronym = (document.getElementsByName("acronym")[0].value).trim();
      var mailing_address = (document.getElementsByName("mailing_address")[0].value).trim();
      var org_website = (document.getElementsByName("org_website")[0].value).trim();
      var date_established = (document.getElementsByName("date_established")[0].value).trim();
      var objectives = (document.getElementsByName("objectives")[0].value).trim();
      var description = (document.getElementsByName("description")[0].value).trim();

      if(document.getElementsByName("incSEC")[0].checked)
         var incSEC = 1
      else
         var incSEC = 0;

      if(org_id == "" || acronym == "" || mailing_address == "" || org_website == "" || date_established == "" || objectives == "" || description == ""){
            //error, empty field found
      }
      else{
         var orgdata = {
            acronym: acronym, 
            org_website: org_website,
            date_established: date_established,
            mailing_address: mailing_address,
            description: description, 
            objectives: objectives,
            incSEC: incSEC     
         };
        // alert(JSON.stringify(orgdata));

         $.ajax({
            type:"post",
            url:"<?php echo base_url(); ?>org/editOrgProfile",
            cache: false,
            async: false,
            data:{org_id: org_id, data: orgdata},
            dataType: 'json',
            success:function(result){
               swalSucc();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
               alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }   
         });
      }
   }

   function changeLogo(){

      $.ajax({
         type: "post",
         url :"<?php echo base_url(); ?>org/changeLogo", 
         async: false,
         cache: false,
         contentType: false,
         processData: false,
         data: {source: 'org', data: formData},
         success : function (data, status){
            alert(data.msg);
         },
         error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus + " | Error: " + errorThrown); 
         }   
      });
   }


   window.onload = incSEC;
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
               <form enctype="multipart/form-data"  method="POST" action="">
                  <img src="<?php echo base_url().'assets/org/logo/'.$profile['org_logo']; ?>" class="avatar img-thumbnail" alt="avatar" height="500px"  width="500px">
                  <h6>Upload organization logo.</h6>
                  <input type="file" style="text-align: center;" onchange="showPreview()" class="form-control text-center" style="width: 250px" id = 'logo' name = 'logo'>
              </form>
            </div>

            <form class="form-horizontal" role="form" name="profileForm" id ="orgprofile">
               <div class="form-group">
                  <label class="col-lg control-label">Organization Name</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" value ="<?php echo $profile['org_name']; ?>" readonly required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Acronym</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" value ="<?php echo $profile['acronym']; ?>" name="acronym">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Mailing Address</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" value ="<?php echo $profile['mailing_address']; ?>" name="mailing_address">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">E-mail</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" value ="<?php echo $profile['org_email']; ?>" readonly required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Website/Page</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" value ="<?php echo $profile['org_website']; ?>" name="org_website" required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Date Established</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" value ="<?php echo $profile['date_established']; ?>" name="date_established" required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Total Number of Members</label>
                  <div class="col-lg">
                     <input class="form-control" type="text" name="members" value = "<?php echo $tally['female_first'] + $tally['female_second'] + $tally['female_third'] + $tally['female_fourth'] + $tally['female_masteral'] + $tally['female_doctoral'] + $tally['male_first'] + $tally['male_second'] + $tally['male_third'] + $tally['male_fourth']+ $tally['male_masteral'] + $tally['male_doctoral']; ?>" readonly required>
                  </div>
               </div>
               <br>
               <div class="form-group text-center">
                  <table id="memberDistribution" class="table table-bordered">
                     <thead><b>Membership Distribution</b></thead>
                     <tbody>
                        <tr>
                           <td></td>
                           <td><b>First Year</b></td>
                           <td><b>Second Year</b></td>
                           <td><b>Third Year</b></td>
                           <td><b>Fourth Year</b></td>
                           <td><b>Masteral</b></td>
                           <td><b>Doctoral</b></td>
                           <td><b>Total</b></td>
                        </tr>
                        <tr>
                           <td><b>Male</b></td>
                           <td><?php echo $tally['male_first']; ?></td>
                           <td><?php echo $tally['male_second']; ?></td>
                           <td><?php echo $tally['male_third']; ?></td>
                           <td><?php echo $tally['male_fourth']; ?></td>
                           <td><?php echo $tally['male_masteral']; ?></td>
                           <td><?php echo $tally['male_doctoral']; ?></td>
                           <td><?php echo $tally['male_first'] + $tally['male_second'] + $tally['male_third'] + $tally['male_fourth'] + $tally['male_masteral'] + $tally['male_doctoral']; ?></td>
                        </tr>
                        <tr>
                           <td><b>Female</b></B></td>
                           <td><?php echo $tally['female_first']; ?></td>
                           <td><?php echo $tally['female_second']; ?></td>
                           <td><?php echo $tally['female_third']; ?></td>
                           <td><?php echo $tally['female_fourth']; ?></td>
                           <td><?php echo $tally['female_masteral']; ?></td>
                           <td><?php echo $tally['female_doctoral']; ?></td>
                           <td><?php echo $tally['female_first'] + $tally['female_second'] + $tally['female_third'] + $tally['female_fourth'] + $tally['female_masteral'] + $tally['female_doctoral']; ?></td>
                        </tr>
                        <tr>
                           <td><b>Total</b></td>
                           <td><?php echo $tally['male_first'] + $tally['female_first']; ?></td>
                           <td><?php echo $tally['male_second'] + $tally['female_second']; ?></td>
                           <td><?php echo $tally['male_third'] + $tally['female_third']; ?></td>
                           <td><?php echo $tally['male_fourth'] + $tally['female_fourth']; ?></td>
                           <td><?php echo $tally['male_masteral'] + $tally['female_masteral']; ?></td>
                           <td><?php echo $tally['male_doctoral'] + $tally['female_doctoral']; ?></td>
                           <td><?php echo $tally['female_first'] + $tally['female_second'] + $tally['female_third'] + $tally['female_fourth'] + $tally['female_masteral'] + $tally['female_doctoral'] +  $tally['male_first'] + $tally['male_second'] + $tally['male_third'] + $tally['male_fourth'] + $tally['male_masteral'] + $tally['male_doctoral']; ?></td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <br>
           
               <div class="form-group">
                  <label class="col-lg control-label">Objectives of Organization</label>
                  <div class="col-lg">
                     <textarea class="form-control" rows="3" id="objectives" name='objectives' required><?php echo $profile['objectives']; ?></textarea>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label">Brief Description of Organization</label>
                  <div class="col-lg">
                     <textarea class="form-control" rows="3" id="descrip" name='description' required><?php echo $profile['description']; ?></textarea>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg control-label"><b>Is your organization incorporated with the Securities and Exchange Commission(SEC)?</b></label>
                  <div class="col-lg" value ='yes'>
                     <input type="radio" id="yes" name ="incSEC">Yes
                     <br>
                     <input type="radio" id="no" name ="incSEC">No
                  </div>
               </div>
                <div class="form-group">
                  <label class="col-lg control-label">Upload constitution</label>
                  <div class="col-lg">
                     <input type="file" class="form-control" name="consti" style="width: 250px" required>
                  </div>
               </div>
         </div>
         <!-- Modal footer -->
         <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="button" id="saveChangesButton" class="btn btn-danger">Save</button>
         </div>
         </form>

         
      </div>
   </div>
</div>
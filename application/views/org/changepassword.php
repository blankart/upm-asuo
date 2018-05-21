x`<?php
   if (isset($this->session->userdata['logged_in'])) {
    $id = ($this->session->userdata['user_id']);
   }
   ?>
    <script>
      $(document).ready(function(){
        $("#changeorgpwbutton").click(function(){
          if ($("#conPass").val()=="" || $("#newPass").val()=="" || $("#currentPass").val()=="" )
          {
            $("#orgAlert").addClass('notice notice-sm notice-danger');
            $("#orgAlert").html('<strong>Error: </strong>Required field(s) below.');
            $("#orgAlert").slideDown(400);
          }
          else
          {
            
          }



        });
      });
        function passwordMatch(orgID)
           {
            if ($("#conPass").val()!="" && $("#newPass").val()!="")
            {
              if ($("#newPass").val().length < 7 || $("#newPass").val().length > 32 || $("#conPass").val().length < 7 || $("#conPass").val().length > 32){
                $("#newPass").addClass("is-valid animated fadeIn");
                $("#newPass").addClass("is-invalid animated fadeIn");
                $("#conPass").addClass("is-valid animated fadeIn");
                $("#conPass").addClass("is-invalid animated fadeIn");
                $("#conPassAlert").removeClass();
                $("#conPassAlert").html('');
                $("#conPassAlert").addClass('notice notice-sm notice-danger');
                $("#conPassAlert").html('<strong>Error: </strong>Please lengthen this text to 7 characters or more.');
                $("#conPassAlert").slideDown(400);
              }
              else if ($("#newPass").val() != $("#conPass").val())
              {
                $("#newPass").addClass("is-valid animated fadeIn");
                $("#newPass").addClass("is-invalid animated fadeIn");
                $("#conPass").addClass("is-valid animated fadeIn");
                $("#conPass").addClass("is-invalid animated fadeIn");
                $("#conPassAlert").removeClass();
                $("#conPassAlert").html('');
                $("#conPassAlert").addClass('notice notice-sm notice-danger');
                $("#conPassAlert").html('<strong>Error: </strong>Password do not match.');
                $("#conPassAlert").slideDown(400);
              }
              else if ($("#newPass").val() == $("#conPass").val())
              {
                $("#newPass").removeClass("is-invalid");
                $("#newPass").addClass("is-valid animated fadeIn");
                $("#conPass").removeClass("is-invalid");
                $("#conPass").addClass("is-valid animated fadeIn");
                $("#conPassAlert").fadeOut();
                $("#conPassAlert").html('');
                $('#changeorgpwbutton').click(function(){
                  var orgpassword = $('#currentPass').val();
                  
                  $.ajax({
                    type:"post",
                    url:"<?php echo base_url(); ?>org/checkOrgPassword",
                    cache: false,
                    data:{id: orgID, orgpassword: orgpassword},
                    dataType: 'json',
                    async: false,
                    success:function(result){
                 
                      if (result == true)
                      {
                        $("#orgAlert").fadeOut();
                        swal({
                        html: true,
                        title: "<h4>Change Password</h4>",
                        text: "Do you want to change your password?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Change Password",
                        closeOnConfirm: false
                        }, function () 
                        {
                          swal("Password Changed!", "Your password has been changed.", "success");
                          var neworgpassword = $("#newPass").val();

                          $.ajax({
                            type:"post",
                            url:"<?php echo base_url(); ?>org/changeOrgPassword",
                            cache: false,
                            data:{id: orgID, neworgpassword: neworgpassword},
                            dataType: 'json',
                            async: false,
                            success:function(result){
                              resetOrgChangePasswordFields();
                            }
                          });
                
                      });
                    }
                    else
                    {
                      if (orgpassword == "")
                      {
                        $("#orgAlert").addClass("notice notice-sm notice-danger");
                        $("#orgAlert").html('<strong>Error: </strong>Required field(s) below.');
                        $("#orgAlert").slideDown(400);
                      }
                      else
                      {
                        $("#orgAlert").addClass("notice notice-sm notice-danger");
                        $("#orgAlert").html('<strong>Error: </strong>Your current password does not match.');
                        $("#orgAlert").slideDown(400);
                      }
              
                    }
                  } //end of swal success function 
                 });


                }); //end of changeorgpwbutton function
              }
            }
            else { 
              
            }    
           }

           function resetOrgChangePasswordFields(){
            document.getElementById("currentPass").value = "";
            document.getElementById("newPass").value = "";
            document.getElementById("conPass").value = "";
       
           }
    </script>
    <div class="modal animated bounceInUp" id="changeorgpassword" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" style="min-width: 200px;">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Change Password</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                  <p class="form-text text-muted">If your old password was compromised, make sure that your new password is very different from your old one.</p>
                    <div id="orgAlert" style="display: none;">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Current Password</label>
                        <div class="controls">
                            <input type="password" minlength="7" maxlength="32" class="form-control input-sm" id="currentPass" required>
                        </div>
                        <div id="curPassAlert" style="display: none;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">New Password</label>
                        <div class="controls">
                            <input type="password" minlength="7" maxlength="32" onblur="passwordMatch('<?php echo $id ?>')" class="form-control input-sm" id="newPass" required>
                    </div>
                    </div>
                        <div id="newPassAlert" style="display: none;">
                        </div>
                    <div class="form-group">
                        <label class="control-label">Confirm Password</label>
                        <div class="controls">
                            <input type="password" minlength="7" maxlength="32" onblur="passwordMatch('<?php echo $id ?>')" class="form-control input-sm" id="conPass" required>
                    </div>
                    </div>
                        <div id="conPassAlert" style="display: none;">
                        </div>
                    <!-- Modal footer -->
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-default" onclick="resetOrgChangePasswordFields()" data-dismiss="modal">Close</button>
                        <button type="button" id="changeorgpwbutton" class="btn btn-danger">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
   if (isset($this->session->userdata['logged_in'])) {
     if($this->session->userdata['account_type'] == 'student'){
       $first_name = ($this->session->userdata['first_name']);
       $username = ($this->session->userdata['username']);
     }
     if($this->session->userdata['account_type'] == 'admin'){
       $username = ($this->session->userdata['username']);
       $id = ($this->session->userdata['admin_id']);
     }
   }
   ?>
    <script>
      $(document).ready(function(){
        $("#changeadminpwbutton").click(function(){
          if ($("#conPass").val()=="" || $("#newPass").val()=="" || $("#currentPass").val()=="" )
          {
            $("#adminAlert").addClass('notice notice-sm notice-danger');
            $("#adminAlert").html('<strong>Error: </strong>Required field(s) below.');
            $("#adminAlert").slideDown(400);
          }
          else
          {
            
          }



        });
      });
        function passwordMatch(adminID)
           {
            if ($("#conPass").val()!="" && $("#newPass").val()!="")
            {
              if ($("#newPass").val() != $("#conPass").val())
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
                $('#changeadminpwbutton').click(function(){
                  var adminpassword = $('#currentPass').val();
                  $.ajax({
            type:"post",
            url:"<?php echo base_url(); ?>admin/checkAdminPassword",
            cache: false,
            data:{id: adminID, adminpassword: adminpassword},
            dataType: 'json',
            async: false,
            success:function(result){
            if (result == true)
            {
              $("#adminAlert").fadeOut();
              swal({
               html: true,
               title: "<h4>Change Password</h4>",
               text: "Do you want to change your password?",
               type: "warning",
               showCancelButton: true,
           confirmButtonClass: "btn-danger",
           confirmButtonText: "Change Password",
           closeOnConfirm: false
             }, function () {
              swal("Password Changed!", "Your password has been changed.", "success");
               var newadminpassword = $("#newPass").val();
              $.ajax({
            type:"post",
            url:"<?php echo base_url(); ?>admin/changeAdminPassword",
            cache: false,
            data:{id: adminID, newadminpassword: newadminpassword},
            dataType: 'json',
            async: false,
            success:function(result){
              resetAdminChangePasswordFields();
           }
           });
        
           });
              
            }
            else
            {
              if (adminpassword == "")
              {
                $("#adminAlert").addClass("notice notice-sm notice-danger");
                $("#adminAlert").html('<strong>Error: </strong>Required field(s) below.');
                $("#adminAlert").slideDown(400);
              }
              else
              {
                $("#adminAlert").addClass("notice notice-sm notice-danger");
                $("#adminAlert").html('<strong>Error: </strong>Your current password does not match.');
                $("#adminAlert").slideDown(400);
              }
              
            }
           }
           });
                });
              }
            }
            else { 
              
            }    
           }

           function resetAdminChangePasswordFields(){
            document.getElementById("currentPass").value = "";
            document.getElementById("newPass").value = "";
            document.getElementById("conPass").value = "";
            //$("#newPass").val() = "";
            //$("#conPass").val() = "";
           }
    </script>
    <div class="modal animated bounceInUp" id="changeadminpassword" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" style="min-width: 200px;">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Change Password</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="adminAlert" style="display: none;">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Current Password</label>
                        <div class="controls">
                            <input type="password" class="form-control input-sm" id="currentPass" required>
                        </div>
                        <div id="curPassAlert" style="display: none;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">New Password</label>
                        <div class="controls">
                            <input type="password" onblur="passwordMatch('<?php echo $id?>')" class="form-control input-sm" id="newPass" required>
                    </div>
                    </div>
                        <div id="newPassAlert" style="display: none;">
                        </div>
                    <div class="form-group">
                        <label class="control-label">Confirm Password</label>
                        <div class="controls">
                            <input type="password" onblur="passwordMatch('<?php echo $id?>')" class="form-control input-sm" id="conPass" required>
                    </div>
                    </div>
                        <div id="conPassAlert" style="display: none;">
                        </div>
                    <!-- Modal footer -->
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-default" onclick="resetAdminChangePasswordFields()" data-dismiss="modal">Close</button>
                        <button type="button" id="changeadminpwbutton" class="btn btn-danger">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
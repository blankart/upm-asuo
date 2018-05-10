<?php
   if (isset($this->session->userdata['logged_in'])) {
    $id = ($this->session->userdata['user_id']);
   }
   ?>
    <script>
      $(document).ready(function(){
        $("#changestudentpwbutton").click(function(){
          if ($("#conPass").val()=="" || $("#newPass").val()=="" || $("#currentPass").val()=="" )
          {
            $("#studentAlert").addClass('notice notice-sm notice-danger');
            $("#studentAlert").html('<strong>Error: </strong>Required field(s) below.');
            $("#studentAlert").slideDown(400);
          }
          else
          {
            
          }



        });
      });
        function passwordMatch(studentID)
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
                $('#changestudentpwbutton').click(function(){
                  var studentpassword = $('#currentPass').val();
                  
                  $.ajax({
                    type:"post",
                    url:"<?php echo base_url(); ?>student/checkStudentPassword",
                    cache: false,
                    data:{id: studentID, studentpassword: studentpassword},
                    dataType: 'json',
                    async: false,
                    success:function(result){
                 
                      if (result == true)
                      {
                        $("#studentAlert").fadeOut();
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
                          var newstudentpassword = $("#newPass").val();

                          $.ajax({
                            type:"post",
                            url:"<?php echo base_url(); ?>student/changeStudentPassword",
                            cache: false,
                            data:{id: studentID, newstudentpassword: newstudentpassword},
                            dataType: 'json',
                            async: false,
                            success:function(result){
                              resetStudentChangePasswordFields();
                            }
                          });
                
                      });
                    }
                    else
                    {
                      if (studentpassword == "")
                      {
                        $("#studentAlert").addClass("notice notice-sm notice-danger");
                        $("#studentAlert").html('<strong>Error: </strong>Required field(s) below.');
                        $("#studentAlert").slideDown(400);
                      }
                      else
                      {
                        $("#studentAlert").addClass("notice notice-sm notice-danger");
                        $("#studentAlert").html('<strong>Error: </strong>Your current password does not match.');
                        $("#studentAlert").slideDown(400);
                      }
              
                    }
                  } //end of swal success function 
                 });


                }); //end of changestudentpwbutton function
              }
            }
            else { 
              
            }    
           }

           function resetStudentChangePasswordFields(){
            document.getElementById("currentPass").value = "";
            document.getElementById("newPass").value = "";
            document.getElementById("conPass").value = "";
       
           }
    </script>
    <div class="modal animated bounceInUp" id="changestudentpassword" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" style="min-width: 200px;">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Change Password</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="studentAlert" style="display: none;">
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
                        <button type="button" class="btn btn-default" onclick="resetStudentChangePasswordFields()" data-dismiss="modal">Close</button>
                        <button type="button" id="changestudentpwbutton" class="btn btn-danger">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
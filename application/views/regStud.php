<script>
	function UPMailChecker(){
        var up_mail = ($("#up_mail").val()).trim();
        var checker = false;

    if (up_mail.length>0)
    {
        //AJAX IF EXISTING YUNG EMAIL
        //alert(org_email);
        $.ajax({
       type:"post",
       url:"",
       cache: false,
       data:{up_mail: up_mail},
       dataType: 'json',
       async: false,
       success:function(result)
       {
            //alert(JSON.stringify (result));
            if(result == true)
            {
                $("#UPMailTaken").removeClass();
                $("#UPMailTaken").html('');
                $("#UPMailTaken").addClass('notice notice-sm notice-danger');
                $("#UPMailTaken").html('<strong>Error:</strong> This email address is already linked to another account. For more info, visit OSA.');
                $("#UPMailTaken").slideDown(400);   
                return false;
            }
            else if(result == false)
            {
               // alert("Abc");
                $("#UPMailTaken").fadeOut(400);
                checker = true;
                return true;
            }
            
       }

    });

    }
    return checker;
    
}

	function conPassValidate()
{
    var conPass = $("#conPass").val();
    var Pass = $("#Pass").val();
    if (conPass!=Pass && $("#conPass").val().length > 0 && $("#Pass").val().length > 0){
        $("#studPwChecker").removeClass();
        $("#studPwChecker").html('');
        $("#studPwChecker").addClass('notice notice-sm notice-danger');
        $("#studPwChecker").html('<strong>Error:</strong> Password does not match.');
        $("#studPwChecker").slideDown(400);
        return false;
    }
    else if(conPass==Pass && $("#conPass").val().length > 0 && $("#Pass").val().length > 0){
        //alert("tasdasd");
        $("#studPwChecker").fadeOut(400);
        return true;
    }

}

function validateForm(){
    resetErrorDisplays();

    if (conPassValidate())
    {
        
        var first_name = (document.getElementById("first_name").value).trim();
        var middle_name = (document.getElementById("middle_name").value).trim();
        var last_name = (document.getElementById("last_name").value).trim();
        var up_id = (document.getElementById("up_id").value).trim();
        var contact_num = (document.getElementById("contact_num").value).trim();
        var mailing_address = (document.getElementById("mailing_address").value).trim();


        if(first_name == '' || middle_name == '' || last_name == '' || up_id == '' || contact_num == '' || mailing_address == ''){

            if(first_name == '' || middle_name == '' || last_name == '' ){
                $("#nameInvalidInput").addClass('notice notice-sm notice-danger');
                $("#nameInvalidInput").html('<strong>Error:</strong> Organizaton Name field is empty!');
                $("#nameInvalidInput").slideDown(400);   
            }

            if(up_id == ""){
                $("#StudNumInvalidInput").addClass('notice notice-sm notice-danger');
                $("#StudNumInvalidInput").html('<strong>Error:</strong> Organization Website field is empty!');
                $("#StudNumInvalidInput").slideDown(400);  
            }

            if(contact_num == ""){
                $("#NumInvalidInput").addClass('notice notice-sm notice-danger');
                $("#NumInvalidInput").html('<strong>Error:</strong> Organization Website field is empty!');
                $("#NumInvalidInput").slideDown(400);  
            }
    
            if(mailing_address == ""){
                $("#mailAddressInvalidInput").addClass('notice notice-sm notice-danger');
                $("#mailAddressInvalidInput").html('<strong>Error:</strong> Mailing Address field is empty!');
                $("#mailAddressInvalidInput").slideDown(400);   
            }

            return false;
        }
        else{
            document.getElementById("first_name").value = first_name;
            document.getElementById("middle_name").value = middle_name;
            document.getElementById("last_name").value = last_name;
            document.getElementById("up_id").value = up_id;
            document.getElementById("up_mail").value = up_mail;
            document.getElementById("contact_num").value = contact_num;
            document.getElementById("mailing_address").value = mailing_address;

            return true;
        }
    }
    else {
        return false;
    };
}

    function resetErrorDisplays(){
        $("#nameInvalidInput").removeClass();
        $("#nameInvalidInput").html('');

        $("#UPMailTaken").removeClass();
        $("#UPMailTaken").html('');

        $("#mailAddressInvalidInput").removeClass();
        $("#mailAddressInvalidInput").html('');

        $("#StudNumInvalidInput").removeClass();
        $("#StudNumInvalidInput").html('');

        $("#NumInvalidInput").removeClass();
        $("#NumInvalidInput").html('');        
    }
</script>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="author" content="UPCS">
      <title>Register</title>
   </head>
   <body>
      <div class="container py-5 animated fadeIn">
      <div class="row">
         <div class="col-md-12">
            <div class="row">
               <div class="col-md-9 mx-auto">
                  <div class="card border-danger" style="margin-top: 80px;">
                     <div class="card-header">
                        <h3 class="mb-0 my-2" style="text-align: center;">Sign Up as Student</h3>
                     </div>
                     <div class="card-body">
                        <small class="form-text text-muted">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</small>
                        <form class="form" method="POST" onsubmit="" action="registerStudent" role="form" autocomplete="off" style="margin-top: 10px;">
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-4">
                                    <input type="text" maxlength="100" class="form-control" placeholder="First Name" name="data[first_name]" id='first_name' required>
                                    <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                    <div id="nameInvalidInput" class="notice notice-sm notice-danger" style="display: none;"></div>
                                 </div>
                                 <div class="col-4">
                                    <input type="text" maxlength="100" class="form-control" placeholder="Middle Name" name="data[middle_name]" id='mid_name' required>
                                    <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                    <div id="nameInvalidInput" class="notice notice-sm notice-danger" style="display: none;"></div>
                                 </div>
                                 <div class="col-4">
                                    <input type="text" maxlength="30" class="form-control" placeholder="Last Name" name="data[last_name]" id='last_name' required>
                                    <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                    <div id="nameInvalidInput" class="notice notice-sm notice-danger" style="display: none;">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-3">
                                    <input type="text" maxlength="30" class="form-control" placeholder="Student Number" name="data[up_id]" id='up_id' required>
                                    <small class="form-text text-muted">20XXXXXXX</small>
                                 </div>
                                 <div class="col-3">
                                    <select class="form-control" name="data[year_level]" required>
                                       <option value ='1' >First Year</option>
                                       <option value ='2' >Second Year</option>
                                       <option value ='3' >Third Year</option>
                                       <option value ='4' >Fourth Year</option>
                                       <option value ='5' >Fifth Year</option>
                                       <option value ='6' >Sixth Year</option>
                                       <option value ='7' >Seventh Year</option>
                                       <option>Masteral</option>
                                       <option>Doctoral</option>
                                    </select>
                                    <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                 </div>
                                 <div class="col-6">
                                    <select class="form-control" name="data[course]" required>
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
                                    <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                 </div>
                                 <div id="StudNumInvalidInput" class="notice notice-sm notice-danger" style="display: none;">
                              </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-4">
                                    <select class="form-control" name="data[sex]" required>
                                       <option>Female</option>
                                       <option>Male</option>
                                    </select>
                                    <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                 </div>
                                 <div class="col-8">
                                    <input type="text" maxlength="30" class="form-control" placeholder="Birthday" name="data[birthday]" id='birthday' required>
                                    <small class="form-text text-muted">YYYY-MM-DD</small>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-7">
                                    <input type="email" maxlength="50" onblur="UPMailChecker()" class="form-control" name="data[up_mail]" id='up_mail' placeholder="UP Mail" required>
                                    <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                 </div>
                                 <div class="col-5">
                                    <input type="text" maxlength="50" class="form-control" name="data[contact_num]" id ='contact_num' placeholder="Phone Number" required>
                                    <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                    <div id="NumInvalidInput" class="notice notice-sm notice-danger" style="display: none;"></div>
                                 </div>
                              </div>
                           </div>
                           <div id="UPMailTaken" class="notice notice-sm notice-danger" style="display: none;"></div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-12">
                                    <input type="text" maxlength="100" class="form-control" name="data[address]" id='address' placeholder="Mailing Address" required>
                                    <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                 </div>
                              </div>
                              <div id="mailAddressInvalidInput" class="notice notice-sm notice-danger" style="display: none;"></div>
                           </div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-6">
                                    <input type="password" minlength="7" maxlength="32" onblur="conPassValidate()" id="Pass" class="form-control" placeholder="Password" name="data[password]" required>
                                    <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                 </div>
                                 <div class="col-6   ">
                                    <input type="password" minlength="7" maxlength="32" onblur="conPassValidate()" id="conPass" class="form-control" placeholder="Confirm Password" required>
                                    <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                 </div>
                              </div>
                           </div>
                           <div id="orgRegPwChecker" class="notice notice-sm notice-danger" style="display: none;">
                           </div>
                           <div class="form-group">
                              <label id="form5" style="margin-left: 1em; padding: 10px; background: #cc0000; display: table; color: white; font-family: Lato; border-radius: 5%;">Upload Form5<input type="file" style="display: none;" class="form-control" id = 'consti' name = 'form5' onchange=""></label>
                              <button type="button" class="btn btn-primary" style="margin-left: 1em" onclick="" > Preview File</button>
                              <button type="submit" style="display: none;" id = 'submitCons'> </button>
                              <div class="form-group">
                                 <div class="margin-top20 text-center">
                                    Already registered?<a href="<?php echo base_url();?>login"> Log In</a>
                                 </div>
                                 <button type="submit" class="btn btn-danger btn-md float-right">Create a new account</button>
                              </div>
                        </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>
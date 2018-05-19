<script>
    $(document).ready(function(){

      $('#regStudentForm').on("submit",function(e){
          
             e.preventDefault();
             if ($('[name=form5]').val() == ""){
                $("#fileCheckerNote").removeClass();
                $("#fileCheckerNote").html('');
                $("#fileCheckerNote").addClass('notice notice-sm notice-danger');
                $("#fileCheckerNote").html('<strong>Error:</strong> You must upload a form 5!');
                $("#fileCheckerNote").slideDown(400);
             }
                
              else{
                 $.ajax({
                   type: "post",
                   url :"<?php echo base_url(); ?>registerStudent", 
                   async: false,
                   cache: false,
                   contentType: false,
                   processData: false,
                   data: new FormData(this),
                   success : function (data){
                    alert(data);
                      swal({title: "Success!", text: "You have successfully created an account!", type: "success"},
                            function(){ 
                               location.reload();
                            }
                       );
                   },
                   error: function(XMLHttpRequest, textStatus, errorThrown) { 
                      alert("Status: " + textStatus + " | Error: " + errorThrown); 
                       swal("Error!", "Error in creating your account", "error");
                   }   
                });
            }
      });          
  });


  function nameFormatCheck(input) {  
    var regex_num = new RegExp('^[0-9]*$');
    var regex = new RegExp("^[a-zA-Z]+( [a-zA-Z]+)*$");
    var value =  input.value;
    
    if( regex_num.test(value) )
       input.setCustomValidity("Numbers are not allowed!");   
    else if( !regex.test(value) )
      input.setCustomValidity("Special characters are not allowed!");   
    else 
      input.setCustomValidity("");      
  }

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

  function upMailFormatCheck(input){
    var regex = new RegExp('\@up.edu.ph$');
    var value =  input.value;

    if( !regex.test(value) ){
        input.setCustomValidity("Input a valid UP Mail! (example@up.edu.ph)");
    }
    else 
      input.setCustomValidity("");
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
    var regex = new RegExp("^[a-zA-Z0-9]+( [a-zA-Z0-9]+)*$"); 
    var value =  input.value;

      if( !regex.test(value) )
          input.setCustomValidity("Extra spaces are not allowed!");   
      else 
        input.setCustomValidity(""); 
  }

  function passwordFormatCheck(input){
    var value =  input.value;
    
    if( /\s/.test(value) )
      input.setCustomValidity("Spaces are not allowed in passwords!");   
    else 
      input.setCustomValidity(""); 
  }

	function UPMailChecker(){
        var up_mail = ($("#up_mail").val()).trim();
        var checker = false;


    if (up_mail.length>0)
    {
        //AJAX IF EXISTING YUNG EMAIL
        //alert(org_email);
        $.ajax({
       type:"post",
       url:"<?php echo base_url().'validateStudentUPMail'?>",
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


    if (conPass!=Pass){
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

 function noUploads(){
      swal("Failed!", "You have not uploaded any form 5 yet!", "warning");
   }

  function validateForm(){
    resetErrorDisplays();

    if (conPassValidate() && UPMailChecker())
        return true;
    else 
        return false;
  }

  function resetErrorDisplays(){
    $("#UPMailTaken").removeClass();
    $("#UPMailTaken").html('');

    $("#fileCheckerNote").removeClass();
    $("#fileCheckerNote").html('');
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
                       
                        <form enctype="multipart/form-data" id= 'regStudentForm' method="POST" onsubmit="return validateForm()" autocomplete="off" style="margin-top: 10px;">
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-4">
                                    <input type="text" maxlength="30" class="form-control" name="data[first_name]" id='first_name' onkeyup="nameFormatCheck(this)" required>
                                    <small class="form-text text-muted">First Name</small>
                                 </div>
                                 <div class="col-4">
                                    <input type="text" maxlength="30" class="form-control" name="data[middle_name]" id='mid_name' onkeyup="nameFormatCheck(this)" required>
                                    <small class="form-text text-muted">Middle Name</small>
                                 </div>
                                 <div class="col-4">
                                    <input type="text" maxlength="30" class="form-control" name="data[last_name]" id='last_name' onkeyup="nameFormatCheck(this)" required>
                                    <small class="form-text text-muted">Last Name</small>
                                  </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-3">
                                    <input type="text" maxlength="9" class="form-control" name="data[up_id]" id='up_id' onkeyup="studNumFormatCheck(this)" required>
                                    <small class="form-text text-muted">Student Number</small>
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
                                    <small class="form-text text-muted">Year Level</small>
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
                                    <small class="form-text text-muted">College</small>
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
                                    <small class="form-text text-muted">Sex</small>
                                 </div>
                                 <div class="col-8">
                                    <input type="date" class="form-control" placeholder="Birthday" name="data[birthday]" id='birthday' required>
                                    <small class="form-text text-muted">Birthday</small>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-7">
                                    <input type="email" maxlength="50" onblur="UPMailChecker()" class="form-control" name="data[up_mail]" id='up_mail' onkeyup="upMailFormatCheck(this)" required>
                                    <small class="form-text text-muted">UP Mail</small>
                                 </div>
                                 <div class="col-5">
                                    <input type="text" maxlength="11" class="form-control" name="data[contact_num]" id ='contact_num' onkeyup="contactNumFormatCheck(this)" required>
                                    <small class="form-text text-muted">Phone Number</small>
                                 </div>
                              </div>
                           </div>
                           <div id="UPMailTaken" class="notice notice-sm notice-danger" style="display: none;"></div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-12">
                                    <input type="text" maxlength="100" class="form-control" name="data[address]" id='address' onkeyup="addressFormatCheck(this)"required>
                                    <small class="form-text text-muted">Address</small>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-6">
                                    <input type="password" minlength="7" maxlength="32" onblur="conPassValidate()" id="Pass" class="form-control" name="data[password]" onkeyup="passwordFormatCheck(this)" required>
                                    <small class="form-text text-muted">Password</small>
                                 </div>
                                 <div class="col-6   ">
                                    <input type="password" minlength="7" maxlength="32" onblur="conPassValidate()" id="conPass" class="form-control" onkeyup="passwordFormatCheck(this)" required>
                                    <small class="form-text text-muted">Confirm Password</small>
                                 </div>
                              </div>
                           </div>
                           <div id="studPwChecker" class="notice notice-sm notice-danger" style="display: none;">
                           </div>
                           <div class="form-group">
                              <label id="form5label" style="padding: 10px; background: #cc0000; display: table; color: white; font-family: Lato; border-radius: 5%;">Upload Form5

                              <input type="file" style="display: none;" class="form-control" id="form5" name="form5" onchange="loadFile(event)"></label>  
                              <img id="output"/>
                              <script>
                                var loadFile = function(event) {
                                var output = document.getElementById('output');
                                output.src = URL.createObjectURL(event.target.files[0]);
                                };
                              </script>
                              <div id="fileCheckerNote" class="notice notice-sm notice-danger" style="display: none;">
                           </div>
                           <br><br>
                              <div class="form-group">
                                 <div class="margin-top20 text-center">
                                    Already registered?<a href="<?php echo base_url();?>login"> Log In</a>
                                 </div>
                                 <button type="submit" class="btn btn-danger btn-md float-right">Create a new account</button>
                              </div>
                          </div>

                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>
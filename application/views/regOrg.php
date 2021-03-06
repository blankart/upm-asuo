<script>


    function noSpecialCharactersAndExtraSpacesCheck(input){

        var regex = new RegExp("^[a-zA-Z0-9]+( [a-zA-Z0-9]+)*$");
        var value =  input.value;
        
        if(value.length == 0)
           input.setCustomValidity("This field should not be empty!"); 
        else if( !regex.test(value) )
          input.setCustomValidity("Special characters and extra spaces are not allowed!"); 
        else 
          input.setCustomValidity("");    
    }

     function addressFormatCheck(input){

        var regex = new RegExp("^[a-zA-Z0-9\.\,\'\-\#]+( [a-zA-Z0-9\.\,\'\-]+)*$");
        var value =  input.value;
        
        if( !regex.test(value) ) 
          input.setCustomValidity("Special characters other than ' - , . # and extra spaces are not allowed!");    
        else 
          input.setCustomValidity("");    
    }



    function websiteFormatCheck(input){
        var value =  input.value;
        
        if( /\s/.test(value) )
          input.setCustomValidity("Spaces are not allowed in websites!");   
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

    function OrgRegEmailChecker(){
        var org_email = ($("#org_email").val()).trim();
        var checker = false;
        //alert(org_email);
    if (org_email.length>0)
    {
        //AJAX IF EXISTING YUNG EMAIL
        //alert(org_email);
        $.ajax({
       type:"post",
       url:"<?php echo base_url(); ?>validate_org_email",
       cache: false,
       data:{org_email: org_email},
       dataType: 'json',
       async: false,
       success:function(result)
       {
            //alert(JSON.stringify (result));
            if(result == true)
            {
                $("#orgEmailTaken").removeClass();
                $("#orgEmailTaken").html('');
                $("#orgEmailTaken").addClass('notice notice-sm notice-danger');
                $("#orgEmailTaken").html('<strong>Error:</strong> This email address is already linked to another account. For more info, visit OSA.');
                $("#orgEmailTaken").slideDown(400);   
                return false;
            }
            else if(result == false)
            {
               // alert("Abc");
                $("#orgEmailTaken").fadeOut(400);
                checker = true;
                return true;
            }
            
       }

    });

    }
    return checker;
    
}

function OrgRegAcronymChecker()
{
    var org_acronym = ($("#acronym").val()).trim();
    var checker = false;
       // alert(org_acronym);
    if (org_acronym.length>0)
    {
        //AJAX IF EXISTING YUNG EMAIL
        //alert(org_acronym);
        $.ajax({
       type:"post",
       url:"<?php echo base_url(); ?>validate_org_acronym",
       cache: false,
       data:{org_acronym: org_acronym},
       dataType: 'json',
       async: false,
       success:function(result)
       {
            //alert(JSON.stringify (result));
            if(result == true)
            {
                $("#orgAcronymRestricted").removeClass();
                $("#orgAcronymRestricted").html('');
                $("#orgAcronymRestricted").addClass('notice notice-sm notice-danger');
                $("#orgAcronymRestricted").html('<strong>Error:</strong> This acronym is already taken. For more info, visit OSA.');
                $("#orgAcronymRestricted").slideDown(400);   
                return false;
            }
            else if(result == false)
            {
                //alert(result);
                $("#orgAcronymRestricted").fadeOut(400);
                checker = true;
                return true;
            }
            
       }

    });

    }
    else{
        $("#orgAcronymRestricted").addClass('notice notice-sm notice-danger');
        $("#orgAcronymRestricted").html('<strong>Error:</strong> Acronym should not be empty!');
        $("#orgAcronymRestricted").slideDown(400);   
    }


    return checker;
}

function conPassValidate()
{
    var conPass = $("#conPass").val();
    var Pass = $("#Pass").val();
    if (conPass!=Pass && $("#conPass").val().length > 0 && $("#Pass").val().length > 0){
        $("#orgRegPwChecker").removeClass();
        $("#orgRegPwChecker").html('');
        $("#orgRegPwChecker").addClass('notice notice-sm notice-danger');
        $("#orgRegPwChecker").html('<strong>Error:</strong> Password does not match.');
        $("#orgRegPwChecker").slideDown(400);
        return false;
    }
    else if(conPass==Pass && $("#conPass").val().length > 0 && $("#Pass").val().length > 0){
        //alert("tasdasd");
        $("#orgRegPwChecker").fadeOut(400);
        return true;
    }

}

    function validateForm(){
        resetErrorDisplays();

        if (conPassValidate() && OrgRegEmailChecker() && OrgRegAcronymChecker())
            return true;
        else 
            return false;
    }

    function resetErrorDisplays(){

        $("#orgAcronymRestricted").removeClass();
        $("#orgAcronymRestricted").html('');

        $("#orgEmailTaken").removeClass();
        $("#orgEmailTaken").html('');
    }

</script>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="author" content="UPCS">
    <title>Register</title>
    <!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
</head>

<body>
    <div class="container py-5 animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-9 mx-auto">
                        <div class="card border-danger" style="margin-top: 80px;">
                            <div class="card-header">
                                <h3 class="mb-0 my-2" style="text-align: center;">Sign Up as Organization</h3>
                            </div>
                            <div class="card-body">
                                <form class="form" method="POST" onsubmit="return validateForm()" action="registerOrg" role="form" autocomplete="off" style="margin-top: 10px;">

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-8">
                                                <input type="text" maxlength="100" class="form-control" name="data[org_name]" id='org_name' onkeyup="noSpecialCharactersAndExtraSpacesCheck(this)" required>
                                                <small class="form-text text-muted">Organization Full Name</small>
                                            </div>
                                            <div class="col-4">
                                                <input type="text" maxlength="30" class="form-control" onblur="OrgRegAcronymChecker()" name="data[acronym]" id='acronym' onkeyup="noSpecialCharactersAndExtraSpacesCheck(this)" required>
                                                <small class="form-text text-muted">Acronym</small>
                                                <div id="orgAcronymRestricted" class="notice notice-sm notice-danger" style="display: none;">
                                            </div>
                                        </div>
                                    </div>
                    
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-6">
                                                <select class="form-control" name="data[org_category]" required>
                                                    <option>Academic</option>
                                                    <option>Cause-oriented</option>
                                                    <option>Cultural</option>
                                                    <option>Fraternity</option>
                                                    <option>Regional/Provincial</option>
                                                    <option>Religious/Spiritual</option>
                                                    <option>Service</option>
                                                    <option>Socio-Civic</option>
                                                    <option>Sorority</option>
                                                    <option>Special Interest</option>
                                                    <option>Sports/Recreation</option>
                                          
                                                </select>
                                                <small class="form-text text-muted">Category</small>
                                            </div>
                                            <div class="col-6">
                                                <select class="form-control" name="data[org_college]" required>
                                                    <option>College of Allied Medical Professions</option>
                                                    <option>College of Arts and Sciences</option>
                                                    <option>College of Dentistry</option>
                                                    <option>College of Medicine</option>
                                                    <option>College of Nursing</option>
                                                    <option>College of Pharmacy</option>
                                                    <option>College of Public Health</option>
                                                </select>
                                                <small class="form-text text-muted">College</small>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-7">
                                                <input type="email" maxlength="50" onblur="OrgRegEmailChecker()" class="form-control" name="data[org_email]" id='org_email' required>
                                                <small class="form-text text-muted">Email Address</small>
                                            </div>
                                            <div class="col-5">
                                                <input type="text" maxlength="50" class="form-control" name="data[org_website]" id ='org_website' onkeyup="websiteFormatCheck(this)" required>
                                                <small class="form-text text-muted">Website</small>
                                            </div>

                                        </div>
                                    </div>
                                    <div id="orgEmailTaken" class="notice notice-sm notice-danger" style="display: none;"></div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="text" maxlength="100" class="form-control" name="data[mailing_address]" id='mailing_address' onkeyup="addressFormatCheck(this)"  required>
                                                <small class="form-text text-muted">Mailing Address</small>
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
                                    <div id="orgRegPwChecker" class="notice notice-sm notice-danger" style="display: none;">

                                    </div>


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
                <!--/row-->

            </div>
            <!--/col-->
        </div>
        <!--/row-->
    </div>
    <!--/container-->
</body>

</html>
<script>
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
    {
        
        var org_name = (document.getElementById("org_name").value).trim();
        var acronym = (document.getElementById("acronym").value).trim();
        var org_email = (document.getElementById("org_email").value).trim();
        var org_website = (document.getElementById("org_website").value).trim();
        var mailing_address = (document.getElementById("mailing_address").value).trim();

        // alert("Org name: '"+ org_name + "'");
        // alert("Acronym: '"+ acronym + "'");
        // alert("Org Email: '"+ org_email + "'");
        // alert("Org Website: '"+ org_website + "'");
        // alert("Mailing Address: '"+ mailing_address + "'");

        if(org_name == '' || acronym == '' || org_email == '' || org_website == '' || mailing_address == ''){

           // alert ('invalid input found!');

            if(org_name == ""){
                $("#nameInvalidInput").addClass('notice notice-sm notice-danger');
                $("#nameInvalidInput").html('<strong>Error:</strong> Organizaton Name field is empty!');
                $("#nameInvalidInput").slideDown(400);   
            }

            if(org_website == ""){
                $("#websiteInvalidInput").addClass('notice notice-sm notice-danger');
                $("#websiteInvalidInput").html('<strong>Error:</strong> Organization Website field is empty!');
                $("#websiteInvalidInput").slideDown(400);  
            }
    
            if(mailing_address == ""){
                $("#mailAddressInvalidInput").addClass('notice notice-sm notice-danger');
                $("#mailAddressInvalidInput").html('<strong>Error:</strong> Mailing Address field is empty!');
                $("#mailAddressInvalidInput").slideDown(400);   
            }

            return false;
        }
        else{
            document.getElementById("org_name").value = org_name;
            document.getElementById("acronym").value = acronym;
            document.getElementById("org_email").value = org_email;
            document.getElementById("org_website").value = org_website;
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

        $("#orgAcronymRestricted").removeClass();
        $("#orgAcronymRestricted").html('');

        $("#orgEmailTaken").removeClass();
        $("#orgEmailTaken").html('');

        $("#mailAddressInvalidInput").removeClass();
        $("#mailAddressInvalidInput").html('');

        $("#websiteInvalidInput").removeClass();
        $("#websiteInvalidInput").html('');        
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
                                <small class="form-text text-muted">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</small>
                                <form class="form" method="POST" onsubmit="return validateForm()" action="registerOrg" role="form" autocomplete="off" style="margin-top: 10px;">

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-8">
                                                <input type="text" maxlength="100" class="form-control" placeholder="Organization Full Name" name="data[org_name]" id='org_name' required>
                                                <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                                <div id="nameInvalidInput" class="notice notice-sm notice-danger" style="display: none;"></div>
                                            </div>
                                            <div class="col-4">
                                                <input type="text" maxlength="30" class="form-control" onblur="OrgRegAcronymChecker()" placeholder="Acronym" name="data[acronym]" id='acronym' required>
                                                <small class="form-text text-muted">Sed ut perspiciatis.</small>
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
                                                <small class="form-text text-muted">Sed ut perspiciatis.</small>
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
                                                <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-7">
                                                <input type="email" maxlength="50" onblur="OrgRegEmailChecker()" class="form-control" name="data[org_email]" id='org_email' placeholder="Email Address" required>
                                                <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                            </div>
                                            <div class="col-5">
                                                <input type="text" maxlength="50" class="form-control" name="data[org_website]" id ='org_website' placeholder="Website" required>
                                                <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                                 <div id="websiteInvalidInput" class="notice notice-sm notice-danger" style="display: none;"></div>
                                            </div>

                                        </div>
                                    </div>
                                    <div id="orgEmailTaken" class="notice notice-sm notice-danger" style="display: none;"></div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="text" maxlength="100" class="form-control" name="data[mailing_address]" id='mailing_address' placeholder="Mailing Address" required>
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
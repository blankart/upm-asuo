<script>
    function OrgRegEmailChecker(){
    if ($("#OrgRegEmailAdd").val().length>0)
    {
        //AJAX IF EXISTING YUNG EMAIL

    //CODE BELOW IF EXISTING
    $("#orgEmailTaken").removeClass();
    $("#orgEmailTaken").html('');
    $("#orgEmailTaken").addClass('notice notice-sm notice-danger');
    $("#orgEmailTaken").html('<strong>Error:</strong> This email address is already linked to another account. For more info, visit OSA.');
    $("#orgEmailTaken").slideDown(400);
    return false;
    //CODE BELOW IF AVAILABLE
    //$("#orgEmailTaken").fadeOut(400);
    //return true;
    }
    
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
    else{
        $("#orgRegPwChecker").fadeOut(400);
        return true;
    }

}

function validateForm(){
    if (conPassValidate() && OrgRegEmailChecker())
    {
        return true;
    }
    else return false;
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
                                <form class="form" onsubmit="return validateForm()" role="form" autocomplete="off" style="margin-top: 10px;">

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-8">
                                                <input type="text" class="form-control" placeholder="Organization Full Name" required>
                                                <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                            </div>
                                            <div class="col-4">
                                                <input type="text" class="form-control" placeholder="Acronym" required>
                                                <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-6">
                                                <select class="form-control" required>
                                                    <option>Category 1</option>
                                                    <option>Category 2</option>
                                                    <option>Category 3</option>
                                                    <option>Category 4</option>
                                                    <option>Category 5</option>
                                                </select>
                                                <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                            </div>
                                            <div class="col-6">
                                                <select class="form-control" required>
                                                    <option>College 1</option>
                                                    <option>College 2</option>
                                                    <option>College 3</option>
                                                    <option>College 4</option>
                                                    <option>College 5</option>
                                                </select>
                                                <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-7">
                                                <input type="email" id="OrgRegEmailAdd" onblur="OrgRegEmailChecker()" class="form-control" placeholder="Email Address" required>
                                                <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                            </div>
                                            <div class="col-5   ">
                                                <input type="text" class="form-control" placeholder="Website" required>
                                                <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                            </div>

                                        </div>
                                    </div>
                                    <div id="orgEmailTaken" class="notice notice-sm notice-danger" style="display: none;">

                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="email" class="form-control" placeholder="Mailing Address" required>
                                                <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="password" onblur="conPassValidate()" id="Pass" class="form-control" placeholder="Password" required>
                                                <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                            </div>
                                            <div class="col-6   ">
                                                <input type="password" onblur="conPassValidate()" id="conPass" class="form-control" placeholder="Confirm Password" required>
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
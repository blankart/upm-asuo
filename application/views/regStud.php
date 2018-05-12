<script>
	

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
                        <form class="form" method="POST" onsubmit="" action="registerStud" role="form" autocomplete="off" style="margin-top: 10px;">
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
                                 <div class="col-6">
                                    <select class="form-control" name="data[year_level]" required>
                                       <option>First Year</option>
                                       <option>Second Year</option>
                                       <option>Third Year</option>
                                       <option>Fourth Year</option>
                                       <option>Fifth Year</option>
                                       <option>Sixth Year</option>
                                       <option>Seventh Year</option>
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
                                    <input type="email" maxlength="50" onblur="" class="form-control" name="data[up_email]" id='up_email' placeholder="UP Mail" required>
                                    <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                 </div>
                                 <div class="col-5">
                                    <input type="text" maxlength="50" class="form-control" name="data[contact_num]" id ='contact_num' placeholder="Phone Number" required>
                                    <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                    <div id="websiteInvalidInput" class="notice notice-sm notice-danger" style="display: none;"></div>
                                 </div>
                              </div>
                           </div>
                           <div id="orgEmailTaken" class="notice notice-sm notice-danger" style="display: none;"></div>
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
                                    <input type="password" minlength="7" maxlength="32" onblur="" id="Pass" class="form-control" placeholder="Password" name="data[password]" required>
                                    <small class="form-text text-muted">Sed ut perspiciatis.</small>
                                 </div>
                                 <div class="col-6   ">
                                    <input type="password" minlength="7" maxlength="32" onblur="" id="conPass" class="form-control" placeholder="Confirm Password" required>
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
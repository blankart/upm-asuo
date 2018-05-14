<!-- JS code -->

<!DOCTYPE html>
<html>
<head>
  <?php require("header.php"); ?>
  <style><?php include 'css/stud.css'; ?></style>
  <meta charset="utf-8">
    <meta content="UPCS" name="author">
    <title>UP Organizations</title>
</head>
<body>  
  <script>
    $(document).ready(function(){
      dispAnnouncements();
        $("#announcementsBTN").click(function(){
          dispAnnouncements();
        });
        $("#myOrgsBTN").click(function(){
          dispMyOrgs();
        });
        $("#studProfileBTN").click(function(){
          dispStudProfile();
        });
    });
    function dispAnnouncements(){
      $("#myOrgsBTN").removeClass('active');
      $("#myOrgs").hide();
      $("#studProfileBTN").removeClass('active');
      $("#studProfile").hide();
      $("#announcements").fadeIn(400);
      $("#announcementsBTN").addClass('active');
    }
	$(function () {
		$('a[href="#search"]').on('click', function(event){
			event.preventDefault();
			$('#search').addClass('open');
			$('#search > form > input[type="search"]').focus();
		});
		$('#search, #search button.close').on('click keyup', function(event){
			if(event.target == this || event.target.className == 'close' || event.keyCode == 27){
				$(this).removeClass('open');
			}
		});
	});
    function dispStudProfile(){
      $("#myOrgsBTN").removeClass('active');
      $("#myOrgs").hide();
      $("#announcements").hide();
      $("#announcementsBTN").removeClass('active');
      $("#studProfileBTN").addClass('active');
      $("#studProfile").fadeIn(400);
    }

    function dispMyOrgs(){
      $("#announcementsBTN").removeClass('active');
      $("#announcements").hide();
      $("#studProfileBTN").removeClass('active');
      $("#studProfile").hide();
      $("#myOrgs").fadeIn(400);
      $("#myOrgsBTN").addClass('active');
    }
  </script>
</body> 
<div class="header" style="padding-top: 80px; text-align: center; color: white;">
   <h1 style="font-size: 40px; font-family: Lato; color: white">Hi Student_Firstname!</h1>
</div>
<br>
<div class="animated fadeIn" style="background-color: rgb(255,255,255); margin-top: 40px; padding-top: 50px; box-shadow: 0 0 40px rgba(0,0,0,.50); padding-bottom: 50px;">
   <div class="container">
      <div class="row">
         <div class="col-3">
            <div class="card" id="studentProfile" style="box-shadow: 0 0 40px rgba(0,0,0,.2)">
               <img class="card-img-top" src="img/nico.jpg" alt="card image" style="max-height: 250px width: 100%">
               <div class="card-body" >
                  <h5 class="card-title">Student Name</h5>
                  <p class="card-text">Course, Year</p>
                  <p class="card-text">E-mail</p>
                  <hr> 
                  <button class="btn btn-danger btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" data-target="#editProfile">Edit Profile</button>
                  <?php require('editProfile.php') ?>
				  <a button class="btn btn-danger btn-block" style="margin-top: 10px;" type="button" href="#search">Apply to Organizations</button></a>
               </div>
            </div>
         </div>
         <div class="col-6">
            <div class="card" style="box-shadow: 0 0 40px rgba(0,0,0,.2)">
               <div class="card-body">
                  <button class="btn btn-light btn-sm active" id="announcementsBTN" type="button">Announcements</button> <button class="btn btn-light btn-sm" id="myOrgsBTN" type="button" style="margin-left: 15px;">My Organizations</button> <button class="btn btn-light btn-sm" id="studProfileBTN" type="button" style="margin-left: 15px;">About NameOfStudent</button> 
                  <hr>
                  <div id="announcements" style="display:none;">
                     <div class="stream-post">
                        <div class="sp-author">
                           <a class="sp-author-avatar" href="#"><img alt="" src="img/UP%20logo.png"></a>
                           <h6 class="sp-author-name"><a href="#">OSA</a></h6>
                        </div>
                        <div class="sp-content">
                           <div class="sp-info">
                              <h6>something</h6>
                              somethingelse
                           </div>
                           <p class="sp-paragraph mb-0">
                              something new
                           </p>
                        </div>
                     </div>
                  </div>
                  <div id="studProfile" style="display:none;">
                     <div class="well profile text-center">
                        <img src="" class="avatar img-thumbnail" alt="avatar" height="250px"  width="250px">
                        <br><br>
                        <h2>NAME</h2>
                        <p><strong>Year, Course</strong></p>
                        <p><a href="">Email</a> || Contact Num</p>
                    </div> 
                  </div>   
                  <div id="myOrgs" style="display: none">
                     <div class="table-responsive">
                        <table class="table">
                           <thead>
                              <tr>
                                 <th><span>Organization</span></th>
                                 <th><span>Position</span></th>
                                 <th><span>Email</span></th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td><a class="org-link" href="#"><img alt="orgLogo" src="img/UP%20logo.png" style="max-height: 80px" title="ACRONYM"></a></td>
                                 <td>Member</td>
                                 <td>lalala@gmail.com</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>                    
               </div>
            </div>
         </div>
         <div class="col-3" >
            <div class="card" id="applications" style="box-shadow: 0 0 40px rgba(0,0,0,.2)">
               <div class="card-header" style="background-color: rgb(123,17,19); text-align: center;">
                  <h5 style="color: white;">My Applications</h5>
               </div>
               <div class="card-body">
                <div id="myApplications" style="height:400px; overflow-y: auto;">
                  <table class="table table-hover">
                    <tbody>
                      <tr>
                        <td>
                          <div class="hovereffect">
                            <img src="img/nico.jpg" alt="orgLogo" class="img-responsive" style="max-height:170px; overflow:auto;">
                            <div class="overlay">
                              <h2> ACRONYM 1 </h2>
                <a class="info" data-toggle="modal" data-target="#viewOrgDetails">Details</a>
                <?php require('viewOrgDetails.php') ?>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table table-hover">
                    <tbody>
                      <tr>
                        <td>
                          <div class="hovereffect">
                            <img src="img/nico.jpg" alt="orgLogo" class="img-responsive" style="max-height:170px; overflow:auto;">
                            <div class="overlay">
                              <h2>ACRONYM 2</h2>
                              <a class="info" data-toggle="modal" data-target="#viewOrgDetails">Details</a>
                <?php require('viewOrgDetails.php') ?>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
          <table class="table table-hover">
                    <tbody>
                      <tr>
                        <td>
                          <div class="hovereffect">
                            <img src="img/nico.jpg" alt="orgLogo" class="img-responsive" style="max-height:170px; overflow:auto;">
                            <div class="overlay">
                              <h2> ACRONYM 3</h2>
                <a class="info" data-toggle="modal" data-target="#viewOrgDetails">Details</a>
                <?php require('viewOrgDetails.php') ?>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
          <table class="table table-hover">
                    <tbody>
                      <tr>
                        <td>
                          <div class="hovereffect">
                            <img src="img/nico.jpg" alt="orgLogo" class="img-responsive" style="max-height:170px; overflow:auto;">
                            <div class="overlay">
                              <h2>ACRONYM 4</h2>
                <a class="info" data-toggle="modal" data-target="#viewOrgDetails">Details</a>
                <?php require('viewOrgDetails.php') ?>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
               </div>
            </div>
    
   </div>
</div>
<div id="search">
	<button type="button" class="close">x</button>
		<form>
			<input type="search" value="" placeholder="type organization name here"/>
				<button type="submit" class="btn btn-primary">Search</button>
		</form>				 
</div>

  
  

<?php require("footer.php"); ?>
</html>
  

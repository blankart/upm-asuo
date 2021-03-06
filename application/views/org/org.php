<?php 
  
  $account_type=$this->session->userdata["account_type"];

  $open_accreditation = $this->session->userdata['open_accreditation'];

    if($account_type == 'student' || $account_type == 'admin'){
        $isAdmin = $isAdmin;
        $isOfficer = $isOfficer;
        $isMember = $isMember;
        $isApplicant = $isApplicant;
        $isOrg = false;
    }else{
        $isAdmin = false;
        $isOfficer = false;
        $isMember = false;
        $isApplicant = false;
        $isOrg = true;
    }

?>

<script type="text/javascript">
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
</script>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="UPCS" name="author">
    <title>UP Organizations</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/org.css">
</head>
<body>
    <script>
               $(document).ready(function(){
                <?php if(!$isOrg ){?>
                   dispOrgProfile();
                <?php } else{ ?>
                   dispAdminAnnouncements();
                <?php } ?>
                   $("#orgPostsBut").click(function(){
                      dispOrgPosts();
                   })
       
                   $("#orgMembersBut").click(function(){
                      dispOrgMembers();
                   });
       
                   $("#orgApplicationsBut").click(function(){
                      dispOrgApps();
                   });
       
                   $("#orgAdminAnnouncementsBut").click(function(){
                      dispAdminAnnouncements();
                   });

                   $("#orgProfileBTN").click(function(){
                      dispOrgProfile();
                   });
       
                });
       
                function dispOrgPosts(){
                   $("#orgMembersBut").removeClass('active');
                   $("#orgApplicationsBut").removeClass('active');
                   $("#orgAdminAnnouncementsBut").removeClass('active');
                   $("#orgMembers").hide();
                   $("#orgApplications").hide();
                   $("#orgAdminAnnouncements").hide();
                   $("#orgProfile").hide();
                   $("#orgProfileBTN").removeClass('active');
                   $("#orgPosts").fadeIn(400);
                   $("#orgPostsBut").addClass('active');
                   
                }
                 function dispOrgProfile(){
                   $("#orgMembersBut").removeClass('active');
                   $("#orgApplicationsBut").removeClass('active');
                   $("#orgAdminAnnouncementsBut").removeClass('active');
                   $("#orgMembers").hide();
                   $("#orgApplications").hide();
                   $("#orgAdminAnnouncements").hide();
                   $("#orgPosts").hide();
                   $("#orgPostsBut").removeClass('active');
                   $("#orgProfile").fadeIn(400);
                   $("#orgProfileBTN").addClass('active');
                }
                function dispOrgMembers(){
                   $("#orgPostsBut").removeClass('active');
                   $("#orgApplicationsBut").removeClass('active');
                   $("#orgAdminAnnouncementsBut").removeClass('active');
                   $("#orgPosts").hide();
                   $("#orgProfile").hide();
                   $("#orgProfileBTN").removeClass('active');
                   $("#orgApplications").hide();
                   $("#orgAdminAnnouncements").hide();
                   $("#orgMembers").fadeIn(400);
                   $("#orgMembersBut").addClass('active');
                }
                function dispAdminAnnouncements(){
                   $("#orgPostsBut").removeClass('active');
                   $("#orgMembersBut").removeClass('active');
                   $("#orgApplicationsBut").removeClass('active');
                   $("#orgPosts").hide();
                   $("#orgMembers").hide();
                   $("#orgApplications").hide();
                   $("#orgProfile").hide();
                   $("#orgProfileBTN").removeClass('active');
                   $("#orgAdminAnnouncements").fadeIn(400);
                   $("#orgAdminAnnouncementsBut").addClass('active');
                }
                function dispOrgApps(){
                   $("#orgPostsBut").removeClass('active');
                   $("#orgMembersBut").removeClass('active');
                   $("#orgAdminAnnouncementsBut").removeClass('active');
                   $("#orgPosts").hide();
                   $("#orgMembers").hide();
                   $("#orgAdminAnnouncements").hide();
                   $("#orgProfile").hide();
                   $("#orgProfileBTN").removeClass('active');
                   $("#orgApplications").fadeIn(400);
                   $("#orgApplicationsBut").addClass('active');
                }

                function studApproved(name, acronym, id){
                  
                  swal({
                    title: "Approve "+ name+ "?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Approve",
                    closeOnConfirm: false
                  },
                  function(){

                      $.ajax({
                      type: "post",
                      url: "<?php echo base_url();?>org/approveMembership",
                      data: {student_id: id},
                      dataType: "JSON",
                      async: false,
                      cache: false,
                      success: function(result){

                        if(result){
                          swal({title: "Approved!", text: name + " is now a member of " + acronym, type: "success"},
                             function(){ 
                                 location.reload();
                             });
                        }
                      }
                    });
                    }
                  );
                }

                function studReject(name, id){

                  swal({
                    title: "Reject "+ name+ "?",
                    text: "Write reason:",
                    type: "input",
                    showCancelButton: true,
                    confirmButtonText: "Reject",
                    closeOnConfirm: false,
                    inputPlaceholder : "Sample reason here."
                  },
                  function(reason){
                    $.ajax({
                      type: "post",
                      url: "<?php echo base_url();?>org/rejectMembership",
                      data: {
                              student_id: id, 
                              reason: reason
                            },
                      dataType: "JSON",
                      async: false,
                      cache: false,
                      success: function(result){
                        console.log("success");
                        if(result){
                          swal({title: "Rejected!", text: "You rejected" +name+ "'s application.", type: "error"},
                             function(){ 
                                 location.reload();
                             });
                        }
                      },
                      error: function(){
                        swal("Error"); //ERROR MESSAGE
                      }
                    });
                    }
                  );
                }

                function changePosition(name, id ){
                  swal({
                    title: "Membership",
                    text: "Enter new position:",
                    type: "input",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    inputPlaceholder: "Position"
                  }, function (position) {
                  if (position === false)
                    return false;
                  if (position.trim() === "") {
                    swal("Error!", "Input empty.", "error");
                    return false;
                  }

                  if ((position.trim()).length >  20) {
                    swal("Error!", "Position name should not be more than 20 characters!", "error");
                    return false;
                  }

                    $.ajax({
                      type: "post",
                      url: "<?php echo base_url();?>org/editMembershipPosition",
                      data: {student_id: id, position: position},
                      dataType: "JSON",
                      async: false,
                      cache: false,
                      success: function(result){

                        if(result){
                          swal({title: "Membership Updated!", text: "You updated " +name+ "'s position to '" + position + "'.", type: "success"},
                             function(){ 
                                 location.reload();
                             });
                        }
                      }
                    });

                  });
                }

                function removeMember(name, acronym, id){

                  swal({
                    title: "Membership",
                    text: "Reason for removing member:",
                    type: "input",
                    showCancelButton: true,
                    closeOnConfirm: false,
                  }, function (reason) {
                    if (reason === false) 
                      return false;
                    if (reason.trim() === "") {
                      swal("Error!", "Reason empty.", "error");
                      return false;
                    }

                    if ((reason.trim()).length > 100) {
                      swal("Error!", "Reason should not be more than 100 characters!", "error");
                      return false;
                    }

                      $.ajax({
                      type: "post",
                      url: "<?php echo base_url();?>org/removeMember",
                      data: {student_id: id, reason: reason},
                      dataType: "JSON",
                      async: false,
                      cache: false,
                      success: function(result){

                        if(result){
                          swal({title: "Member removed!", text: "" +name + " has been removed from " +acronym+ ".", type: "success"},
                             function(){ 
                                 location.reload();
                             });
                        }
                      }
                    });
                });
              } 

              function applyToOrg(org_id){
                swal({
                  title: "Are you sure you want to apply?",
                  text: "You will not be able to cancel this.",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Yes, I want to apply!",
                  closeOnConfirm: false
                },
                function(){

                   $.ajax({
                      type: "post",
                      url: "<?php echo base_url();?>org/applyToOrg",
                      data: {org_id: org_id},
                      dataType: "JSON",
                      async: false,
                      cache: false,
                      success: function(result){
                        //alert(result);
                        if(result){
                          swal({title: "Sent!", text: "Your application has been sent.", type: "success"},
                             function(){ 
                                 location.reload();
                             });
                        }
                      }
                    });
                });
              }             
    </script>
    <div class="orgheader">
         <?php if($account_type=="org"){ ?>  <h1>Hi <?php echo $profile['acronym']; ?>!</h1> <?php } ?> 
    </div>
    <div id="panel" class='animated fadeIn'>
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="card" id="ProfileDetails">
                        <div class="card-header" id="myCard">
                            <h4 id="pd">Profile Details</h4>
                        </div>
                        <div class="card-body">
                            <div class='wrapper'>
                              <img class='profileicon' src="<?php echo base_url().'assets/org/logo/'.$profile['org_logo'].'?'.rand(1, 100); ?>" width="150">
                            </div>
                            <h3 style="text-align: center; margin-bottom: 5 px; margin-top: 30px;"><strong><?php echo $profile['org_name']; ?></strong></h3>
                            <h6 style="text-align: center; margin-bottom: 30px;"><strong><?php echo $profile['acronym']; ?></strong></h6>
                            <p style="text-align: center;"><?php echo $profile['org_category']; ?></p>
                            <hr>

                            <?php if($account_type == 'org') {?>
								<button class="btn btn-danger btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" data-target="#editprofile">
									<i class="fa fa-edit fa-2x" style='float: left;'></i>Edit Profile</button> 

                  <?php if($open_accreditation && $profile['org_status'] == 'Pending') {?>
								<button class="btn btn-danger btn-block" style="margin-top: 10px;" type="button" onclick="location.href = '<?php echo base_url(); ?>org/applyforaccreditation';">
									<a><i class="fa fa-folder-open fa-2x" style='float: left;'></i>Apply for Accreditation</a></button>

                  <?php }?>

								<button class="btn btn-danger btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" data-target="#createposts">
									<a><i class="fas fa-paper-plane fa-2x pull-left" style='float: left;'></i>Create Post</a></button>
                            <?php } ?>

                            <?php if(!$isAdmin && !$isOfficer && !$isMember && !$isOrg && !$isApplicant ){?>
                            <button class="btn btn-danger btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="applyToOrg(<?php echo $org_id;?>)">Apply for Membership</button>
                              <?php } ?>

                            <?php if(!$isAdmin && !$isOfficer && !$isMember && !$isOrg && $isApplicant ){?>
                            <button class="btn btn-danger btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" onclick="applyToOrg()" disabled>Membership Request Sent</button>
                              <?php } ?>


                <?php if($open_accreditation && $profile['org_status'] == 'For Approval') {?>
                <button class="btn btn-danger btn-block" style="margin-top: 10px;" type="button" disabled>
                  <a><i class="fa fa-folder-open fa-2x" style='float: left;' ></i>Application Awaiting Approval</a></button>

                  <?php }?>

                        </div>
                    </div>
                </div>
                
                <div class="col-8">
                    <div class="card" style="box-shadow: 0 0 40px rgba(0,0,0,.2); height: 600px;">
                    	<div class='card-header'>
                    		<?php if($account_type!="org"){ ?> 
                              <button class="btn btn-light btn-lg active" id="orgProfileBTN" type="button">About <?php echo $profile['acronym']; ?> </button> 
                            <?php } ?>

                            <?php if($account_type=="org"){ ?> 
                            <button class="btn btn-light btn-lg" id="orgAdminAnnouncementsBut"  style="margin-left: 15px;" type="button">Admin Announcements</button> 
                             <?php } ?>

                            <?php if($isAdmin || $isOfficer || $isMember || $isOrg){ ?>
                            <button class="btn btn-light btn-lg" id="orgMembersBut" style="margin-left: 15px;" type="button">Members</button> 
                            <?php } ?>

                            <?php if($account_type=="org"){ ?> 
                            <button class="btn btn-light btn-lg" id="orgApplicationsBut" style="margin-left: 15px;" type="button">Applications</button> 
                             <?php } ?>

                            <button class="btn btn-light btn-lg active" id="orgPostsBut" style="margin-left: 15px;" type="button">Posts</button> 
                    	</div>
                        <div class="card-body" style='overflow-y: scroll;'>
                            

                            
                            <hr>
                            <div id="orgProfile">

                              <div class="well profile text-center">
                        		    <h2><?php echo $profile['acronym']; ?></h2>
                        		    <h5><?php echo $profile['org_college']; ?></h5>
                        		    <h6><i class="fas fa-envelope"></i> <a href="mailto:<?php echo $profile['org_email']; ?>" style="color: #008b8b;"><?php echo $profile['org_email']; ?></a>&emsp;<i class="fas fa-link"></i> <a href="<?php echo prep_url($profile['org_website']); ?>" target="_blank" style="color: #008b8b;" ><?php echo $profile['org_website']; ?></a></h6>
                        		  </div>
                              <div class="well profile text-left">
                                <br><br>
                        		    <h4>Organization Description:</h4>
                        		    <p style="text-indent: 30px;"><?php echo $profile['description']; ?></p><br>
                        		    <h4>Organization Objectives:</h4>
                        		    <p style="text-indent: 30px;"><?php echo $profile['objectives']; ?></p><br>
                    		      </div> 

                            </div>

                            <div id="orgPosts">
                                <?php foreach($posts as $mypost){ 
                                    if( 
                                      ($mypost['privacy'] == 'Officers' && ($isOfficer || $isOrg)) ||
                                      ($mypost['privacy'] == 'Members' && ($isMember || $isOfficer || $isOrg)) ||
                                      ($mypost['privacy'] == 'Public') 
                                      ){
                                   ?>
                                <div class="stream-post">
                                    <div class="sp-author">
                                        <a class="sp-author-avatar"><img alt="" src="<?php echo base_url().'assets/org/logo/'.$profile['org_logo'].'?'.rand(1, 100); ?>"></a>
                                        <h6 class="sp-author-name"><a href="#"><?php echo $profile['acronym']; ?></a></h6>
                                    </div>

                                    <div class="sp-content">
                                      <div class="sp-info">
                                        <h6 style="color: #3f3f3f; font-size: 18px; font-weight: bold;"><?php echo $mypost['title']; ?></h6>
                                              <?php echo date("g:i:s a |  F j, Y", strtotime($mypost['date_posted'])). ' | ' .$mypost['privacy']; ?>
                                      </div>
                                            
                                      <p class="sp-paragraph mb-0">
                                        <?php echo $mypost['content']; ?>
                                      </p>
                                    </div>
                                </div>
                                <?php  } } ?>
                                
                            </div>

                            <div id="orgMembers" style="display: none;">
                                <div class="main-box clearfix">
                                    <div class="table-responsive">
                                        <table class="table user-list">
                                            <thead>
                                                <tr>
                                                    <th><span>Student Name</span></th>
                                                    <th class="text-center"><span>Position</span></th>
                                                    <th><span>Email</span></th>
                                                    <?php if($account_type == 'org') {?> <th><span>Action</span></th> <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>


                                             <?php foreach($members as $member){ 
                                                if($member['position'] != "Member"){

                                                      ?>
                                                <tr>
                                                    <td>
                                                     <img alt="" src="<?php echo base_url().'assets/student/profile_pic/'.$member['profile_pic'].'?'.rand(1, 100); ?>"> <a class="user-link" href="<?php echo base_url().'student/'.$member['username'];?>" style="color:inherit;"><?php echo $member['first_name']." ".$member['middle_name']." ".$member['last_name']; ?></a>
                                                    </td>
                                                    <td class="text-center">
                                                      <span class="badge badge-success"><?php echo $member['position']; ?></span></td>
                                                    <td>
                                                     <a href="mailto:<?php echo $member['up_mail']; ?>"  style="color: #008b8b;"><?php echo $member['up_mail']; ?></a>
                                                    </td>
                                                     <?php if($account_type == 'org') {?>
                                                    <td>
                                                      <button class="btn btn-sm btn-info" onclick="changePosition(' <?php echo $member['first_name'].' '.$member['middle_name'].' '.$member['last_name']; ?>', '<?php echo $member['student_id']; ?>')" type="button" id="changePosBTN">Edit Position</button><br><br>
                                                      <button class="btn btn-sm btn-danger" onclick="removeMember(' <?php echo $member['first_name'].' '.$member['middle_name'].' '.$member['last_name']; ?>', '<?php echo $member['acronym']; ?>', '<?php echo $member['student_id']; ?>')" type="button" id="removeBTN">Remove</button>
                                                      </td>
                                                     <?php } ?>
                                                </tr>
                                                <?php }  }
                                                foreach($members as $member){ 
                                                  if($member['position'] == "Member"){ ?>
                                                <tr>
                                                    <td>
                                                     <img alt="" src="<?php echo base_url().'assets/student/profile_pic/'.$member['profile_pic'].'?'.rand(1, 100); ?>"> <a class="user-link" href="<?php echo base_url().'student/'.$member['username'];?>" style="color:inherit;"><?php echo $member['first_name']." ".$member['middle_name']." ".$member['last_name']; ?></a>
                                                    </td>
                                                    <td class="text-center">
                                                      <span class="badge badge-success"><?php echo $member['position']; ?></span></td>
                                                    <td>
                                                      <a href="mailto:<?php echo $member['up_mail']; ?>"  style="color: #008b8b;"><?php echo $member['up_mail']; ?></a>
                                                    </td>
                                                     <?php if($account_type == 'org') {?>
                                                      <td>
                                                      <button class="btn btn-sm btn-info" onclick="changePosition(' <?php echo $member['first_name'].' '.$member['middle_name'].' '.$member['last_name']; ?>', '<?php echo $member['student_id']; ?>')" type="button" id="changePosBTN">Edit Position</button><br><br>
                                                      <button class="btn btn-sm btn-danger" onclick="removeMember(' <?php echo $member['first_name'].' '.$member['middle_name'].' '.$member['last_name']; ?>', '<?php echo $member['acronym']; ?>', '<?php echo $member['student_id']; ?>')" type="button" id="removeBTN">Remove</button>
                                                      </td>
                                                     <?php } ?>
                                                </tr>
                                                <?php }  } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <?php if($account_type=="org"){ ?> 
                            <div id="orgApplications" style="display: none;">
                                <div class="main-box clearfix">
                                  <div class="table-responsive">
                                    <table class="table user-list">
                                      <thead>
                                        <tr>
                                          <th><span>Student Name</span></th>
                                          <th><span>Action</span></th>
                                        </tr>
                                      </thead>

                                      <?php foreach($orgapps as $applicant){ ?>
                                      <tbody>
                                        <tr>
                                          <td>
                                            <img alt="" src="<?php echo base_url().'assets/student/profile_pic/'.$applicant['profile_pic'].'?'.rand(1, 100); ?>"> <a class="user-link" href="<?php echo base_url().'student/'.$applicant['username'];?>" style="color:inherit;"><?php echo $applicant['first_name']." ".$applicant['middle_name']." ".$applicant['last_name']; ?></a>
                                          </td>
                                          <td align=right>
                                             <button class="btn btn-success" onclick="studApproved(' <?php echo $applicant['first_name'].' '.$applicant['middle_name'].' '.$applicant['last_name']; ?> ', '<?php echo $applicant['acronym']; ?>', '<?php echo $applicant['student_id']; ?>')" type="button" id="approveBTN">Approve</button>
                                             <button class="btn btn-danger" onclick="studReject(' <?php echo $applicant['first_name'].' '.$applicant['middle_name'].' '.$applicant['last_name']; ?>', '<?php echo $applicant['student_id']; ?>')" type="button" id="rejectBTN">Reject</button>
                                          </td>
                                        </tr>
                                      </tbody>
                                      <?php } ?>


                                    </table>
                                  </div>
                                </div>
                            </div>
                            <?php } ?>

                            <?php if($account_type == 'org') {?>
                            <div id="orgAdminAnnouncements" style="display: none;">
                                <?php foreach($announcements as $announcement){ ?>
                                <div class="stream-post">
                                    <div class="sp-author">
                                        <a class="sp-author-avatar" href="#"><img alt="" src="<?php echo base_url();?>img/UP%20logo.png"></a>
                                        <h6 class="sp-author-name"><a href="#"><?php echo $announcement['admin_name']; ?></a></h6>
                                    </div>
                                    <div class="sp-content">
                                        <div class="sp-info">
                                          <h6 style="color: #3f3f3f; font-size: 18px; font-weight: bold;"><?php echo $announcement['title']; ?></h6>
                                              <?php echo date("g:i:s a |  F j, Y", strtotime($announcement['date_posted'])); ?>
                                        </div>
                                        <p class="sp-paragraph mb-0">  <?php echo $announcement['content']; ?></p>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                             <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</body>
</html>
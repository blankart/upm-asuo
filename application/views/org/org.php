<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="UPCS" name="author">
    <title>UP Organizations</title>
</head>
<body>
    <script>
               $(document).ready(function(){
                   dispOrgPosts();
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
       
                });
       
                function dispOrgPosts(){
                   $("#orgMembersBut").removeClass('active');
                   $("#orgApplicationsBut").removeClass('active');
                   $("#orgAdminAnnouncementsBut").removeClass('active');
                   $("#orgMembers").hide();
                   $("#orgApplications").hide();
                   $("#orgAdminAnnouncements").hide();
                   $("#orgPosts").fadeIn(400);
                   $("#orgPostsBut").addClass('active');
                }
                function dispOrgMembers(){
                   $("#orgPostsBut").removeClass('active');
                   $("#orgApplicationsBut").removeClass('active');
                   $("#orgAdminAnnouncementsBut").removeClass('active');
                   $("#orgPosts").hide();
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
                   $("#orgApplications").fadeIn(400);
                   $("#orgApplicationsBut").addClass('active');
                }
    </script>
    <div class="header" style="padding-top: 80px; text-align: center; color: white;">
        <h1 style="font-size: 40px; font-family: Lato;">Hi <?php echo $profile['acronym']; ?>!</h1>
    </div>
    <div class="animated fadeIn" style="background-color: rgb(255,255,255); margin-top: 40px; padding-top: 50px; box-shadow: 0 0 40px rgba(0,0,0,.50); padding-bottom: 50px;">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="card" id="ProfileDetails" style="box-shadow: 0 0 40px rgba(0,0,0,.2);">
                        <div class="card-header" style="background-color: rgb(123,17,19); text-align: center;">
                            <h4 style="color: white;">Profile Details</h4>
                        </div>
                        <div class="card-body">
                            <img src="<?php echo base_url().'assets/org/logo/'.$profile['org_logo'].'?'.rand(1, 100); ?>" style="position: relative; margin-left: 80px; border-radius: 50%; border-style: solid; border-width: medium; border-color: white; box-shadow: 0 0 40px rgba(0,0,0,.2); align-items: center;" width="150">
                            <h3 style="text-align: center; margin-bottom: 5   px; margin-top: 30px;"><strong><?php echo $profile['org_name']; ?></strong></h3>
                            <h6 style="text-align: center; margin-bottom: 30px;"><strong><?php echo $profile['acronym']; ?></strong></h6>
                            <p style="text-align: center;"><?php echo $profile['org_category']; ?></p>
                            <hr>
                            <button class="btn btn-danger btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" data-target="#editprofile">Edit Profile</button> <a class="btn btn-danger btn-block" style="margin-top: 10px;" type="button" href="<?php echo base_url(); ?>org/applyforaccreditation">Apply for Accreditation</a><button class="btn btn-danger btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" data-target="#createposts">Create Post</button>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card" style="box-shadow: 0 0 40px rgba(0,0,0,.2)">
                        <div class="card-body">
                            <button class="btn btn-light btn-lg active" id="orgPostsBut" type="button">Posts</button> <button class="btn btn-light btn-lg" id="orgMembersBut" style="margin-left: 15px;" type="button">Members</button> <button class="btn btn-light btn-lg" id="orgApplicationsBut" style="margin-left: 15px;" type="button">Applications</button> <button class="btn btn-light btn-lg" id="orgAdminAnnouncementsBut" style="margin-left: 15px;" type="button">Admin Announcements</button>
                            <hr>
                            <div id="orgPosts">
                              
                            </div>
                            <div id="orgMembers" style="display: none;">
                                <div class="main-box clearfix">
                                    <div class="table-responsive">
                                        <table class="table user-list">
                                            <thead>
                                                <tr>
                                                    <th><span>Student Name</span></th>
                                                    <th><span>Joined</span></th>
                                                    <th class="text-center"><span>Status</span></th>
                                                    <th><span>Email</span></th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             <?php foreach($members as $member){ ?>
                                                <tr>
                                                    <td>
                                                        <img alt="" src="<?php echo base_url();?>img/UP logo.png"> <a class="user-link" href="#"><?php echo $member['first_name']; ?> <?php echo $member['last_name']; ?></a>
                                                    </td>
                                                    <td>2013/08/12</td>
                                                    <td class="text-center"><span class="badge badge-success">Active</span></td>
                                                    <td>
                                                        <a href="#"><?php echo $member['up_mail']; ?></a>
                                                    </td>
                                                    <td style="width: 20%;">
                                                        <a class="table-link" href="#"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-pencil fa-stack-1x fa-inverse"></i></span></a> <a class="table-link danger" href="#"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i></span></a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="orgApplications" style="display: none;">
                                orgApplications
                            </div>
                            <div id="orgAdminAnnouncements" style="display: none;">
                                <?php foreach($announcements as $announcement){ ?>
                                <div class="stream-post">
                                    <div class="sp-author">
                                        <a class="sp-author-avatar" href="#"><img alt="" src="<?php echo base_url();?>img/UP%20logo.png"></a>
                                        <h6 class="sp-author-name"><a href="#"><?php echo $announcement['admin_name']; ?></a></h6>
                                    </div>
                                    <div class="sp-content">
                                        <div class="sp-info">
                                          <h6><?php echo $announcement['title']; ?></h6>
                                              <?php echo $announcement['date_posted']; ?>
                                        </div>
                                        <p class="sp-paragraph mb-0">  <?php echo $announcement['content']; ?></p>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</body>
</html>
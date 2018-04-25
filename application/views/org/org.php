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
        <h1 style="font-size: 40px; font-family: Lato;">Hi UP Sample Org!</h1>
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
                            <img src="<?php echo base_url();?>img/UP%20logo.png" style="position: relative; margin-left: 80px; border-radius: 50%; border-style: solid; border-width: medium; border-color: white; box-shadow: 0 0 40px rgba(0,0,0,.2); align-items: center;" width="150">
                            <h3 style="text-align: center; margin-bottom: 30px; margin-top: 30px;"><strong>UP Sample Org</strong></h3>
                            <p style="text-align: center;">Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non.</p>
                            <hr>
                            <button class="btn btn-danger btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" data-target="#editprofile">Edit profile</button> <button class="btn btn-danger btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" data-target="#applyforaccreditation">Apply for Accrediation</button><button class="btn btn-danger btn-block" style="margin-top: 10px;" type="button" data-toggle="modal" data-target="#createposts">Create Post</button>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card" style="box-shadow: 0 0 40px rgba(0,0,0,.2)">
                        <div class="card-body">
                            <button class="btn btn-light btn-lg active" id="orgPostsBut" type="button">Posts</button> <button class="btn btn-light btn-lg" id="orgMembersBut" style="margin-left: 15px;" type="button">Members</button> <button class="btn btn-light btn-lg" id="orgApplicationsBut" style="margin-left: 15px;" type="button">Applications</button> <button class="btn btn-light btn-lg" id="orgAdminAnnouncementsBut" style="margin-left: 15px;" type="button">Admin Announcements</button>
                            <hr>
                            <div id="orgPosts">
                                <div class="stream-post">
                                    <div class="sp-author">
                                        <a class="sp-author-avatar" href="#"><img alt="" src="<?php echo base_url();?>img/UP%20logo.png"></a>
                                        <h6 class="sp-author-name"><a href="#">UP Sample Org</a></h6>
                                    </div>
                                    <div class="sp-content">
                                        <div class="sp-info">
                                            April 16, 2018 11:36pm
                                        </div>
                                        <p class="sp-paragraph mb-0">Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non.</p>
                                    </div>
                                </div>
                                <div class="stream-post">
                                    <div class="sp-author">
                                        <a class="sp-author-avatar" href="#"><img alt="" src="<?php echo base_url();?>img/UP%20logo.png"></a>
                                        <h6 class="sp-author-name"><a href="#">UP Sample Org</a></h6>
                                    </div>
                                    <div class="sp-content">
                                        <div class="sp-info">
                                            April 16, 2018 11:36pm
                                        </div>
                                        <p class="sp-paragraph mb-0">Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non.</p>
                                    </div>
                                </div>
                                <div class="stream-post">
                                    <div class="sp-author">
                                        <a class="sp-author-avatar" href="#"><img alt="" src="<?php echo base_url();?>img/UP%20logo.png"></a>
                                        <h6 class="sp-author-name"><a href="#">UP Sample Org</a></h6>
                                    </div>
                                    <div class="sp-content">
                                        <div class="sp-info">
                                            April 16, 2018 11:36pm
                                        </div>
                                        <p class="sp-paragraph mb-0">Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non.</p>
                                    </div>
                                </div>
                                <div class="stream-post">
                                    <div class="sp-author">
                                        <a class="sp-author-avatar" href="#"><img alt="" src="<?php echo base_url();?>img/UP%20logo.png"></a>
                                        <h6 class="sp-author-name"><a href="#">UP Sample Org</a></h6>
                                    </div>
                                    <div class="sp-content">
                                        <div class="sp-info">
                                            April 16, 2018 11:36pm
                                        </div>
                                        <p class="sp-paragraph mb-0">Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non.</p>
                                    </div>
                                </div>
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
                                                <tr>
                                                    <td>
                                                        <img alt="" src="<?php echo base_url();?>img/UP logo.png"> <a class="user-link" href="#">Sample Name 1</a>
                                                    </td>
                                                    <td>2013/08/12</td>
                                                    <td class="text-center"><span class="badge badge-success">Active</span></td>
                                                    <td>
                                                        <a href="#">sample@samplemail.com</a>
                                                    </td>
                                                    <td style="width: 20%;">
                                                        <a class="table-link" href="#"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-pencil fa-stack-1x fa-inverse"></i></span></a> <a class="table-link danger" href="#"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i></span></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img alt="" src="<?php echo base_url();?>img/UP logo.png"> <a class="user-link" href="#">Sample Name 2</a> 
                                                    </td>
                                                    <td>2013/03/03</td>
                                                    <td class="text-center"><span class="badge badge-danger">Banned</span></td>
                                                    <td>
                                                        <a href="#">sample@samplemail.com</a>
                                                    </td>
                                                    <td style="width: 20%;">
                                                        <a class="table-link" href="#"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-pencil fa-stack-1x fa-inverse"></i></span></a> <a class="table-link danger" href="#"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i></span></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img alt="" src="<?php echo base_url();?>img/UP logo.png"> <a class="user-link" href="#">Sample Name 3</a>
                                                    </td>
                                                    <td>2004/01/24</td>
                                                    <td class="text-center"><span class="badge badge-warning">Pending</span></td>
                                                    <td>
                                                        <a href="#">sample@samplemail.com</a>
                                                    </td>
                                                    <td style="width: 20%;">
                                                        <a class="table-link" href="#"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-pencil fa-stack-1x fa-inverse"></i></span></a> <a class="table-link danger" href="#"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i></span></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img alt="" src="<?php echo base_url();?>img/UP logo.png"> <a class="user-link" href="#">Sample Name 4</a>
                                                    </td>
                                                    <td>2013/12/31</td>
                                                    <td class="text-center"><span class="badge badge-success">Active</span></td>
                                                    <td>
                                                        <a href="#">sample@samplemail.com</a>
                                                    </td>
                                                    <td style="width: 20%;">
                                                        <a class="table-link" href="#"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-pencil fa-stack-1x fa-inverse"></i></span></a> <a class="table-link danger" href="#"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i></span></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img alt="" src="<?php echo base_url();?>img/UP logo.png"> <a class="user-link" href="#">Sample Name 5</a>
                                                    </td>
                                                    <td>2013/08/08</td>
                                                    <td class="text-center"><span class="badge badge-primary">Inactive</span></td>
                                                    <td>
                                                        <a href="#">sample@samplemail.com</a>
                                                    </td>
                                                    <td style="width: 20%;">
                                                        <a class="table-link" href="#"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-pencil fa-stack-1x fa-inverse"></i></span></a> <a class="table-link danger" href="#"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i></span></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img alt="" src="<?php echo base_url();?>img/UP logo.png"> <a class="user-link" href="#">Sample Name 6</a>
                                                    </td>
                                                    <td>2013/08/12</td>
                                                    <td class="text-center"><span class="badge badge-success">Active</span></td>
                                                    <td>
                                                        <a href="#">sample@samplemail.com</a>
                                                    </td>
                                                    <td style="width: 20%;">
                                                        <a class="table-link" href="#"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-pencil fa-stack-1x fa-inverse"></i></span></a> <a class="table-link danger" href="#"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i></span></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img alt="" src="<?php echo base_url();?>img/UP logo.png"> <a class="user-link" href="#">Sample Name 7</a>
                                                    </td>
                                                    <td>2013/03/03</td>
                                                    <td class="text-center"><span class="badge badge-danger">Banned</span></td>
                                                    <td>
                                                        <a href="#">sample@samplemail.com</a>
                                                    </td>
                                                    <td style="width: 20%;">
                                                        <a class="table-link" href="#"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-pencil fa-stack-1x fa-inverse"></i></span></a> <a class="table-link danger" href="#"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i></span></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img alt="" src="<?php echo base_url();?>img/UP logo.png"> <a class="user-link" href="#">Sample Name 8</a>
                                                    </td>
                                                    <td>2004/01/24</td>
                                                    <td class="text-center"><span class="badge badge-warning">Pending</span></td>
                                                    <td>
                                                        <a href="#">sample@samplemail.com</a>
                                                    </td>
                                                    <td style="width: 20%;">
                                                        <a class="table-link" href="#"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-pencil fa-stack-1x fa-inverse"></i></span></a> <a class="table-link danger" href="#"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i></span></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img alt="" src="<?php echo base_url();?>img/UP logo.png"> <a class="user-link" href="#">Sample Name 9</a>
                                                    </td>
                                                    <td>2013/12/31</td>
                                                    <td class="text-center"><span class="badge badge-success">Active</span></td>
                                                    <td>
                                                        <a href="#">sample@samplemail.com</a>
                                                    </td>
                                                    <td style="width: 20%;">
                                                        <a class="table-link" href="#"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-pencil fa-stack-1x fa-inverse"></i></span></a> <a class="table-link danger" href="#"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i></span></a>
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td>
                                                        <img alt="" src="<?php echo base_url();?>img/UP logo.png"> <a class="user-link" href="#">Sample Name 10</a>
                                                    </td>
                                                    <td>2013/08/08</td>
                                                    <td class="text-center"><span class="badge badge-primary">Inactive</span></td>
                                                    <td>
                                                        <a href="#">sample@samplemail.com</a>
                                                    </td>
                                                    <td style="width: 20%;">
                                                        <a class="table-link" href="#"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-pencil fa-stack-1x fa-inverse"></i></span></a> <a class="table-link danger" href="#"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i></span></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="orgApplications" style="display: none;">
                                orgApplications
                            </div>
                            <div id="orgAdminAnnouncements" style="display: none;">
                                <div class="stream-post">
                                    <div class="sp-author">
                                        <a class="sp-author-avatar" href="#"><img alt="" src="<?php echo base_url();?>img/UP%20logo.png"></a>
                                        <h6 class="sp-author-name"><a href="#">OSA</a></h6>
                                    </div>
                                    <div class="sp-content">
                                        <div class="sp-info">
                                            April 16, 2018 11:36pm
                                        </div>
                                        <h4>Title here</h4> 
                                        <p class="sp-paragraph mb-0">Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non.</p>
                                    </div>
                                </div>
                                <div class="stream-post">
                                    <div class="sp-author">
                                        <a class="sp-author-avatar" href="#"><img alt="" src="<?php echo base_url();?>img/UP%20logo.png"></a>
                                        <h6 class="sp-author-name"><a href="#">OSA</a></h6>
                                    </div>
                                    <div class="sp-content">
                                        <div class="sp-info">
                                            April 16, 2018 11:36pm
                                        </div>
                                        <h4>Title here</h4>
                                        <p class="sp-paragraph mb-0">Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non.</p>
                                    </div>
                                </div>
                                <div class="stream-post">
                                    <div class="sp-author">
                                        <a class="sp-author-avatar" href="#"><img alt="" src="<?php echo base_url();?>img/UP%20logo.png"></a>
                                        <h6 class="sp-author-name"><a href="#">OSA</a></h6>
                                    </div>
                                    <div class="sp-content">
                                        <div class="sp-info">
                                            April 16, 2018 11:36pm
                                        </div>
                                        <h4>Title here</h4>
                                        <p class="sp-paragraph mb-0">Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non.</p>
                                    </div>
                                </div>
                                <div class="stream-post">
                                    <div class="sp-author">
                                        <a class="sp-author-avatar" href="#"><img alt="" src="<?php echo base_url();?>img/UP%20logo.png"></a>
                                        <h6 class="sp-author-name"><a href="#">OSA</a></h6>
                                    </div>
                                    <div class="sp-content">
                                        <div class="sp-info">
                                            April 16, 2018 11:36pm
                                        </div>
                                        <h4>Title here</h4>
                                        <p class="sp-paragraph mb-0">Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non. Lorem ispsum dolor sit amet, consectetur adipiscing elit. Integer eget egestas quam. Nulla sodales purus nisi, vitae cursus ipsum maximus non.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</body>
</html>
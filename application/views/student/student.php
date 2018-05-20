<!-- JS code -->
<?php
	$account_type = $this->session->userdata['account_type'];

	if($account_type == 'admin' || $account_type == 'org'){

		$isStudent = false;

	}
	else{
		$isStudent = true;
	}
?>
<!DOCTYPE html>
<html>
<head>
	</style>
	<meta charset="utf-8">
	<meta content="UPCS" name="author">
	<title>UP Organizations</title>
</head>
<body>
	<script>
    		$(window).scroll(function(){
    			if ($(this).scrollTop() > 50){
    				$('#nav-bar').addClass('opaque');
    			}
    			else{
    				$('#nav-bar').removeClass('opaque');
    			}
    		});
    	</script>
	<script>
		function viewOrgInfo(orgID)
       {
           $.ajax({
        type:"post",
        url:"<?php echo base_url(); ?>admin/viewOrgInfo",
        cache: false,
        data:{id: orgID},
        dataType: 'json',
        async: false,
        success:function(result){
          swal({
       imageUrl: "<?php echo base_url();?>"+"img/logo.jpg",
       html: true,
       title: "<h4>"+result['org_name']+"</h4>",
       text: "<div class='container' style='margin-top: 20px;'>"+
                "<div class='row' style='text-align: left;'>"+
                   "<div class='col'>"+
                      "<h4 style='font-size: 18px'><strong>Date Established</strong></h4>"+
                      "<h4 style='font-size: 18px'><strong>Org Acronym</strong></h4>"+
                      "<h4 style='font-size: 18px'><strong>Org Category</strong></h4>"+
                      "<h4 style='font-size: 18px'><strong>Description</strong></h4>"+
                      "<h4 style='font-size: 18px'><strong>Objectives</strong></h4>"+
                      "<h4 style='font-size: 18px'><strong>Organization Website</strong></h4>"+
                      "<h4 style='font-size: 18px'><strong>Mailing Address</strong></h4>"+
                      "</div>"+
                   "<div class='col'>"+
                      "<h4 style='font-size: 18px'>"+result['date_established']+"</h4>"+
                      "<h4 style='font-size: 18px'>"+result['acronym']+"</h4>"+
                      "<h4 style='font-size: 18px'>"+result['org_category']+"</h4>"+
                      "<h4 style='font-size: 18px'>"+result['description']+"</h4>"+
                      "<h4 style='font-size: 18px'>"+result['objectives']+"</h4>"+
                      "<h4 style='font-size: 18px'>"+result['org_website']+"</h4>"+
                      "<h4 style='font-size: 18px'>"+result['mailing_address']+"</h4>"+
                      "</div>"+
                   "</div>"+
                "</div>"
       },
       function(){
       
       
       });
       }
       });
       }
	   $(document).ready(function(){
	   	<?php if(!$isStudent){?>
	   		dispStudProfile();
	   	<?php } else{ ?>
	     dispAnnouncements();
	    <?php } ?>
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
	<div class="header" style="padding-top: 80px; text-align: center; color: white;">
		<?php if($isStudent){ ?> <h1 style="font-size: 40px; font-family: Lato; color: white">Hi <?php echo $profile['first_name']; ?>!</h1> <?php } ?>
	</div><br>
	<div style="background-color: rgb(255,255,255); margin-top: 40px; padding-top: 50px; box-shadow: 0 0 40px rgba(0,0,0,.50); padding-bottom: 50px;">
		<div class="container animated fadeIn">
			<div class="row">
				<div class="col-3">
					<div class="card" id="studentProfile" style="box-shadow: 0 0 40px rgba(0,0,0,.2)">
						<div class="card-header">
							<h5 style="color: white;">Profile Details</h5>
						</div>
						<div class="card-body">
							<div class='wrapper'><img class='profileicon' src="<?php echo base_url().'assets/student/profile_pic/'.$profile['profile_pic'].'?'.rand(1, 1000);?>"></div>
							<h3 style="text-align: center; margin-bottom: 5 px; margin-top: 30px;"><strong><?php echo $profile['first_name']; ?> <?php echo $profile['last_name']; ?></strong></h3>
							<h6 style="text-align: center; margin-bottom: 30px;"><strong><?php echo $profile['course']; ?>, <?php echo $profile['year_level']; ?></strong></h6>
							<p style="text-align: center;"><?php echo $profile['up_mail']; ?></p>
							<hr>
							<?php if($isStudent){ ?>
							<button class="btn btn-danger btn-block" data-target="#editStudentProfile" data-toggle="modal" style="margin-top: 10px;" type="button">Edit Profile</button>
							<?php } ?>

						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="card" style="box-shadow: 0 0 40px rgba(0,0,0,.2);">
						<div class="card-header">

							<?php if(!$isStudent){ ?>
							<button class="btn btn-light btn-sm" id="studProfileBTN" style="margin-left: 15px;" type="button">About <?php echo $profile['first_name']; ?></button>
							<?php } ?>

							<?php if($isStudent){ ?>
							<button class="btn btn-light btn-sm active" id="announcementsBTN" type="button">Announcements</button> 
							<?php } ?>

							<?php if($isStudent){ ?>
							<button class="btn btn-light btn-sm" id="myOrgsBTN" style="margin-left: 15px;" type="button">My Organizations</button>
							<?php } ?>

							<?php if(!$isStudent){ ?>
							<button class="btn btn-light btn-sm" id="myOrgsBTN" style="margin-left: 15px;" type="button"><?php echo $profile['first_name']; ?>'s Organizations</button>
							<?php } ?>

						</div>

						<?php if($isStudent){ ?>
						<div class="card-body" style=" height: 600px; overflow-y: scroll;">
								<div id="announcements" style="display:none;">
								<?php foreach($orgposts as $orgpost){ 
                                                      ?>
								<div class="stream-post">
									<div class="sp-author">
										<a class="sp-author-avatar" href="<?php echo base_url().'org/'.str_replace(' ', '', $orgpost['acronym']); ?>"><img alt="" src="<?php echo base_url().'assets/org/logo/'.$orgpost['org_logo'].'?'.rand(1, 100); ?>"></a>
										<h6 class="sp-author-name"><a href="#"><?php echo $orgpost['acronym']; ?></a></h6>
									</div>
									<div class="sp-content">
										<div class="sp-info">
											<h6><?php echo $orgpost['title']; ?></h6><?php echo date("g:i:s a |  F j, Y", strtotime($orgpost['date_posted'])) ?>
										</div>
										<p class="sp-paragraph mb-0"><?php echo $orgpost['content']; ?></p>
									</div>
								</div>
							<?php } ?>
							</div>
							<?php } ?>
							

							<div id="studProfile" style="display:none;">
								<div class="well profile text-center">
									<img alt="avatar" class="avatar img-thumbnail" height="250px" src="<?php echo base_url().'assets/student/profile_pic/'.$profile['profile_pic'];?>" width="250px"><br>
									<br>
									<h2><?php echo $profile['first_name']; ?> <?php echo $profile['last_name']; ?></h2>
									<p><strong><?php echo $profile['course']; ?>, <?php echo $profile['year_level']; ?></strong></p>
									<p><a href=""><?php echo $profile['up_mail']; ?></a> || <?php echo $profile['contact_num']; ?></p>
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
											<?php foreach($orgs as $org){?>
											<tr>
												<td>
													<a class="org-link" href="<?php echo base_url().'org/'.str_replace(' ', '', $org['acronym']); ?>"><img alt="orgLogo" src="<?php echo base_url().'assets/org/logo/'.$org['org_logo'].'?'.rand(1, 100); ?>" style="max-height: 80px" title="ACRONYM"></a>
												</td>
												<td><?php echo $org['position'];?></td>
												<td><?php echo $org['org_email'];?></td>
											</tr>
										<?php }?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

				<?php if($isStudent){ ?>
				<div class="col-3">
					<div class="card" id="applications" style="box-shadow: 0 0 40px rgba(0,0,0,.2); padding: 0 !important;">
						<div class="card-header" style="background-color: rgb(123,17,19); text-align: center;">
							<h5 style="color: white;">My Applications</h5>
						</div>
						<div class="card-body">
							<div id="myApplications" style="height:400px; overflow-y: auto; overflow-x: hidden;">
								<?php foreach($applications as $application){ ?>
								<table class="table table-hover">
									<tbody>
										<tr>
											<td>
												<div class="hovereffect">
													<img alt="orgLogo" class="img-responsive" src="<?php echo base_url().'assets/org/logo/'.$application['org_logo'].'?'.rand(1, 100); ?>" style="max-height:170px; overflow:auto;">
													<div class="overlay">
														<h2><?php echo $application['acronym'];?></h2><a class="info" onclick="viewOrgInfo(<?php echo $application['org_id'];?>)">Details</a>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>

				<?php } ?>
			</div>
		</div>
	</div>
</body>
</html>
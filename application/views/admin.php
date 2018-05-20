<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="author" content="UPCS">
      <title>UP Organizations</title>
	  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
      <style>
   </style>
   </head>
   <body>
      <div class="container animated fadeIn">
         <div class="row" style="margin-top: 150px; margin-left: 80px;">
            <div class="col">
               <div class="card" style="width: 25rem; padding-bottom: 10px; box-shadow: 0 0 40px rgba(0,0,0,.05);">
                  <div class="card-header">
                     Manage All Accounts
                  </div>
                  <div class="card-body" style="padding-top: 0px;">
                     <br><button type="button" onclick="validatestudactSearch()" class="btn btn-danger admin-button" data-toggle="modal" data-target="#validatestudact">
						<i class="fa fa-check-circle-o fa-2x pull-left"></i>Validate Student Account</button></br>
                     <br><button type="button" onclick="activateorgactSearch()" class="btn btn-danger admin-button" data-toggle="modal" data-target="#activateorgact">
						<i class="fa fa-check-circle fa-2x pull-left"></i>Activate Organization Account</button></br>
                     <br><button type="button" onclick="livesearchallstud()" class="btn btn-danger admin-button" data-toggle="modal" data-target="#viewallstudents">
						<i class="fa fa-user fa-2x pull-left"></i>View All Student Accounts</button></br>
                     <br><button type="button" onclick="livesearchallorg()" class="btn btn-danger admin-button" data-toggle="modal" data-target="#viewallorg">
						<i class="fa fa-users fa-2x pull-left"></i>View All Organization Accounts</button></br>
                     <br><button type="button" onclick="" class="btn btn-danger admin-button" data-toggle="modal" data-target="#changeloginnotice">
						<i class="fa fa-edit fa-2x pull-left"></i>Change Login Notice</button></br>
               
                  </div>
               </div>
            </div>
            <div class="col">
               <div class="card" style="width: 25rem; padding-bottom: 10px; box-shadow: 0 0 40px rgba(0,0,0,.05);">
                  <div class="card-header">
                     Org Accreditation
                  </div>
                  <div class="card-body" style="padding-top: 0px;">
                 <br><button type="button" onclick="searchBox('Pending')" class="btn btn-danger admin-button" data-toggle="modal" data-target="#viewaccreditapp">
					<i class="fa fa-folder-open fa-2x pull-left"></i>View Accreditation Applications</button></br>
                 <br><button type="button" class="btn btn-danger admin-button" data-toggle="modal" data-target="#openaccreditperiod">
<<<<<<< Updated upstream
					<a><i class="fa fa-calendar" style='margin-right: 20px;'></i>Open Accreditation Period</a></button></br>
=======
					<i class="fa fa-calendar fa-2x pull-left"></i>Open Accreditation Period</button></br>
>>>>>>> Stashed changes
                  </div>
               </div>
               <div class="card" style="margin-top: 30px; width: 25rem;">
               <div class="card-header">
                  Announcement
               </div>
                  <div class="card-body" style="padding-top: 0px;">
                 <br><button type="button" onclick="searchSendNotice()" class="btn btn-danger admin-button" data-toggle="modal" data-target="#sendnotice">
						<i class="fas fa-paper-plane pull-left"></i>Send Announcement</button></br>
                    <br><button type="button" onclick="viewAllNotices()" class="btn btn-danger admin-button" data-toggle="modal" data-target="#viewallnotices">
						<i class="fa fa-envelope-o fa-2x pull-left"></i>View All Announcements</button></br>
                  </div>
               </div>
            </div>
         </div>         
      </div>
   </body>
</html>
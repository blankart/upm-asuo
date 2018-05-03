<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="author" content="UPCS">
      <title>UP Organizations</title>
      <style>
      

   </style>
   </head>
   <body>
      <div class="container animated fadeIn">
         <div class="row" style="margin-top: 150px; margin-left: 80px;">
            <div class="col">
               <div class="card" style="width: 25rem; padding-bottom: 10px; box-shadow: 0 0 40px rgba(0,0,0,.05);">
                  <div class="card-header">
                     Manage All Acounts
                  </div>
                  <div class="card-body" style="padding-top: 0px;">
                     <br><button type="button" onclick="validatestudactSearch()" class="btn btn-danger admin-button" data-toggle="modal" data-target="#validatestudact">Validate Student Account</button></br>
                     <br><button type="button" onclick="activateorgactSearch()" class="btn btn-danger admin-button" data-toggle="modal" data-target="#activateorgact">Activate Organization Account</button></br>
                     <br><button type="button" onclick="livesearchallstud()" class="btn btn-danger admin-button" data-toggle="modal" data-target="#viewallstudents">View All Student Accounts</button></br>
                    
                     <br><button type="button" onclick="livesearchallorg()" class="btn btn-danger admin-button" data-toggle="modal" data-target="#viewallorg">View All Organization Accounts</button></br>
               
                  </div>
               </div>
            </div>
            <div class="col">
               <div class="card" style="width: 25rem; padding-bottom: 10px; box-shadow: 0 0 40px rgba(0,0,0,.05);">
                  <div class="card-header">
                     Org Accreditation
                  </div>
                  <div class="card-body" style="padding-top: 0px;">
                 <br><button type="button" onclick="searchBox('Pending')" class="btn btn-danger admin-button" data-toggle="modal" data-target="#viewaccreditapp">View Accreditation Applications</button></br>
                  </div>
               </div>
               <div class="card" style="margin-top: 30px; width: 25rem;">
               <div class="card-header">
                  Announcement
               </div>
                  <div class="card-body" style="padding-top: 0px;">
                 <br><button type="button" onclick="searchSendNotice()" class="btn btn-danger admin-button" data-toggle="modal" data-target="#sendnotice">Send Announcement</button></br>
                    <br><button type="button" onclick="viewAllNotices()" class="btn btn-danger admin-button" data-toggle="modal" data-target="#viewallnotices">View All Announcements</button></br>
                  </div>
               </div>
            </div>
         </div>         
      </div>
   </body>
</html>
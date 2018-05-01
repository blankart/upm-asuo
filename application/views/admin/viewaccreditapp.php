<!DOCTYPE html>
<html>
<head>

  <script>
    $(document).ready(function(){
      $("#approvedBtn").click(function(){
        $("#accreditedTab").hide();
        $("#pendingTab").hide();
        $("#unaccreditedTab").hide();
      });
    });
   function _(x){
     return document.getElementById(x);
   } 

   function viewAllOrg(orgID){
     _("orgMatches").style.display = "block";
   }

   function searchBox(){
       var search = $("#orgID").val();
       $.ajax({
         type:"post",
         url:"<?php echo base_url(); ?>admin/searchAccredApp",
         cache: false,
         data:{query: search, source: 'admin'},
         dataType: 'json',
         async: false,
         success:function(result){
           var output = "<div class='container' id='searchValidate'>" +
                        "<table class='table table-striped custab'>"+
                        "<thead>"+
                        "<tr>"+
                        "<th>Organization ID<\/th>"+
                        "<th>Organization Name<\/th>"+
                        "<th class='text-center'>Action<\/th>"+
                        "<\/tr>"+
                        "<\/thead>";
            output+="<div id='unaccreditedTab' style='display: none;'>";
           for (var key in result) {
            
             if (result.hasOwnProperty(key)) {
              if (result[key]['org_status'] == "Unaccredited")
              {
               output+="<tr>"+
                       "<td>"+result[key]['org_id']+"<\/td>"+
                       "<td>"+result[key]['org_name']+"<\/td>"+
                       //actions
                       "<td class='text-center'><button class='btn btn-info btn-xs' onclick='viewDocuments("+result[key]['org_id']+")' style='margin-left: 10px;'>View Documents<\/button>" + 
                       "<button onclick='accredit("+result[key]['org_id']+")' class='btn btn-success btn-xs' style='margin-left: 10px;'>Accredit<\/button>" +
                       "<button onclick='reject("+result[key]['org_id']+")' class='btn btn-danger btn-xs' style='margin-left: 10px;'>Reject<\/button><\/td>" +
                       "<\/tr>";
              }
             }
           }
           output+="<\/div>";
           output+="<div id='pendingTab' style='display: none;'>";
           for (var key in result) {
            
             if (result.hasOwnProperty(key)) {
              if (result[key]['org_status'] == "Pending")
              {
               output+="<tr>"+
                       "<td>"+result[key]['org_id']+"<\/td>"+
                       "<td>"+result[key]['org_name']+"<\/td>"+
                       //actions
                       "<td class='text-center'><button class='btn btn-info btn-xs' onclick='viewDocuments("+result[key]['org_id']+")' style='margin-left: 10px;'>View Documents<\/button>" + 
                       "<button onclick='accredit("+result[key]['org_id']+")' class='btn btn-success btn-xs' style='margin-left: 10px;'>Accredit<\/button>" +
                       "<button onclick='reject("+result[key]['org_id']+")' class='btn btn-danger btn-xs' style='margin-left: 10px;'>Reject<\/button><\/td>" +
                       "<\/tr>";
              }
             }
           }
           output+="<\/div>";
           output+="<div id='accreditedTab' style='display: none;'>";
           for (var key in result) {
            
             if (result.hasOwnProperty(key)) {
              if (result[key]['org_status'] == "Accredited")
              {
               output+="<tr>"+
                       "<td>"+result[key]['org_id']+"<\/td>"+
                       "<td>"+result[key]['org_name']+"<\/td>"+
                       //actions
                       "<td class='text-center'><button class='btn btn-info btn-xs' onclick='viewDocuments("+result[key]['org_id']+")' style='margin-left: 10px;'>View Documents<\/button>" + 
                       "<button onclick='accredit("+result[key]['org_id']+")' class='btn btn-success btn-xs' style='margin-left: 10px;'>Accredit<\/button>" +
                       "<button onclick='reject("+result[key]['org_id']+")' class='btn btn-danger btn-xs' style='margin-left: 10px;'>Reject<\/button><\/td>" +
                       "<\/tr>";
              }
             }
           }
           output+="<\/div>";
           $("#myResult").html(output);
         }
       });
   } //end function

   function accredit(myID){
     swal({
       html: true,
       title: "<h4>Confirm Action<\/h4>",
       text: "Do you want to accredit this organization?",
       type: "warning",
       showCancelButton: true,
       confirmButtonClass: "btn-danger",
       confirmButtonText: "Accredit",
       closeOnConfirm: false
     },
     function(){
       $.ajax({
         type:"post",
         url:"<?php echo base_url(); ?>admin/accreditOrg",
         cache: false,
         data:{id: myID},
         dataType: 'json',
         async: false,
         success:function(result){
           swal("Accredited!", "This organization has been accredited.", "success");
           var search = $("#orgID").val();
           $.ajax({
             type:"post",
             url:"<?php echo base_url(); ?>admin/accreditOrg",
             cache: false,
             data:{query: search},
             dataType: 'json',
             async: false
           });
         }

       });
     });
   }

   function reject(myID){
     swal({
       html: true,
       title: "<h4>Confirm Action<\/h4>",
       text: "Do you want to reject this organization's application?",
       type: "warning",
       showCancelButton: true,
       confirmButtonClass: "btn-danger",
       confirmButtonText: "Reject",
       closeOnConfirm: false
     },
     function(){
       $.ajax({
         type:"post",
         url:"<?php echo base_url(); ?>admin/rejectOrg",
         cache: false,
         data:{id: myID},
         dataType: 'json',
         async: false,
         success:function(result){
           swal("Rejected!", "This organization has been rejected.", "success");
           var search = $("#orgID").val();
           $.ajax({
             type:"post",
             url:"<?php echo base_url(); ?>admin/rejectOrg",
             cache: false,
             data:{query: search},
             dataType: 'json',
             async: false
           });
         }

       });
     });
   }

   function viewDocuments(myID){
     swal("*insert documents here*");
   }


   function resetOrgModal(){
     _("orgsSearch").style.display = "block";
     _("orgMatches").style.display = "none";
   }
  </script>
  <title></title>
</head>
<body>
  <div class="modal animated bounceInUp" data-backdrop="static" data-keyboard="false" id="viewaccreditapp">
    <div class="modal-dialog modal-dialog-centered" style="min-width: 1200px;">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">View Accreditation Applications</h4>
        </div><!-- Modal body -->
        <div class="modal-body">
          <div id="orgSearch">
            <div class="container">
              <div class="mail-box">
                <aside class="lg-side">
                  <div class="inbox-head">
                    <form class="pull-right position needs-validation" onsubmit="return false">
                      <div class="mat-input" style="margin-top: 30px;">
                        <div class="mat-input-outer">
                          <input autocomplete="off" class="form-control" id="orgID" type="username"> <label class="">Enter Organization Name</label>
                          <div class="border"></div>
                        </div><button class="btn btn-danger btn-block" onclick="searchBox()" style="margin-top: 10px;">Search</button>
                      </div>
                      <table class="table table-inbox table-hover">
                        <tbody></tbody>
                      </table>
                    </form>
                  </div>
                  <div class="inbox-body">
                    <button class="btn btn-success" id="approvedBtn" type="button">Approved</button> <button class="btn btn-info" id="pendingBtn" type="button">Pending</button> <button class="btn btn-danger" id="rejectedBtn" type="button">Rejected</button>
                    <div class="mail-option"></div>
                  </div>
                </aside>
              </div>
            </div>
          </div>
        </div>
        <div id="myResult" style="height: 300px; overflow-y: scroll;"></div><!-- Modal footer -->
        <div class="modal-footer">
          <button class="btn btn-danger" data-dismiss="modal" onclick="resetOrgModal()" type="button">Close</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
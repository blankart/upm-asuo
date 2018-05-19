<script>
    function livesearchallorg()
        {
        var search = $("#idInputAllOrg").val();
          $.ajax({
         type:"post",
         url:"<?php echo base_url(); ?>admin/searchAllOrganizations",
         cache: false,
         data:{query: search, source: 'admin'},
         dataType: 'json',
         async: false,
         success:function(result){
         var output = "<div class='container' id='searchValidate'>" +
        "<table class='table table-striped custab'>"+
            "<thead>"+
               "<tr>"+
                  "<th>Organization Name</th>"+
                  "<th>Organization Email</th>"+
                  "<th>Organization Status</th>"+
                  "<th>Account Status</th>"+
                  "<th class='text-center'>Action</th>"+
               "</tr>"+
            "</thead>";
         for (var key in result) {
            if (result.hasOwnProperty(key)) {
              var archived;
            if (result[key]['archived'] == 1)
            {
              archived = "Blocked";
            }
            else archived = "Active";
               output+="<tr>"+
                        "<td>"+result[key]['org_name']+"</td>"+
                        "<td>"+result[key]['org_email']+"</td>"+
                        "<td>"+result[key]['org_status']+"</td>"+
                        "<td>"+archived+"</td>"+
                        "<td class='text-center'><button class='btn btn-info btn-xs' onclick='viewOrgInfo("+result[key]['org_id']+")' style='margin-left: 10px;'>Details</button>";
              if (result[key]['archived'] == 0)
              {
                output+="<button onclick='blockOrgAct("+result[key]['org_id']+")' class='btn btn-danger btn-xs' style='margin-left: 10px;'>Block</button></td></tr>";
              }
              else
              {
                output+="<button onclick='unblockOrgAct("+result[key]['org_id']+")' class='btn btn-success btn-xs' style='margin-left: 10px;'>Unblock</button></td></tr>"
              }
            }
         }
         $("#allorgResult").html(output);
        }
        });
        
        }
       /*
        function changeOrgpw(orgID)
       {
         swal({
           html: true,
           title: "<h4>Change Password</h4>",
           text: "Input new password:",
           type: "input",
           inputType: "password",
           showCancelButton: true,
           closeOnConfirm: false,
           inputPlaceholder: "Password"
         }, function (inputValue) {
           if (inputValue == false) return false;
           if (inputValue == "") {
             return false;
           }
    
           $.ajax({
         type:"post",
         url:"<?php echo base_url(); ?>admin/changeOrgPassword",
         cache: false,
         data:{id: orgID, neworgpassword: inputValue},
         dataType: 'json',
         async: false,
         success:function(result){
          swal("Change Password Successful", "This account's password has been changed.", "success");
          
        }
        });
    
       });
       }*/
    
       function blockOrgAct(orgID)
       {
        swal({
       html: true,
       title: "<h4>Confirm Action</h4>",
       text: "Do you want to block this account?",
       type: "warning",
       showCancelButton: true,
       confirmButtonClass: "btn-danger",
       confirmButtonText: "Block",
       closeOnConfirm: false
       },
       function(){
         $.ajax({
        type:"post",
        url:"<?php echo base_url(); ?>admin/blockOrgAccount",
        cache: false,
        data:{id: orgID},
        dataType: 'json',
        async: false,
        success:function(result){
       swal("Blocked!", "This account has been blocked.", "success");
       var search = $("#idInputAllOrg").val();
          $.ajax({
         type:"post",
         url:"<?php echo base_url(); ?>admin/searchAllOrganizations",
         cache: false,
         data:{query: search, source: 'admin'},
         dataType: 'json',
         async: false,
         success:function(result){
         var output = "<div class='container animated fadeIn' id='searchValidate'>" +
        "<table class='table table-striped custab'>"+
            "<thead>"+
               "<tr>"+
                  "<th>Organization Name</th>"+
                  "<th>Organization Email</th>"+
                  "<th>Organization Status</th>"+
                  "<th>Account Status</th>"+
                  "<th class='text-center'>Action</th>"+
               "</tr>"+
            "</thead>";
         for (var key in result) {
            if (result.hasOwnProperty(key)) {
              var archived;
            if (result[key]['archived'] == 1)
            {
              archived = "Blocked";
            }
            else archived = "Active";
               output+="<tr>"+
                        "<td>"+result[key]['org_name']+"</td>"+
                        "<td>"+result[key]['org_email']+"</td>"+
                        "<td>"+result[key]['org_status']+"</td>"+
                        "<td>"+archived+"</td>"+
                        "<td class='text-center'><button class='btn btn-info btn-xs' onclick='viewOrgInfo("+result[key]['org_id']+")' style='margin-left: 10px;'>Details</button>";
              if (result[key]['archived'] == 0)
              {
                output+="<button onclick='blockOrgAct("+result[key]['org_id']+")' class='btn btn-danger btn-xs' style='margin-left: 10px;'>Block</button></td></tr>";
              }
              else
              {
                output+="<button onclick='unblockOrgAct("+result[key]['org_id']+")' class='btn btn-success btn-xs' style='margin-left: 10px;'>Unblock</button></td></tr>"
              }
            }
         }
         $("#allorgResult").html(output);
        }
        });
       }
    
       });
       });
       }
    
       function unblockOrgAct(orgID)
       {
        swal({
       html: true,
       title: "<h4>Confirm Action</h4>",
       text: "Do you want to unblock this account?",
       type: "warning",
       showCancelButton: true,
       confirmButtonClass: "btn-success",
       confirmButtonText: "Unblock",
       closeOnConfirm: false
       },
       function(){
         $.ajax({
        type:"post",
        url:"<?php echo base_url(); ?>admin/unblockOrgAccount",
        cache: false,
        data:{id: orgID},
        dataType: 'json',
        async: false,
        success:function(result){
       swal("Unblocked!", "This account has been unblocked.", "success");
       var search = $("#idInputAllOrg").val();
          $.ajax({
         type:"post",
         url:"<?php echo base_url(); ?>admin/searchAllOrganizations",
         cache: false,
         data:{query: search, source: 'admin'},
         dataType: 'json',
         async: false,
         success:function(result){
         var output = "<div class='container animated fadeIn' id='searchValidate'>" +
        "<table class='table table-striped custab'>"+
            "<thead>"+
               "<tr>"+
                  "<th>Organization Name</th>"+
                  "<th>Organization Email</th>"+
                  "<th>Organization Status</th>"+
                  "<th>Account Status</th>"+
                  "<th class='text-center'>Action</th>"+
               "</tr>"+
            "</thead>";
         for (var key in result) {
            if (result.hasOwnProperty(key)) {
              var archived;
            if (result[key]['archived'] == 1)
            {
              archived = "Blocked";
            }
            else archived = "Active";
               output+="<tr>"+
                        "<td>"+result[key]['org_name']+"</td>"+
                        "<td>"+result[key]['org_email']+"</td>"+
                        "<td>"+result[key]['org_status']+"</td>"+
                        "<td>"+archived+"</td>"+
                        "<td class='text-center'><button class='btn btn-info btn-xs' onclick='viewOrgInfo("+result[key]['org_id']+")' style='margin-left: 10px;'>Details</button>";
              if (result[key]['archived'] == 0)
              {
                output+="<button onclick='blockOrgAct("+result[key]['org_id']+")' class='btn btn-danger btn-xs' style='margin-left: 10px;'>Block</button></td></tr>";
              }
              else
              {
                output+="<button onclick='unblockOrgAct("+result[key]['org_id']+")' class='btn btn-success btn-xs' style='margin-left: 10px;'>Unblock</button></td></tr>"
              }
            }
         }
         $("#allorgResult").html(output);
        }
        });
       }
    
       });
       });
       }

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
                      "<h4 style='font-size: 18px'><strong>Org Acronym</strong></h4>"+
                      "<h4 style='font-size: 18px'><strong>Org Category</strong></h4>"+
                      "<h4 style='font-size: 18px'><strong>College</strong></h4>"+
                      "<h4 style='font-size: 18px'><strong>Mailing Address</strong></h4>"+
                      "<h4 style='font-size: 18px'><strong>Org Website</strong></h4>"+
                      "<h4 style='font-size: 18px'><strong>Email Address</strong></h4>"+
                      "</div>"+
                    "<div class='col'>"+
                      "<h4 style='font-size: 18px'>"+result['acronym']+"</h4>"+
                      "<h4 style='font-size: 18px'>"+result['org_category']+"</h4>"+
                      "<h4 style='font-size: 18px'>"+result['org_college']+"</h4>"+
                      "<h4 style='font-size: 18px'>"+result['mailing_address']+"</h4>"+
                      "<h4 style='font-size: 18px'>"+result['org_website']+"</h4>"+
                      "<h4 style='font-size: 18px'>"+result['org_email']+"</h4>"+
                      "</div>"+
                   "</div>"+
                   "<button type='button' class='btn btn-info'>View Org Profile</button>"+
                "</div>"
       },
       function(){
       
       
       });
       }
       });
       }
</script>
<div class="modal animated bounceInUp" id="viewallorg" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" style="min-width: 1200px;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">View All Organization Accounts</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="studSearch">
                    <div class="container">
                        <div class="mail-box">
                            <aside class="lg-side">
                                <div class="inbox-head">
                                    <form class="pull-right position needs-validation" onsubmit="return false">
                                        <table class="table table-inbox table-hover">
                                            <tbody>
                                                <div class="mat-input" style="margin-top: 30px;">
                                                    <div class="mat-input-outer">
                                                        <input type="username" id="idInputAllOrg" class="form-control" autocomplete="off"/>
                                                        <label class="">Enter Org Email/Org Name</label>
                                                        <div class="border"></div>
                                                        <button style="margin-top: 10px;" onClick="livesearchallorg()" class="btn btn-danger btn-block">Search</button>
                                                    </div>
                                                </div>
                                                <div style="text-align: center">
                                                </div>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                <div class="inbox-body">
                                    <div class="mail-option">
                                    </div>
                            </aside>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="allorgResult" style="height: 300px; overflow-y: scroll;">
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
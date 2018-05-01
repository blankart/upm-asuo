<script>
    function livesearchallstud()
        {
        var search = $("#idInputAllStud").val();
          $.ajax({
         type:"post",
         url:"<?php echo base_url(); ?>admin/searchAllStudents",
         cache: false,
         data:{query: search, source: 'admin'},
         dataType: 'json',
         async: false,
         success:function(result){
         var output = "<div class='container' id='searchValidate'>" +
        "<table class='table table-striped custab'>"+
            "<thead>"+
               "<tr>"+
                  "<th>UP ID</th>"+
                  "<th>Name</th>"+
                  "<th>Account Status</th>"+
                  "<th class='text-center'>Action</th>"+
               "</tr>"+
            "</thead>";
         for (var key in result) {
            var archived;
            if (result[key]['archived'] == 1)
            {
              archived = "Blocked";
            }
            else
            {
              archived = "Active";
            }
            if (result.hasOwnProperty(key)) {
               output+="<tr>"+
                        "<td>"+result[key]['up_id']+"</td>"+
                        "<td>"+result[key]['first_name']+" "+result[key]['last_name']+"</td>"+
                        "<td>"+archived+"</td>"+
                        "<td class='text-center'><button class='btn btn-info btn-xs' onclick='viewStudInfo("+result[key]['student_id']+")' style='margin-left: 10px;'> View Details</button>";
              if (result[key]['archived'] == 0)
              {
                output+="<button onclick='blockStudAct("+result[key]['student_id']+")' class='btn btn-danger btn-xs' style='margin-left: 10px;'>Block Account</button></td></tr>";
              }
              else
              {
                output+="<button onclick='unblockStudAct("+result[key]['student_id']+")' class='btn btn-success btn-xs' style='margin-left: 10px;'>Unblock</button></td></tr>"
              }
            }
         }
         $("#allstudResult").html(output);
        }
        });
        
        
        }
       /*
        function changeStudpw(studentID)
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
         url:"<?php echo base_url(); ?>admin/changeStudPassword",
         cache: false,
         data:{id: studentID, newstudpassword: inputValue},
         dataType: 'json',
         async: false,
         success:function(result){
          swal("Change Password Successful", "This account's password has been changed.", "success");
          
        }
        });
    
       });
       }*/
    
       function blockStudAct(studentID)
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
        url:"<?php echo base_url(); ?>admin/blockStudentAccount",
        cache: false,
        data:{id: studentID},
        dataType: 'json',
        async: false,
        success:function(result){
       swal("Blocked!", "This account has been blocked.", "success");
       var search = $("#idInputAllStud").val();
          $.ajax({
         type:"post",
         url:"<?php echo base_url(); ?>admin/searchAllStudents",
         cache: false,
         data:{query: search, source: 'admin'},
         dataType: 'json',
         async: false,
         success:function(result){
         var output = "<div class='container animated fadeIn' id='searchValidate'>" +
        "<table class='table table-striped custab'>"+
            "<thead>"+
               "<tr>"+
                  "<th>UP ID</th>"+
                  "<th>UP Mail</th>"+
                  "<th>Account Status</th>"+
                  "<th class='text-center'>Action</th>"+
               "</tr>"+
            "</thead>";
    
         for (var key in result) {
            var archived;
            if (result[key]['archived'] == 1)
            {
              archived = "Blocked";
            }
            else archived = "Active";
            
            if (result.hasOwnProperty(key)) {
               output+="<tr>"+
                        "<td>"+result[key]['up_id']+"</td>"+
                        "<td>"+result[key]['first_name']+" "+result[key]['last_name']+"</td>"+
                        "<td>"+archived+"</td>"+
                        "<td class='text-center'><button class='btn btn-info btn-xs' onclick='viewStudInfo("+result[key]['student_id']+")' style='margin-left: 10px;'> View Details</button>";
              if (result[key]['archived'] == 0)
              {
                output+="<button onclick='blockStudAct("+result[key]['student_id']+")' class='btn btn-danger btn-xs' style='margin-left: 10px;'>Block Account</button></td></tr>";
              }
              else
              {
                output+="<button onclick='unblockStudAct("+result[key]['student_id']+")' class='btn btn-success btn-xs' style='margin-left: 10px;'>Unblock</button></td></tr>"
              }
            }
         }
         $("#allstudResult").html(output);
        }
        });
       }
    
       });
       });
       }
    
       function unblockStudAct(studentID)
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
        url:"<?php echo base_url(); ?>admin/unblockStudentAccount",
        cache: false,
        data:{id: studentID},
        dataType: 'json',
        async: false,
        success:function(result){
       swal("Unblocked!", "This account has been unblocked.", "success");
       var search = $("#idInputAllStud").val();
          $.ajax({
         type:"post",
         url:"<?php echo base_url(); ?>admin/searchAllStudents",
         cache: false,
         data:{query: search, source: 'admin'},
         dataType: 'json',
         async: false,
         success:function(result){
         var output = "<div class='container animated fadeIn' id='searchValidate'>" +
        "<table class='table table-striped custab'>"+
            "<thead>"+
               "<tr>"+
                  "<th>UP ID</th>"+
                  "<th>UP Mail</th>"+
                  "<th>Account Status</th>"+
                  "<th class='text-center'>Action</th>"+
               "</tr>"+
            "</thead>";
    
         for (var key in result) {
            var archived;
            if (result[key]['archived'] == 1)
            {
              archived = "Blocked";
            }
            else archived = "Active";
            
            if (result.hasOwnProperty(key)) {
               output+="<tr>"+
                        "<td>"+result[key]['up_id']+"</td>"+
                        "<td>"+result[key]['first_name']+" "+result[key]['last_name']+"</td>"+
                        "<td>"+archived+"</td>"+
                        "<td class='text-center'><button class='btn btn-info btn-xs' onclick='viewStudInfo("+result[key]['student_id']+")' style='margin-left: 10px;'> View Details</button>";
              if (result[key]['archived'] == 0)
              {
                output+="<button onclick='blockStudAct("+result[key]['student_id']+")' class='btn btn-danger btn-xs' style='margin-left: 10px;'>Block Account</button></td></tr>";
              }
              else
              {
                output+="<button onclick='unblockStudAct("+result[key]['student_id']+")' class='btn btn-success btn-xs' style='margin-left: 10px;'>Unblock</button></td></tr>"
              }
            }
         }
         $("#allstudResult").html(output);
        }
        });
       }
    
       });
       });
       }
</script>
<div class="modal animated bounceInUp" id="viewallstudents" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" style="min-width: 1200px;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">View All Student Accounts</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="studSearch">
                    <div class="container">
                      <small class="form-text text-muted">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</small>
                        <div class="mail-box">
                            <aside class="lg-side">
                                <div class="inbox-head">
                                    <form class="pull-right position needs-validation" onsubmit="return false">
                                        <table class="table table-inbox table-hover">
                                            <tbody>
                                                <div class="mat-input" style="margin-top: 30px;">
                                                    <div class="mat-input-outer">
                                                        <input type="username" id="idInputAllStud" class="form-control" autocomplete="off"/>
                                                        <label class="">Enter Student ID/Name</label>
                                                        <div class="border"></div>
                                                        <button style="margin-top: 10px;" onClick="livesearchallstud()" class="btn btn-danger btn-block">Search</button>
                                                    </div>
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
                <div id="allstudResult" style="height: 300px; overflow-y: scroll;">
                  
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
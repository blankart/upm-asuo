<script>
    function vStudInfo(studentID){
          $.ajax({
        type:"post",
        url:"<?php echo base_url(); ?>admin/viewStudentInfo",
        cache: false,
        data:{id: studentID},
        dataType: 'json',
        async: false,
        success:function(result){
          swal({
       imageUrl: "<?php echo base_url();?>"+"assets/student/profile_pic/"+result['profile_pic'],
       html: true,
       customClass: 'swal-wide animated fadeIn',
       title: "<h4>"+result['last_name']+", "+result['first_name']+" "+result['middle_name']+"</h4>",
       text: "<div class='container' style='margin-top: 20px;'>"+
                "<div class='row' style='text-align: left;'>"+
                   "<div class='col'>"+
                      "<h4 style='font-size: 18px'><strong>UP Mail</strong></h4>"+
                    "</div>"+
                    "<div class='col'>"+
                      "<h4 style='font-size: 18px'>"+result['up_mail']+"</h4>"+
                    "</div>"+
                "</div>"+
                "<div class='row' style='text-align: left;'>"+
                   "<div class='col'>"+
                      "<h4 style='font-size: 18px'><strong>Course</strong></h4>"+
                    "</div>"+
                    "<div class='col'>"+
                      "<h4 style='font-size: 18px'>"+result['course']+"</h4>"+
                    "</div>"+
                "</div>"+
                "<div class='row' style='text-align: left;'>"+
                   "<div class='col'>"+
                      "<h4 style='font-size: 18px'><strong>Year Level</strong></h4>"+
                    "</div>"+
                    "<div class='col'>"+
                      "<h4 style='font-size: 18px'>"+result['year_level']+"</h4>"+
                    "</div>"+
                "</div>"+
                "<div class='row' style='text-align: left;'>"+
                   "<div class='col'>"+
                      "<h4 style='font-size: 18px'><strong>Student Number</strong></h4>"+
                    "</div>"+
                    "<div class='col'>"+
                      "<h4 style='font-size: 18px'>"+result['up_id']+"</h4>"+
                    "</div>"+
                "</div>"+
                "<div class='row' style='text-align: left;'>"+
                   "<div class='col'>"+
                      "<h4 style='font-size: 18px'><strong>Contact Number</strong></h4>"+
                    "</div>"+
                    "<div class='col'>"+
                      "<h4 style='font-size: 18px'>"+result['contact_num']+"</h4>"+
                    "</div>"+
                "</div>"+
            
                "<div>"+
                    "<a href='<?php echo base_url(); ?>assets/student/form_5/"+result['form5']+"' target='_blank'><button type='button' class='btn btn-link'><button type='button' class='btn btn-info'>View Form 5</button></button></a>&nbsp&nbsp"+
                    "<a href = '<?php echo base_url();?>student/"+result['username']+"'><button type='button' class='btn btn-info'>View Student Profile</button></a>"+
                "</div>"
       },
       function(){
       
       
       });
       }
       });
        
       }
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
                        "<td>"+result[key]['last_name']+", "+result[key]['first_name']+ " " +result[key]['middle_name']+ "</td>"+
                        "<td>"+archived+"</td>"+
                        "<td class='text-center'><button class='btn btn-info btn-xs' onclick='vStudInfo("+result[key]['student_id']+")' style='margin-left: 10px;'> View Details</button>";
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
                        "<td>"+result[key]['last_name']+", "+result[key]['first_name']+ " " +result[key]['middle_name']+ "</td>"+
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
                      <p class="form-text text-muted">View student accounts and block the ones with offenses. Blocking will make the account unusable by the student.</p>
                        <div class="mail-box">
                            <aside class="lg-side">
                                <div class="inbox-head">
                                    <form class="position needs-validation" onsubmit="return false">
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
                <div class="loadingscreen">
          <div class="row">
            <div id="loader">
              <div class="dot"></div>
              <div class="dot"></div>
              <div class="dot"></div>
              <div class="dot"></div>
              <div class="dot"></div>
              <div class="dot"></div>
              <div class="dot"></div>
              <div class="dot"></div>
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
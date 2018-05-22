<!DOCTYPE html>
<html>
<head>

  <script>
     function validatestudactSearch(){
        var search = $("#idInputStud").val();
          $.ajax({
         type:"post",
         url:"<?php echo base_url(); ?>admin/searchStudents",
         cache: false,
         data:{query: search, source: "admin"},
         dataType: 'json',
         async: false,
         success:function(result){
         var output = "<div class='container' id='searchValidate'>" +
        "<table class='table table-striped custab'>"+
            "<thead>"+
               "<tr>"+
                  "<th>UP ID<\/th>"+
                  "<th>Name<\/th>"+
                  "<th class='text-center'>Action<\/th>"+
               "<\/tr>"+
            "<\/thead>";
         for (var key in result) {
            if (result.hasOwnProperty(key)) {
               output+="<tr>"+
                        "<td>"+result[key]['up_id']+"<\/td>"+
                        "<td>"+result[key]['last_name']+", "+result[key]['first_name']+ " " +result[key]['middle_name']+ "<\/td>"+
                        "<td class='text-center'><button class='btn btn-info btn-xs' onclick='viewStudInfo("+result[key]['student_id']+")' style='margin-left: 10px;'> View Account<\/button><button onclick='sendNoticeStud("+result[key]['student_id']+")' class='btn btn-info btn-xs' style='margin-left: 10px;'>Send Notice<\/button><button onclick='approveStud("+result[key]['student_id']+")' class='btn btn-success btn-xs' style='margin-left: 10px;'>Validate<\/button> <button onclick='rejectAcc("+result[key]['student_id']+")' class='btn btn-danger btn-xs' style='margin-left: 10px;'>Reject<\/button><\/td>"+
                     "<\/tr>";
            }
         }
         $("#studResult").html(output);
        }
        });

     }

        function sendNoticeStud(student_id){
          swal({
            title: "Send Notice to Student",
            text: "Write message: ",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            inputPlaceholder: "Write something"
          }, function (inputValue) {
            if (inputValue === false) return false;

             var message = inputValue.trim();
            if ( message=== "") {
              swal.showInputError("You need to write something!");
              return false
            }

            if (message.length >  200) {
                    swal("Error!", "Your message should not be more than 2-0 characters!", "error");
                    return false;
            }
                $.ajax({
                      type: "post",
                      url: "<?php echo base_url();?>admin/sendStudentNotice",
                      data: {student_id: student_id, message: message},
                      dataType: "JSON",
                      async: false,
                      cache: false,
                      success: function(result){

                        if(result){
                            swal("Nice!", "You wrote: " + message, "success");
                        }
                      }
                    });          
          });
      }
       function rejectAcc(student_id){
         swal({
           title: "Reject student account creation?",
           text: "Rejecting an account will automatically block it.",
           type: "warning",
           showCancelButton: true,
           confirmButtonClass: "btn-danger",
           confirmButtonText: "Yes, reject account",
           closeOnConfirm: false
         },
         function(){
                 $.ajax({
                       type: "post",
                       url: "<?php echo base_url();?>admin/rejectStudent",
                       data: {student_id: student_id},
                       dataType: "JSON",
                       async: false,
                       cache: false,
                       success: function(result){
                         //alert(result);
                         if(result){
                           swal({title: "Rejected!", text: "The account has been blocked.", type: "success"},
                              function(){ 
                                  location.reload();
                              });
                         }
                       },
                       error: function(){
                         alert("error");
                       }
                     });
         });
       }


     
        function _(x){
         return document.getElementById(x);
        }
        function viewStudInfo(studentID){
           $.ajax({
         type:"post",
         url:"<?php echo base_url(); ?>admin/viewStudentInfo",
         cache: false,
         data:{id: studentID},
         dataType: 'json',
         async: false,
         success:function(result){
           swal({
        imageUrl: "<?php echo base_url();?>"+"img/logo.jpg",
        html: true,
        customClass: 'swal-wide animated fadeIn',
        title: "<h4>"+result['last_name']+", "+result['first_name']+" "+result['middle_name']+"<\/h4>",
        text: "<div class='container' style='margin-top: 20px;'>"+
                 "<div class='row' style='text-align: left;'>"+
                    "<div class='col'>"+
                       "<h4 style='font-size: 18px'><strong>UP Mail<\/strong><\/h4>"+
                     "<\/div>"+
                     "<div class='col'>"+
                       "<h4 style='font-size: 18px'>"+result['up_mail']+"<\/h4>"+
                     "<\/div>"+
                 "<\/div>"+
                 "<div class='row' style='text-align: left;'>"+
                    "<div class='col'>"+
                       "<h4 style='font-size: 18px'><strong>Course<\/strong><\/h4>"+
                     "<\/div>"+
                     "<div class='col'>"+
                       "<h4 style='font-size: 18px'>"+result['course']+"<\/h4>"+
                     "<\/div>"+
                 "<\/div>"+
                 "<div class='row' style='text-align: left;'>"+
                    "<div class='col'>"+
                       "<h4 style='font-size: 18px'><strong>Year Level<\/strong><\/h4>"+
                     "<\/div>"+
                     "<div class='col'>"+
                       "<h4 style='font-size: 18px'>"+result['year_level']+"<\/h4>"+
                     "<\/div>"+
                 "<\/div>"+
                 "<div class='row' style='text-align: left;'>"+
                    "<div class='col'>"+
                       "<h4 style='font-size: 18px'><strong>Student Number<\/strong><\/h4>"+
                     "<\/div>"+
                     "<div class='col'>"+
                       "<h4 style='font-size: 18px'>"+result['up_id']+"<\/h4>"+
                     "<\/div>"+
                 "<\/div>"+
                 "<div class='row' style='text-align: left;'>"+
                    "<div class='col'>"+
                       "<h4 style='font-size: 18px'><strong>Contact Number<\/strong><\/h4>"+
                     "<\/div>"+
                     "<div class='col'>"+
                       "<h4 style='font-size: 18px'>"+result['contact_num']+"<\/h4>"+
                     "<\/div>"+
                 "<\/div>"+
                 "<div style='text-align: center;'>"+
                       "<a href='<?php echo base_url(); ?>assets/student/form_5/"+result['form5']+"' target='_blank'><button type='button' class='btn btn-link'><button type='button' class='btn btn-info'>View Form 5</button></button></a>"+
                 "<\/div>"+    
               "<\/div>"
        },
        function(){
        
        
        });
        }
        });
         
        }
        function approveStud(studentID){
         swal({
        html: true,
        title: "<h4>Confirm Action<\/h4>",
        text: "Do you want to approve this account?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "Validate",
        closeOnConfirm: false
        },
        function(){
          $.ajax({
         type:"post",
         url:"<?php echo base_url(); ?>admin/validateStudentAccount",
         cache: false,
         data:{id: studentID},
         dataType: 'json',
         async: false,
         success:function(result){
        swal("Approved!", "This account has been approved.", "success");
         var search = $("#idInputStud").val();
        
          $.ajax({
         type:"post",
         url:"<?php echo base_url(); ?>admin/searchStudents",
         cache: false,
         data:{query: search, source: "admin"},
         dataType: 'json',
         async: false,
         success:function(result){
         var output = "<div class='container animated fadeIn' id='searchValidate' >" +
        "<table class='table table-striped custab'>"+
            "<thead>"+
               "<tr>"+
                  "<th>UP ID<\/th>"+
                  "<th>UP Mail<\/th>"+
                  "<th class='text-center'>Action<\/th>"+
               "<\/tr>"+
            "<\/thead>";
         for (var key in result) {
            if (result.hasOwnProperty(key)) {
               output+="<tr>"+
                        "<td>"+result[key]['up_id']+"<\/td>"+
                        "<td>"+result[key]['up_mail']+"<\/td>"+
                        "<td class='text-center'><button class='btn btn-info btn-xs' onclick='viewStudInfo("+result[key]['student_id']+")' style='margin-left: 10px;'> View Account<\/button><button onclick='approveStud("+result[key]['student_id']+")' class='btn btn-success btn-xs' style='margin-left: 10px;'>Validate<\/button><\/td>"+
                     "<\/tr>";
            }
         }
         $("#studResult").html(output);
        }
        });
        }
        });
        });
        }
  </script>
  <title></title>
</head>
<body>
  <div class="modal animated bounceInUp" data-backdrop="static" data-keyboard="false" id="validatestudact">
    <div class="modal-dialog modal-dialog-centered" style="min-width: 1200px;">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"><i class="fa fa-check-circle-o fa-2x pull-left" style='margin-right: 20px;'></i>Validate Student Account</h4>
        </div><!-- Modal body -->
        <div class="modal-body">
          <div id="studSearch">
            <div class="container">
              <p class="form-text text-muted">Activate student accounts with valid UP mail and complete details.</p>
              <div class="mail-box">
                <aside class="lg-side">
                  <div class="inbox-head">
                    <form class="position needs-validation" onsubmit="return false">
                      <div class="mat-input" style="margin-top: 30px;">
                        <div class="mat-input-outer">
                          <input autocomplete="off" class="form-control" id="idInputStud" type="username"> <label class="">Enter Student ID/Name</label>
                          <div class="border"></div><button class="btn btn-danger btn-block" onclick="validatestudactSearch()" style="margin-top: 10px;">Search</button>
                        </div>
                      </div>
                      <table class="table table-inbox table-hover">
                        <tbody></tbody>
                      </table>
                    </form>
                  </div>
                  <div class="inbox-body">
                    <div class="mail-option"></div>
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
        <div id="studResult" style="height: 300px; overflow-y: scroll;"></div><!-- Modal footer -->
        <div class="modal-footer">
          <button class="btn btn-danger" data-dismiss="modal" type="button">Close</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<script>
    function validatestudactSearch(){
       var search = $("#idInputStud").val();
         $.ajax({
        type:"post",
        url:"<?php echo base_url(); ?>admin/searchStudents",
        cache: false,
        data:{query: search},
        dataType: 'json',
        async: false,
        success:function(result){
        var output = "<div class='container' id='searchValidate'>" +
       "<table class='table table-striped custab'>"+
           "<thead>"+
              "<tr>"+
                 "<th>UP ID</th>"+
                 "<th>UP Mail</th>"+
                 "<th class='text-center'>Action</th>"+
              "</tr>"+
           "</thead>";
        for (var key in result) {
           if (result.hasOwnProperty(key)) {
              output+="<tr>"+
                       "<td>"+result[key]['up_id']+"</td>"+
                       "<td>"+result[key]['up_mail']+"</td>"+
                       "<td class='text-center'><button class='btn btn-info btn-xs' onclick='viewStudInfo("+result[key]['student_id']+")' style='margin-left: 10px;'> View Account</button><button onclick='approveStud("+result[key]['student_id']+")' class='btn btn-success btn-xs' style='margin-left: 10px;'>Validate</button></td>"+
                    "</tr>";
           }
        }
        $("#studResult").html(output);
       }
       });

    }
    function livesearchstud()
       {
        $('#idInputStud').keyup(function(){
       var search = $(this).val();
         $.ajax({
        type:"post",
        url:"<?php echo base_url(); ?>admin/searchStudents",
        cache: false,
        data:{query: search},
        dataType: 'json',
        async: false,
        success:function(result){
        var output = "<div class='container' id='searchValidate'>" +
       "<table class='table table-striped custab'>"+
           "<thead>"+
              "<tr>"+
                 "<th>UP ID</th>"+
                 "<th>UP Mail</th>"+
                 "<th class='text-center'>Action</th>"+
              "</tr>"+
           "</thead>";
        for (var key in result) {
           if (result.hasOwnProperty(key)) {
              output+="<tr>"+
                       "<td>"+result[key]['up_id']+"</td>"+
                       "<td>"+result[key]['up_mail']+"</td>"+
                       "<td class='text-center'><button class='btn btn-info btn-xs' onclick='viewStudInfo("+result[key]['student_id']+")' style='margin-left: 10px;'> View Account</button><button onclick='approveStud("+result[key]['student_id']+")' class='btn btn-success btn-xs' style='margin-left: 10px;'>Validate</button></td>"+
                    "</tr>";
           }
        }
        $("#studResult").html(output);
       }
       });
       
       });
       
       }
       
       
       function _(x){
        return document.getElementById(x);
       }
       function resetStudModal(){
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
       title: "<h4>"+result['last_name']+", "+result['first_name']+" "+result['middle_name']+"</h4>",
       text: "<div class='container' style='margin-top: 20px;'>"+
                "<div class='row' style='text-align: left;'>"+
                   "<div class='col'>"+
                      "<h4 style='font-size: 18px'><strong>UP Mail</strong></h4>"+
                      "<h4 style='font-size: 18px'><strong>Course</strong></h4>"+
                      "<h4 style='font-size: 18px'><strong>Student Number</strong></h4>"+
                      "<h4 style='font-size: 18px'><strong>Contact Number</strong></h4>"+
                      "</div>"+
                   "<div class='col'>"+
                      "<h4 style='font-size: 18px'>"+result['up_mail']+"</h4>"+
                      "<h4 style='font-size: 18px'>"+result['course']+"</h4>"+
                      "<h4 style='font-size: 18px'>"+result['up_id']+"</h4>"+
                      "<h4 style='font-size: 18px'>"+result['contact_num']+"</h4>"+
                      "</div>"+
                   "</div>"+
                "</div>"
       },
       function(){
       
       
       });
       }
       });
        
       }
       function approveStud(studentID){
        swal({
       html: true,
       title: "<h4>Confirm Action</h4>",
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
        data:{query: search},
        dataType: 'json',
        async: false,
        success:function(result){
        var output = "<div class='container animated fadeIn' id='searchValidate' >" +
       "<table class='table table-striped custab'>"+
           "<thead>"+
              "<tr>"+
                 "<th>UP ID</th>"+
                 "<th>UP Mail</th>"+
                 "<th class='text-center'>Action</th>"+
              "</tr>"+
           "</thead>";
        for (var key in result) {
           if (result.hasOwnProperty(key)) {
              output+="<tr>"+
                       "<td>"+result[key]['up_id']+"</td>"+
                       "<td>"+result[key]['up_mail']+"</td>"+
                       "<td class='text-center'><button class='btn btn-info btn-xs' onclick='viewStudInfo("+result[key]['student_id']+")' style='margin-left: 10px;'> View Account</button><button onclick='approveStud("+result[key]['student_id']+")' class='btn btn-success btn-xs' style='margin-left: 10px;'>Validate</button></td>"+
                    "</tr>";
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
<div class="modal animated bounceInUp" id="validatestudact" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" style="min-width: 1200px;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Validate Student Account</h4>
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
                                                        <input type="username" id="idInputStud" onkeyup="livesearchstud()" class="form-control" autocomplete="off" required/>
                                                        <label class="">Enter UP Mail</label>
                                                        <div class="border"></div>
                                                    </div>
                                                </div>
                                                <div style="text-align: center">
                                                    <h4 style="margin-top: 30px; font-size: 15px; text-align: center;">Search Format: XXXX@samplemail.com</h4>
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
                <div id="studResult" style="height: 300px; overflow-y: scroll;">
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="resetStudModal()" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<script>
  function activateorgactSearch(){
       var search = $("#idInputOrg").val();
       $.ajax({
       type:"post",
       url:"<?php echo base_url(); ?>admin/searchOrganizations",
       cache: false,
       data:{query: search},
       dataType: 'json',
       async: false,
       success:function(result){
       var output = "<div class='container' id='searchValidate'>" +
       "<table class='table table-striped custab'>"+
       "<thead>"+
       "<tr>"+
        "<th>Organization Name</th>"+
        "<th>Organization Email</th>"+
        "<th class='text-center'>Action</th>"+
       "</tr>"+
       "</thead>";
       for (var key in result) {
       if (result.hasOwnProperty(key)) {
       output+="<tr>"+
              "<td>"+result[key]['org_name']+"</td>"+
              "<td>"+result[key]['org_email']+"</td>"+
              "<td class='text-center'><button class='btn btn-info btn-xs' onclick='viewOrgInfo("+result[key]['org_id']+")' style='margin-left: 10px;'> View Organization</button><button onclick='approveOrg("+result[key]['org_id']+")' class='btn btn-success btn-xs' style='margin-left: 10px;'>Validate</button></td>"+
           "</tr>";
       }
       }
       $("#orgResult").html(output);
       }
       });
       
       
  }
    function _(x){
          return document.getElementById(x);
       }
       function viewOrg(orgID){
          swal("Sample info");
       }
       function livesearchOrg()
       {
       $('#idInputOrg').keyup(function(){
       var search = $(this).val();
       $.ajax({
       type:"post",
       url:"<?php echo base_url(); ?>admin/searchOrganizations",
       cache: false,
       data:{query: search},
       dataType: 'json',
       async: false,
       success:function(result){
       var output = "<div class='container' id='searchValidate'>" +
       "<table class='table table-striped custab'>"+
       "<thead>"+
       "<tr>"+
        "<th>Organization Name</th>"+
        "<th>Organization Email</th>"+
        "<th class='text-center'>Action</th>"+
       "</tr>"+
       "</thead>";
       for (var key in result) {
       if (result.hasOwnProperty(key)) {
       output+="<tr>"+
              "<td>"+result[key]['org_name']+"</td>"+
              "<td>"+result[key]['org_email']+"</td>"+
              "<td class='text-center'><button class='btn btn-info btn-xs' onclick='viewOrgInfo("+result[key]['org_id']+")' style='margin-left: 10px;'> View Organization</button><button onclick='approveOrg("+result[key]['org_id']+")' class='btn btn-success btn-xs' style='margin-left: 10px;'>Validate</button></td>"+
           "</tr>";
       }
       }
       $("#orgResult").html(output);
       }
       });
       
       });
       
       }
       function approveOrg(orgID){
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
        url:"<?php echo base_url(); ?>admin/activateOrgAccount",
        cache: false,
        data:{id: orgID},
        dataType: 'json',
        async: false,
        success:function(result){
        swal("Approved!", "This account has been approved.", "success");
        var search = $("#idInputOrg").val();
         $.ajax({
        type:"post",
        url:"<?php echo base_url(); ?>admin/searchOrganizations",
        cache: false,
        data:{query: search},
        dataType: 'json',
        async: false,
        success:function(result){
        var output = "<div class='container animated fadeIn' id='searchValidate' >" +
       "<table class='table table-striped custab'>"+
           "<thead>"+
              "<tr>"+
                 "<th>Organization Name</th>"+
                 "<th>Organization Email</th>"+
                 "<th class='text-center'>Action</th>"+
              "</tr>"+
           "</thead>";
        for (var key in result) {
           if (result.hasOwnProperty(key)) {
              output+="<tr>"+
                       "<td>"+result[key]['org_name']+"</td>"+
                       "<td>"+result[key]['org_email']+"</td>"+
                       "<td class='text-center'><button class='btn btn-info btn-xs' onclick='viewOrgInfo("+result[key]['org_id']+")' style='margin-left: 10px;'> View Organization</button><button onclick='approveOrg("+result[key]['org_id']+")' class='btn btn-success btn-xs' style='margin-left: 10px;'>Validate</button></td>"+
                    "</tr>";
           }
        }
        $("#orgResult").html(output);
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
</script>
<div class="modal animated bounceInUp" id="activateorgact" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" style="min-width: 1200px;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Activate Organization Account</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="orgSearch">
                    <div class="container">
                        <div class="mail-box">
                            <aside class="lg-side">
                                <div class="inbox-head">
                                    <form class="pull-right position needs-validation" onsubmit="return false">
                                        <table class="table table-inbox table-hover">
                                            <tbody>
                                                <div class="mat-input" style="margin-top: 30px;">
                                                    <div class="mat-input-outer">
                                                        <input type="username" id="idInputOrg" onkeyup="livesearchOrg()" class="form-control" autocomplete="off" required/>
                                                        <label class="">Enter Organization Mail Address</label>
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
                <div id="orgResult" style="height: 300px; overflow-y: scroll;">
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="resetOrgModal()" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
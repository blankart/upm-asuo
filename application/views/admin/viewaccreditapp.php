<!DOCTYPE html>
<html>
<head>

  <script>

    function sendNotice(orgID)
    {
      var date = "<?php echo date('Y-m-d'); ?>";
      if ($("#sendNoticeTitle").val().length > 0 && $("#sendNoticeTitle").val().length < 51 && $("#sendNoticeMessage").val().length > 0 && $("#sendNoticeMessage").val().length < 501 ){
        swal({
       html: true,
       title: "<h4>Are you sure?</h4>",
       text: "Do you want to send this message?",
       type: "warning",
       showCancelButton: true,
       confirmButtonClass: "btn-success",
       confirmButtonText: "Send",
       closeOnConfirm: false
       },
       function(){
        $.ajax({
        type:"post",
        url:"<?php echo base_url(); ?>admin/sendNotice",
        cache: false,
        data:{id: orgID, noticeTitle: $("#sendNoticeTitle").val(), noticeMessage: $("#sendNoticeMessage").val(), noticeDate: date},
        dataType: 'json',
        async: false,
        success:function(result){
       swal("Sent!", "This announcement has been sent.", "success");
       }
    
       });
       });
      }
    }
    
    function _(x){
      return document.getElementById(x);
    } 

    function viewAllOrg(orgID){
      _("orgMatches").style.display = "block";
    }

    function searchBox(string){
        var search = $("#orgID").val();
        $.ajax({
          type:"post",
          url:"<?php echo base_url(); ?>admin/searchAccredApp",
          cache: false,
          data:{query: search, source: 'admin'},
          dataType: 'json',
          async: false,
          success:function(result){
            var output = "<div class='container animated fadeIn' id='searchValidate'>" +
                         "<table class='table table-striped custab'>"+
                         "<thead>"+
                         "<tr>"+
                         "<th>Organization ID<\/th>"+
                         "<th>Organization Name<\/th>"+
                         "<th class='text-center'>Action<\/th>"+
                         "<\/tr>"+
                         "<\/thead>";
             output+="<div id='unaccreditedTab'>";
            for (var key in result) {
             
              if (result.hasOwnProperty(key)) {
               if (result[key]['org_status'] == string)
               {
                output+="<tr>"+
                        "<td>"+result[key]['org_id']+"<\/td>"+
                        "<td>"+result[key]['org_name']+"<\/td>"+
                        //actions
                        "<td class='text-center'><button class='btn btn-info btn-xs' onclick='viewDocuments("+result[key]['org_id']+")' style='margin-left: 10px;'>View Documents<\/button>";
                        if (result[key]['org_status'] == "Accredited"){
                         output+="<button onclick='reject("+result[key]['org_id']+")' class='btn btn-danger btn-xs' style='margin-left: 10px;'>Reject<\/button>";
                        }
                        else if (result[key]['org_status'] == "Unaccredited"){
                         output+="<button onclick='accredit("+result[key]['org_id']+")' class='btn btn-success btn-xs' style='margin-left: 10px;'>Accredit<\/button>";
                        }
                        else if (result[key]['org_status'] == "Pending"){
                         output+="<button onclick='accredit("+result[key]['org_id']+")' class='btn btn-success btn-xs' style='margin-left: 10px;'>Accredit<\/button>"+
                         "<button onclick='sendNoticeButtonApp(\""+result[key]['org_name']+"\","+result[key]['org_id']+")' class='btn btn-info btn-xs' style='margin-left: 10px;'>Send Notice<\/button>"+
                         "<button onclick='reject("+result[key]['org_id']+")' class='btn btn-danger btn-xs' style='margin-left: 10px;'>Reject<\/button>";
                        }
                        output+="<\/td><\/tr>";
               }
               else if (string == ''){
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
            $("#myResult").html(output);
            //$("#accreditedTab").hide();
            //$("#unaccreditedTab").hide();
            //$("#pendingTab").hide();
          }
        });
    } //end function

    function sendNoticeButtonApp(orgName,orgID){
      var output = '<div class="container">'+
                          '<div class="form-area">'+
                              '<form role="form" onsubmit="return false">'+
                                  '<br style="clear:both">'+
                                  '<h3 style="margin-bottom: 25px; text-align: center;">Compose Message</h3>'+
                                  '<div class="form-group">'+
                                      '<input type="text" value="'+orgName+'"class="form-control" id="recipientEmail" readonly>'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                      '<input type="text" class="form-control" id="sendNoticeTitle" maxlength="50" name="subject" placeholder="Title" required>'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                      '<textarea class="form-control" onkeyup="textCounter()" type="textarea" id="sendNoticeMessage" placeholder="Message" maxlength="500" rows="7" required></textarea>'+
                                      '<span id="textcounter">500 characters remaining</span>'+
                                  '</div>'+
                                  '<a onclick="sendNoticeResetApp()" class="btn btn-info pull-right" style="color: white;">Back</a>'+
                                  '<button type="submit" onclick="sendNotice('+orgID+')" class="btn btn-danger" style="margin-left: 10px;">Send Notice</button>'+
                              '</form>'+
                          '</div>'+
                      '</div>';
      $("#sendNoticeToOrgApp").html(output);
      $(".modal-body").slideUp(400);
      $("#sendNoticeToOrgApp").delay(400).slideDown(400);
      //alert($("#recipientEmail").val());
      //$("#recipientEmail").placeholder = orgEmail;
    }

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
            searchBox('');
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
            searchBox('');
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

    function sendNoticeResetApp(){
            $("#sendNoticeToOrgApp").slideUp(400);
            $(".modal-body").delay(400).slideDown(400);
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
                        </div><button class="btn btn-danger btn-block" onclick="searchBox('')" style="margin-top: 10px;">Search</button>
                      </div>
                    </form>
                  </div>
                  <div class="inbox-body">
                    <button class="btn btn-info" onclick="searchBox('Pending')" type="button">Pending Applications</button>  <button class="btn btn-success" onclick="searchBox('Accredited')" type="button">Approved</button>  <button class="btn btn-danger" onclick="searchBox('Unaccredited')" type="button">Rejected</button>
                    <div class="mail-option"></div>
                    <div id="myResult" style="height: 300px; overflow-y: scroll;"></div>
                </aside>
                
              </div>
            </div>
          </div>

        </div>
        
        <div id="sendNoticeToOrgApp" style="display: none;">
                </div>
        <div class="modal-footer">
          <button class="btn btn-danger" data-dismiss="modal" onclick="resetOrgModal()" type="button">Close</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
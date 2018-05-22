<!DOCTYPE html>
<html>
<head>

  <script>

      /*function sendNotice(orgID)
      {
        var date = "<?php echo date('Y-m-d'); ?>";
        if ($("#sendNoticeTitle").val().length > 0 && $("#sendNoticeTitle").val().length < 51 && $("#sendNoticeMessage").val().length > 0 && $("#sendNoticeMessage").val().length < 501 ){
          swal({
         html: true,
         title: "<h4>Are you sure?<\/h4>",
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
      }*/
      
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
                                    '<h3 style="margin-bottom: 25px; text-align: center;">Compose Message<\/h3>'+
                                    '<div class="form-group">'+
                                        '<input type="text" value="'+orgName+'"class="form-control" id="recipientEmail" readonly>'+
                                    '<\/div>'+
                                    '<div class="form-group">'+
                                        '<input type="text" class="form-control" id="sendNoticeTitle" maxlength="50" name="subject" placeholder="Title" required>'+
                                    '<\/div>'+
                                    '<div class="form-group">'+
                                        '<textarea class="form-control" onkeyup="textCounter()" type="textarea" id="sendNoticeMessage" placeholder="Message" maxlength="500" rows="7" required><\/textarea>'+
                                        '<span id="textcounter">500 characters remaining<\/span>'+
                                    '<\/div>'+
                                    '<a onclick="sendNoticeResetApp()" class="btn btn-info pull-right" style="color: white;">Back<\/a>'+
                                    '<button type="submit" onclick="sendNotice('+orgID+')" class="btn btn-danger" style="margin-left: 10px;">Send Notice<\/button>'+
                                '<\/form>'+
                            '<\/div>'+
                        '<\/div>';
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
      function toggleForm(id){
        if ($('#'+id).css('display') === 'none'){
          $('#'+id).slideDown(400);
        }
        else{
          $('#'+id).slideUp(400);
        }
      }
      function viewDocuments(myID){
        $.ajax({
            type:"post",
            url:"<?php echo base_url(); ?>admin/viewDocuments",
            cache: false,
            data:{org_id: parseInt(myID, 10)},
            dataType: 'json',
            async: false,
            success:function(result){
             var output="<div style='display: flex; align-items: center; justify-content: center'>"+
         "<div class='card' style='height: 500px; overflow-y: scroll; width: 950px;'>"+
         "<div class='containerbutton' onclick='toggleForm(\"formAresult\")'><i class='fas fa-file-alt' style='margin-right: 15px;'><\/i><a href='#' id='showFormA'>View Form A<\/a><\/div>"+
         "<div id='formAresult' style='display: none;'>"+
             "<object data='<?php echo base_url(); ?>assets/org/accreditation/form_A/"+result['form_A']+"' type='pdf' width='100%' height='800'>"+
           "<iframe src='<?php echo base_url(); ?>assets/org/accreditation/form_A/"+result['form_A']+"'style='border: none; margin-left: 10px;' width='100%' height='800'>This browser does not support PDFs. Please download the PDF to view it: <a href='<?php echo base_url(); ?>assets/org/accreditation/form_A/"+result['form_A']+"'>Download PDF<\/a>"+
           "<\/iframe><\/object>"+
             "<\/div>"+
         "<div class='containerbutton' onclick='toggleForm(\"formBresult\")'><i class='fas fa-file-alt' style='margin-right: 15px;'><\/i><a href='#' id='showFormB'>View Form B<\/a><\/div>"+
         "<div id='formBresult' style='display: none;'>"+
         "<object data='<?php echo base_url(); ?>assets/org/accreditation/form_B/"+result['form_B']+"' type='pdf' width='100%' height='800'>"+
           "<iframe src='<?php echo base_url(); ?>assets/org/accreditation/form_B/"+result['form_B']+"'style='border: none; margin-left: 10px;' width='100%' height='800'>This browser does not support PDFs. Please download the PDF to view it: <a href='<?php echo base_url(); ?>assets/org/accreditation/form_B/"+result['form_B']+"'>Download PDF<\/a>"+
           "<\/iframe><\/object>"+
         "<\/div>"+
         "<div class='containerbutton' onclick='toggleForm(\"formCresult\")'><i class='fas fa-file-alt' style='margin-right: 15px;'><\/i><a href='#' id='showFormC'>View Form C<\/a><\/div>"+
         "<div id='formCresult' style='display: none;'>"+
         "<object data='<?php echo base_url(); ?>assets/org/accreditation/form_C/"+result['form_C']+"' type='pdf' width='100%' height='800'>"+
           "<iframe src='<?php echo base_url(); ?>assets/org/accreditation/form_C/"+result['form_C']+"'style='border: none; margin-left: 10px;' width='100%' height='800'>This browser does not support PDFs. Please download the PDF to view it: <a href='<?php echo base_url(); ?>assets/org/accreditation/form_C/"+result['form_C']+"'>Download PDF<\/a>"+
           "<\/iframe><\/object>"+
         "<\/div>"+
         "<div class='containerbutton' onclick='toggleForm(\"formDresult\")'><i class='fas fa-file-alt' style='margin-right: 15px;'><\/i><a href='#' id='showFormD'>View Form D<\/a><\/div>"+
         "<div id='formDresult' style='display: none;'>"+
         "<object data='<?php echo base_url(); ?>assets/org/accreditation/form_D/"+result['form_D']+"' type='pdf' width='100%' height='800'>"+
           "<iframe src='<?php echo base_url(); ?>assets/org/accreditation/form_D/"+result['form_D']+"'style='border: none; margin-left: 10px;' width='100%' height='800'>This browser does not support PDFs. Please download the PDF to view it: <a href='<?php echo base_url(); ?>assets/org/accreditation/form_D/"+result['form_D']+"'>Download PDF<\/a>"+
           "<\/iframe><\/object>"+
         "<\/div>"+
         "<div class='containerbutton' onclick='toggleForm(\"formEresult\")'><i class='fas fa-file-alt' style='margin-right: 15px;'><\/i><a href='#' id='showFormE'>View Form E<\/a><\/div>"+
         "<div id='formEresult' style='display: none;'>"+
         "<object data='<?php echo base_url(); ?>assets/org/accreditation/form_E/"+result['form_E']+"' type='pdf' width='100%' height='800'>"+
           "<iframe src='<?php echo base_url(); ?>assets/org/accreditation/form_E/"+result['form_E']+"'style='border: none; margin-left: 10px;' width='100%' height='800'>This browser does not support PDFs. Please download the PDF to view it: <a href='<?php echo base_url(); ?>assets/org/accreditation/form_E/"+result['form_E']+"'>Download PDF<\/a>"+
           "<\/iframe><\/object>"+
         "<\/div>"+
         "<div class='containerbutton' onclick='toggleForm(\"formFresult\")'><i class='fas fa-file-alt' style='margin-right: 15px;'><\/i><a href='#' id='showFormF'>View Form F<\/a><\/div>"+
         "<div id='formFresult' style='display: none;'>"+
         "<object data='<?php echo base_url(); ?>assets/org/accreditation/form_F/"+result['form_F']+"' type='pdf' width='100%' height='800'>"+
           "<iframe src='<?php echo base_url(); ?>assets/org/accreditation/form_F/"+result['form_F']+"'style='border: none; margin-left: 10px;' width='100%' height='800'>This browser does not support PDFs. Please download the PDF to view it: <a href='<?php echo base_url(); ?>assets/org/accreditation/form_F/"+result['form_F']+"'>Download PDF<\/a>"+
           "<\/iframe><\/object>"+
         "<\/div>"+
         "<div class='containerbutton' onclick='toggleForm(\"Plansresult\")'><i class='fas fa-file-alt' style='margin-right: 15px;'><\/i><a href='#' id='showPlans'>View Plans<\/a><\/div>"+
         "<div id='Plansresult' style='display: none;'>"+
         "<object data='<?php echo base_url(); ?>assets/org/accreditation/plans/"+result['plans']+"' type='pdf' width='100%' height='800'>"+
           "<iframe src='<?php echo base_url(); ?>assets/org/accreditation/plans/"+result['plans']+"'style='border: none; margin-left: 10px;' width='100%' height='800'>This browser does not support PDFs. Please download the PDF to view it: <a href='<?php echo base_url(); ?>assets/org/accreditation/plans/"+result['plans']+"'>Download PDF<\/a>"+
           "<\/iframe><\/object>"+
         "<\/div>"+
         "<div class='containerbutton' onclick='toggleForm(\"Constitutionresult\")'><i class='fas fa-file-alt' style='margin-right: 15px;'><\/i><a href='#' id='showPlans'>View Constitution<\/a><\/div>"+
         "<div id='Constitutionresult' style='display: none;'>"+
         "<object data='<?php echo base_url(); ?>assets/org/constitution/"+result['constitution']+"' type='pdf' width='100%' height='800'>"+
           "<iframe src='<?php echo base_url(); ?>assets/org/constitution/"+result['constitution']+"'style='border: none; margin-left: 10px;' width='100%' height='800'>This browser does not support PDFs. Please download the PDF to view it: <a href='<?php echo base_url(); ?>assets/org/constitution/"+result['constitution']+"'>Download PDF<\/a>"+
           "<\/iframe><\/object>"+
         "<\/div>"+   
     "<\/div>"+
     "<\/div>";
              swal({
                     title: '<h3>Accreditation Documents: </h3>'+result['acronym'],
                     text: output,
                     html: true,
                     customClass: 'swal-wide animated fadeIn',
                     showCancelButton: true,
                     showConfirmButton:false
                 });
            }
          });
        /*$.ajax({
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
          });*/
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
          <h4 class="modal-title"><i class="fa fa-folder-open fa-2x pull-left"></i>View Accreditation Applications</h4>

        </div><!-- Modal body -->
        <div class="modal-body">
          <div id="orgSearch">
            <div class="container">
              <p class="form-text text-muted">View organizations who applied for accreditation according to their status (pending, approved, rejected) and look over their documents. Approve or reject an application depending on the rules set. </p>
              <div class="mail-box">
                <aside class="lg-side">
                  <div class="inbox-head">
                    <form class="position needs-validation" onsubmit="return false">
                      <div class="mat-input" style="margin-top: 30px;">
                        <div class="mat-input-outer">
                          <input autocomplete="off" class="form-control" id="orgID" type="username"> <label class="">Enter Organization Name</label>
                          <div class="border"></div>
                        </div><button class="btn btn-danger btn-block" onclick="searchBox('')" style="margin-top: 10px;">Search</button>
                      </div>
                    </form>
                  </div>
                  <div class="inbox-body">
                    <button class="btn btn-info" onclick="searchBox('Pending')" type="button">Pending Applications</button> <button class="btn btn-success" onclick="searchBox('Accredited')" type="button">Approved</button> <button class="btn btn-danger" onclick="searchBox('Unaccredited')" type="button">Rejected</button>
                    <div class="mail-option"></div>
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
                    <div id="myResult" style="height: 300px; overflow-y: scroll;"></div>
                  </div>
                </aside>
              </div>
            </div>
          </div>
        </div>
        <div id="sendNoticeToOrgApp" style="display: none;"></div>
        <div class="modal-footer">
          <button class="btn btn-danger" data-dismiss="modal" onclick="resetOrgModal()" type="button">Close</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
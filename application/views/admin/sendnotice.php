<!DOCTYPE html>
<html>
<head>

  <script>
    function removeA(arr) {
    var what, a = arguments, L = a.length, ax;
    while (L > 1 && arr.length) {
        what = a[--L];
        while ((ax= arr.indexOf(what)) !== -1) {
            arr.splice(ax, 1);
        }
    }
    return arr;
}
    var allVals = [];
     function selectAll(){
      var allValsTemp = [];
       $("#searchValidate .recipient").each(function(){
         allValsTemp.push($(this).val());
       });
       allVals = allValsTemp;
       searchSendNotice();
     }

     function deselectAll(){
      var allValsTemp = [];
       allVals = allValsTemp;
       searchSendNotice();
     }

     function valsContain(id){
      for (var i=0; allVals.length; i++){
        if (allVals[i] == id){
          return true;
        }
      }
      return false;
     }

     function getRecipient(){
      var allValsTemp = [];
       $("#searchValidate :checked").each(function(){
         allValsTemp.push($(this).val());
       });
       allVals = allValsTemp;
     }

      function searchSendNotice(){
        var search = $("#sendNoticeInput").val();
                $.ajax({
             type:"post",
             url:"<?php echo base_url(); ?>admin/sendNoticeSearch",
             cache: false,
             data:{query: search, source: 'admin'},
             dataType: 'json',
             async: false,
             success:function(result){
             var output = "<div class='container' id='searchValidate'>" +
            "<table class='table table-striped custab'>"+
                "<thead>"+
                   "<tr>"+
                      "<th>Organization Name<\/th>"+
                      "<th>Organization Email<\/th>"+
                      "<th>Organization Status<\/th>"+
                      "<th class='text-center'>Action<\/th>"+
                   "<\/tr>"+
                "<\/thead>";
             for (var key in result) {
                if (result.hasOwnProperty(key)) {
                   output+="<tr>";
                   if (valsContain(result[key]['org_id'])){
                    output+="<td><div class='form-check'><label class='form-check-label'><input type='checkbox' class='recipient' checked value="+result[key]['org_id']+" class='form-check-input'>  "+result[key]['org_name']+"<\/label><\/div><\/td>";
                   }
                   else{
                    output+="<td><div class='form-check'><label class='form-check-label'><input type='checkbox' class='recipient' value="+result[key]['org_id']+" class='form-check-input'>  "+result[key]['org_name']+"<\/label><\/div><\/td>";
                   }
                   output+="<td>"+result[key]['org_email']+"<\/td>"+
                            "<td>"+result[key]['org_status']+"<\/td>"+
                            "<td><button class='btn btn-info btn-xs' onclick='sendNoticeButton(\""+result[key]['org_name']+"\","+result[key]['org_id']+")'> Send Notice<\/button><\/td><\/tr>  ";
                }
             }
             $("#sendNoticeResult").html(output);
            }
            });
      }

      $(document).ready(function(){
        $("#sendAllNotice").click(function(){
          var output = '<div class="container">'+
                            '<div class="form-area">'+
                                '<form role="form" onsubmit="return false">'+
                                    '<br style="clear:both">'+
                                    '<h3 style="margin-bottom: 25px; text-align: center;">Send Announcement to All<\/h3>'+
                                    '<div class="form-group">'+
                                        '<input type="text" class="form-control" id="sendNoticeTitle" maxlength="50" name="subject" placeholder="Title" required>'+
                                    '<\/div>'+
                                    '<div class="form-group">'+
                                        '<textarea class="form-control" onkeyup="textCounter()" type="textarea" id="sendNoticeMessage" placeholder="Message" maxlength="500" rows="7" required><\/textarea>'+
                                        '<span id="textcounter">500 characters remaining<\/span>'+
                                    '<\/div>'+
                                    '<a onclick="sendNoticeReset()" class="btn btn-info pull-right" style="color: white;">Back<\/a>'+
                                    '<button type="submit" onclick="sendNoticeToAll()" class="btn btn-danger" style="margin-left: 10px;">Send Notice<\/button>'+
                                '<\/form>'+
                            '<\/div>'+
                        '<\/div>';
        $("#sendNoticeToOrg").html('');
        $("#sendNoticeToAll").html(output);
        $("#sendNoticeSearch").slideUp(400);
        $("#sendNoticeToAll").delay(400).slideDown(400);
        });
             /*
             $("#sendAnnouncement").click(function(){
              var counter = $("#sendAnnouncementBox").val().length;
              if (counter > 500)
              {
                $("#sendNoticeAlert").addClass('alert alert-danger animated fadeIn');
                $("#sendNoticeAlert").html("You can only send a maximum of 500 characters.");
              }
              else if (counter > 0)
              {
                $("#sendNoticeAlert").removeClass('alert alert-danger animated fadeIn');
                $("#sendNoticeAlert").html("");
              }
              else
              {
                $("#sendNoticeAlert").addClass('alert alert-danger animated fadeIn');
                $("#sendNoticeAlert").html("Message field empty.");
              }

               var counter2 = $("#sendAnnouncementTitle").val().length;
              if (counter2 > 50)
              {
                $("#sendNoticeAlertTitle").addClass('alert alert-danger animated fadeIn');
                $("#sendNoticeAlertTitle").html("Title must not exceed 50 characters.");
              }
              else if (counter2 > 0)
              {
                $("#sendNoticeAlertTitle").removeClass('alert alert-danger animated fadeIn');
                $("#sendNoticeAlertTitle").html("");
              }
              else
              {
                $("#sendNoticeAlertTitle").addClass('alert alert-danger animated fadeIn');
                $("#sendNoticeAlertTitle").html("Title field empty.");
              }
        
             });*/
          });

      function sendNoticeButton(orgName,orgID){
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
                                    '<a onclick="sendNoticeReset()" class="btn btn-info pull-right" style="color: white;">Back<\/a>'+
                                    '<button type="submit" onclick="sendNotice('+orgID+')" class="btn btn-danger" style="margin-left: 10px;">Send Notice<\/button>'+
                                '<\/form>'+
                            '<\/div>'+
                        '<\/div>';
        $("#sendNoticeToAll").html('');
        $("#sendNoticeToOrg").html(output);
        $("#sendNoticeSearch").slideUp(400);
        $("#sendNoticeToOrg").delay(400).slideDown(400);
        //alert($("#recipientEmail").val());
        //$("#recipientEmail").placeholder = orgEmail;
      }

      function sendNoticeToAll()
      {
        var date = "<?php echo date('Y-m-d'); ?>";
        if ($("#sendNoticeTitle").val().length > 0 && $("#sendNoticeTitle").val().length < 51 && $("#sendNoticeMessage").val().length > 0 && $("#sendNoticeMessage").val().length < 501 ){
          swal({
         html: true,
         title: "<h4>Are you sure?<\/h4>",
         text: "Do you want to send this message to all organizations?",
         type: "warning",
         showCancelButton: true,
         confirmButtonClass: "btn-success",
         confirmButtonText: "Send",
         closeOnConfirm: false
         },
         function(){
          $.ajax({
          type:"post",
          url:"<?php echo base_url(); ?>admin/sendNoticeToAll",
          cache: false,
          data:{noticeTitle: $("#sendNoticeTitle").val(), noticeMessage: $("#sendNoticeMessage").val(), noticeDate: date},
          dataType: 'json',
          async: false,
          success:function(result){
         swal("Sent!", "This announcement has been sent.", "success");
         }
      
         });
         });
        }
      }

      function sendNoticeReset(){
              $("#sendNoticeToAll").slideUp(400);
              $("#sendNoticeToOrg").slideUp(400);
              $("#sendNoticeSearch").delay(400).slideDown(400);
            }

    function textCounter(){
            var counter = $("#sendNoticeMessage").val().length;
            $("#textcounter").html(500-counter+" characters remaining");
          }
  </script>
  <title></title>
</head>
<body>
  <div class="modal animated bounceInUp" data-backdrop="static" data-keyboard="false" id="sendnotice">
    <div class="modal-dialog modal-dialog-centered" style="min-width: 1200px;">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Send Announcement</h4>
        </div><!-- Modal body -->
        <div class="modal-body">
          <div id="sendNoticeSearch">
          <h1 style="text-align: center;">Select recipient</h1>
            <div class="container">
              <div class="mail-box">
                <aside class="lg-side">
                  <div class="inbox-head">
                    <form class="pull-right position" onsubmit="return false">
                      <div class="mat-input" style="margin-top: 30px;">
                        <div class="mat-input-outer">
                          <input autocomplete="off" class="form-control" id="sendNoticeInput" type="username"> <label class="">Enter Org Email/Name</label>
                          <div class="border"></div><button class="btn btn-danger btn-block" onclick="getRecipient()" style="margin-top: 10px">Search</button>
                        </div>
                      </div>
                      <div style="text-align: center"></div>
                      <table class="table table-inbox table-hover">
                        <tbody></tbody>
                      </table>
                    </form>
                  </div><button class="btn btn-success" onclick="selectAll()">Select All</button> <button class="btn btn-danger" onclick="deselectAll()">Deselect All</button>
                  <div class="inbox-body">
                    <div id="sendNoticeResult" style="height: 300px; overflow-y: scroll;"></div>
                  </div>
                </aside>
              </div>
            </div>
          </div>
        </div>
        <div id="sendNoticeToOrg" style="display: none;"></div>
        <div id="sendNoticeToAll" style="display: none;"></div><!-- Modal footer -->
        <div class="modal-footer">
          <button class="btn btn-success" onclick="">Send Notice</button> <button class="btn btn-danger" data-dismiss="modal" onclick="sendNoticeReset()" type="button">Close</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
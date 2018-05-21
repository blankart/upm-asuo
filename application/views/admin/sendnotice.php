<!DOCTYPE html>
<html>
<head>

  <script>
       var dataArray = [];
       var checkedDataArray = [];
       function sendNotice(){
        if ($('#sendNoticeTitle').val().length > 0 && $('#sendNoticeMessage').val().length > 0)
        {
          var notice = {
          title: (document.getElementById("sendNoticeTitle").value).trim(),
          content: (document.getElementById("sendNoticeMessage").value).trim(),
          orgIds: checkedDataArray
        };

        $.ajax({
          type: "POST",
          url: "<?php echo base_url().'admin/sendNotice'; ?>",
          cache: false,
          async: false,
          dataType: "JSON",
          data: {notice: notice},
          success: function(result){
             swal({title: "Success!", text: "Announcement Posted!", type: "success"},
                     function(){ 
                        document.getElementById("sendNoticeTitle").value = '';
                        document.getElementById("sendNoticeMessage").value = '';
                     }
                  );

          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
           alert("Status: " + textStatus); alert("Error: " + errorThrown); 
          }  
        });
        }
       }

       function addCheckedData(orgID){
         if (checkedDataArray.indexOf(orgID)==-1){
           checkedDataArray[checkedDataArray.length]=orgID;
         }
         else
         {
           checkedDataArray.splice(checkedDataArray.indexOf(orgID), 1);
         }
         updateNumOfRecipients();
         updaterecipientSection();
         searchSendNotice();
         updatesendNoticeFooter();
       }

       function selectAll(){
         checkedDataArray.length=0;
         for (var key in dataArray){
           if (dataArray.hasOwnProperty(key)){
             checkedDataArray[checkedDataArray.length] = parseInt(dataArray[key]['org_id']);
           }
         }
         updateNumOfRecipients();
         updaterecipientSection();
         searchSendNotice();
         updatesendNoticeFooter();
       }

       function deselectAll(){
         checkedDataArray.length=0;
         updateNumOfRecipients();
         updaterecipientSection();
         searchSendNotice();
         updatesendNoticeFooter();
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
               dataArray = result;
              var output = "<div class='container animated fadeIn' id='searchValidate'>" +
             "<table class='table table-striped custab'>"+
                 "<thead>"+
                    "<tr>"+
                       "<th>Organization Name<\/th>"+
                       "<th>Organization Email<\/th>"+
                       "<th>Organization Status<\/th>"+
                    "<\/tr>"+
                 "<\/thead>";
              for (var key in dataArray) {
                 if (dataArray.hasOwnProperty(key)) {
                   if (checkedDataArray.indexOf(parseInt(dataArray[key]['org_id'], 10))==-1){
                     console.log(checkedDataArray);
                     output+="<tr>";
                     output+="<td><div class='form-check'><label class='form-check-label'><input type='checkbox' class='recipient' onclick='addCheckedData("+dataArray[key]['org_id']+")' class='form-check-input'>  "+dataArray[key]['org_name']+"<\/label><\/div><\/td>";
                    
                    output+="<td>"+dataArray[key]['org_email']+"<\/td>"+
                             "<td>"+dataArray[key]['org_status']+"<\/td>"+
                             "<\/tr>  ";
                   }
                 }
              }
              $("#sendNoticeResult").html(output);
             }
             });
       }

       $(document).ready(function(){
         
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
       function sendNoticeButton(orgName){
         var output = '<div class="container">'+
                             '<div class="form-area">'+
                                 '<form role="form" onsubmit="return false">'+
                                     '<br style="clear:both">'+
                                     '<h3 style="margin-bottom: 25px; text-align: center;">Compose Message<\/h3>'+
                                     '<div class="form-group">'+
                                         '<input type="text" value="'+orgName+'"class="form-control" id="recipientEmail" readonly>'+
                                     '<\/div>'+
                                     '<div class="form-group">'+
                                         '<input type="text" minlength="1" maxlength="50" class="form-control" id="sendNoticeTitle"  name="subject" placeholder="Title" required>'+
                                     '<\/div>'+
                                     '<div class="form-group">'+
                                         '<textarea minlength="1" maxlength="500" class="form-control" onkeyup="textCounter()" type="textarea" id="sendNoticeMessage" placeholder="Message" rows="7" required><\/textarea>'+
                                         '<span id="textcounter">500 characters remaining<\/span>'+
                                     '<\/div>'+
                                     '<a onclick="sendNoticeReset()" class="btn btn-info pull-right" style="color: white;">Back<\/a>'+
                                     '<button type="submit" onclick="sendNotice()" class="btn btn-danger" style="margin-left: 10px;">Send Notice<\/button>'+
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

       function sendToAll(){
           var output = '<div class="container">'+
                             '<div class="form-area">'+
                                 '<form role="form" onsubmit="return false">'+
                                     '<br style="clear:both">'+
                                     '<h3 style="margin-bottom: 25px; text-align: center;">Send Announcement to All<\/h3>'+
                                     '<div class="form-group">'+
                                         '<input type="text" minlength="1" maxlength="50" class="form-control" id="sendNoticeTitle"name="subject" placeholder="Title" required>'+
                                     '<\/div>'+
                                     '<div class="form-group">'+
                                         '<textarea  minlength="1" maxlength="500" class="form-control" onkeyup="textCounter()" type="textarea" id="sendNoticeMessage" placeholder="Message" rows="7" required><\/textarea>'+
                                         '<span id="textcounter">500 characters remaining<\/span>'+
                                     '<\/div>'+
                                     '<a onclick="sendNoticeReset()" class="btn btn-info pull-right" style="color: white;">Back<\/a>'+
                                     '<button type="submit" onclick="sendNotice()" class="btn btn-danger" style="margin-left: 10px;">Send Notice<\/button>'+
                                 '<\/form>'+
                             '<\/div>'+
                         '<\/div>';
         $("#sendNoticeToOrg").html('');
         $("#sendNoticeToAll").html(output);
         $("#sendNoticeSearch").slideUp(400);
         $("#sendNoticeToAll").delay(400).slideDown(400);
         }

       function getDataArrayKey(orgID){
         for (var key in dataArray){
           if (dataArray.hasOwnProperty(key)){
             if (dataArray[key]['org_id']==orgID){
               return key;
             }
             else;
           }
         }
         return -1;
       }

       function updaterecipientSection(){
         output="";
         for (var key in checkedDataArray){
             output+="<span class='notice notice-success notice-sm animated fadeIn' style='margin: 5px;'>"+dataArray[getDataArrayKey(checkedDataArray[key])]['org_name']+"<\/span><button class='btn btn-sm btn-danger' onclick='addCheckedData("+checkedDataArray[key]+")' style='margin: 5px;'><i class='fas fa-trash-alt'><\/i><\/button>";
         }
         
         $('.recipientSection').html(output);
       }
       function updateNumOfRecipients(){
         var length = checkedDataArray.length;
         output = 'Recipients: ' + length;
         $(".numOfRecipients").html(output);
       }
       /*
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
       }*/

       function sendNoticeReset(){
               $("#sendNoticeToAll").slideUp(400);
               $("#sendNoticeToOrg").slideUp(400);
               $("#sendNoticeSearch").delay(400).slideDown(400);
             }

     function textCounter(){
             var counter = $("#sendNoticeMessage").val().length;
             $("#textcounter").html(500-counter+" characters remaining");
           }

     function updatesendNoticeFooter(){
      var output="";
      if (checkedDataArray.length>0){
        output="<button class='btn btn-success' onclick='send()' type='button'>Send Selected</button>";
      }
      else{
        output="";
      }
      $('#sendNoticeFooter').html(output);
     }

     function send(){
        if (checkedDataArray.length==dataArray.length){
          sendToAll();
        }
        else{
          var output="";
          for (var key in checkedDataArray){
            output+=dataArray[getDataArrayKey(checkedDataArray[key])]['org_name'];
            if (key!=checkedDataArray.length-1){
              output+=", ";
            }
          }
          sendNoticeButton(output);
        }
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
                    <form class="position" onsubmit="return false">
                      <div class="mat-input" style="margin-top: 30px;">
                        <div class="mat-input-outer">
                          <input autocomplete="off" class="form-control" id="sendNoticeInput" type="username"> <label class="">Enter Org Email/Name</label>
                          <div class="border"></div><button class="btn btn-danger btn-block" onclick="searchSendNotice()" style="margin-top: 10px">Search</button>
                        </div>
                      </div>
                      <div style="text-align: center"></div>
                      <table class="table table-inbox table-hover">
                        <tbody></tbody>
                      </table>
                    </form>
                  </div><button class="btn btn-success" onclick="selectAll()">Select All</button> <button class="btn btn-danger" onclick="deselectAll()">Deselect All</button>
                  <div class="inbox-body">
                    <div class='numOfRecipients alert alert-info' style='margin-top: 15px;'>
                      Recipients: 0
                    </div>
                    <div class='recipientSection' style='margin-top: 15px; margin-bottom: 15px;'></div>
                    <div id='sendNoticeFooter' style='padding-left: 88%; margin-bottom: 10px;'></div>
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
                    <div id="sendNoticeResult" style="height: 300px; overflow-y: scroll; display: block;"></div>
                  </div>
                </aside>
              </div>
            </div>
          </div>
        </div>
        <div id="sendNoticeToOrg" style="display: none;"></div>
        <div id="sendNoticeToAll" style="display: none;"></div><!-- Modal footer -->
        <div class="modal-footer">
          <button class="btn btn-danger" data-dismiss="modal" onclick="sendNoticeReset()" type="button">Close</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<?php
  if($this->session->userdata['account_type'] == 'admin'){
    $id = $this->session->userdata['user_id'];
  }
?><script>
  function viewAllNotices(){  
    var id = '<?php echo $id; ?>';
    $.ajax({
           type:"post",
           url:"<?php echo base_url(); ?>admin/viewAllNotices",
           cache: false,
           data: {id: id, source: 'admin'},
           dataType: 'json',
           async: false,
           success:function(result){
           var output = "<div class='container' id='searchValidate'>" +
          "<table class='table table-striped custab'>"+
              "<thead>"+
                 "<tr>"+
                    "<th>Date Posted</th>"+
                    "<th>Announcement Title</th>"+
                    "<th>Recipient</th>"+
                    "<th class='text-center'>Action</th>"+
                 "</tr>"+
              "</thead>";
           for (var key in result) {
              if (result.hasOwnProperty(key)) {
                 output+="<tr>"+
                          "<td>"+result[key]['date_posted']+"</td>"+
                          "<td>"+result[key]['title']+"</td>"+
                          "<td>"+result[key]['org_name']+"</td>"+
                          "<td><button class='btn btn-info btn-xs' onclick='viewMessage("+result[key]['notice_id']+")'> View Announcement</button></td></tr>  ";
              }
           }
           $("#allMessageResult").html(output);
          },
           error: function(XMLHttpRequest, textStatus, errorThrown) { 
               alert("Status: " + textStatus + " | Error: " + errorThrown); 
            }   
          });
  }     

  function viewMessage(noticeID){
    $.ajax({
           type:"post",
           url:"<?php echo base_url(); ?>admin/viewMessageDetails",
           cache: false,
           data: {id: noticeID},
           dataType: 'json',
           async: false,
           success:function(result){

            swal({
       html: true,
       title: "<h4>Message Details</h4>",
       text: "<div class='container' style='margin-top: 20px;'>"+
                "<div class='row' style='text-align: left;'>"+
                   "<div class='col'>"+
                      "<h4 style='font-size: 18px'><strong>Title</strong></h4>"+
                      "<h4 style='font-size: 18px'><strong>Date Posted</strong></h4>"+
                      "<h4 style='font-size: 18px'><strong>Message Body</strong></h4>"+
                      "</div>"+
                   "<div class='col'>"+
                      "<h4 style='font-size: 18px'>"+result['title']+"</h4>"+
                      "<h4 style='font-size: 18px'>"+result['date_posted']+"</h4>"+
                      "<h4 style='font-size: 18px'>"+result['content']+"</h4>"+
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
<div class="modal animated bounceInUp" id="viewallnotices" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" style="min-width: 1200px;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">View All Announcements</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <p class="form-text text-muted">View all posted announcements together with their details.</p>
                </div>
                <div id="allMessageResult" style="height: 600px; overflow-y: scroll;">
                  
                </div>
                <div id="viewMessage">
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
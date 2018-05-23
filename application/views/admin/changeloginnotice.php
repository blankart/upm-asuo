<script>

     $(document).ready(function(){

        $('#loginNoticeForm').on("submit",function(e){

            e.preventDefault();
                
            $.ajax({
               type: "post",
               url :"<?php echo base_url(); ?>admin/changeLoginNotice", 
               async: false,
               cache: false,
               contentType: false,
               processData: false,
               data: new FormData(this),
               success : function (data){
                   swal({title: "Success!", text: "You have successfully changed the login notice!", type: "success"},
                     function(){ 
                         location.reload();
                     }
                  );
               },
               error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  //alert("Status: " + textStatus + " | Error: " + errorThrown); 
                   swal("Error!", "Error in changing the login notice!", "error");
               }   
            });
             
          });
     });
    
</script>
<div class="modal animated bounceInUp" id="changeloginnotice" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 700px;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-edit fa-2x pull-left" style='margin-right: 20px;'></i>Change Login Notice</h4>
            </div>
            <!-- Modal body -->
            <form method="POST" id="loginNoticeForm" >
            <div class="modal-body">
				<div>
                    <p class="form-text text-muted">Message entered will appear on the login page and can be viewed by all.</p><br>
				</div>
				<div class="form-group">
					<input type="text" minlength="1" maxlength="50" class="form-control" id="sendNoticeTitle" name="data[title]" placeholder="Title" required>
				</div>   
				<div class="form-group">
					<textarea minlength="1" maxlength="500" class="form-control" type="textarea" id="loginNotice" placeholder="Message" rows="7" name="data[content]"required></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Submit</a>
            </div>

        </form>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
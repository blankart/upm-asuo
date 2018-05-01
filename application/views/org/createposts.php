<script>
    function changeID(){
        $("#tableMenu a").click(function(e){
            e.preventDefault();
             var selText = $(this).text();
            $("#tableButton").text(selText);
        });
    }
</script>
<div class="modal animated bounceInUp" id="createposts" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" style="min-width: 200px;">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Create Post</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
        <div class="modal-body">
            <div class="form-area">
                <form role="form" onsubmit="return false">
                    <h3 style="margin-bottom: 25px; text-align: center;">Compose Message</h3>
                                <select name="postID">
                                 <option value="Public">Public</option>
                                 <option value="Members">Members</option>
                                 <option value="ExeComm">ExeComm</option>
                                </select>
                                <br>
                        <input class="form-control" type="text" id="sendPostTitle" maxlength="50" name="subject" placeholder="Title" required>
            </div>
                <div class="form-group">
                    <textarea class="form-control" type="textarea" id="sendPostMessage" placeholder="Message" maxlength="500" rows="7" required></textarea>
                </div>
                </form>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" style="margin-left: 10px;">Submit Post</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>                
            </div>
        </div>
        
     </div>
    </div>



    </div>
  </div>
</div>
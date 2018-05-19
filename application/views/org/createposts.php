<?php 
  if($this->session->userdata['account_type'] == 'org'){
    $id = $this->session->userdata['user_id'];
  }

?>

<script>

     $(document).ready(function(){
        $("#createPostBtn").click(function(){
              createPost();
        });
        $("#createPostClose").click(function(){
              resetCreatePostFields();
        });
      });

    function changeID() {
        $("#tableMenu a").click(function(e) {
          e.preventDefault();
          var selText = $(this).text();
          $("#tableButton").text(selText);
        });
    }

    function swalSuccPost(){
  
       swal({title: "Success!", text: "You have successfully created a post!", type: "success"},
        function(){ 
          location.reload();
        }
      );
    }  

    function swalFailPost(){
      swal("Error!", "Failed to create a post!", "error");
   }

    function resetCreatePostFields(){
      document.getElementById("title").value = ' ';
      document.getElementById("content").value = ' ';
      document.getElementById("privacy").value = 'Public';
    }

    function createPost() {

      var title = (document.getElementById("title").value).trim();
      var content = (document.getElementById("content").value).trim();
      var privacy = document.getElementById("privacy").value;

      if(title != '' && content != ''){
        
        var post = {
          org_id: "<?php echo $id; ?>",
          title: title,
          content: content,
          privacy: privacy,
          archived: 0
        };

        $.ajax({
          type: "POST",
          url: "<?php echo base_url().'org/createPost'; ?>",
          cache: false,
          async: false,
          dataType: "JSON",
          data: {post, post},
          success: function(result){
            if(result)
              swalSuccPost();
            else
              swalFailPost();
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
           alert("Status: " + textStatus); alert("Error: " + errorThrown); 
          }  
        });
      }
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
            <form role="form" onsubmit="return false">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-area">

                        <h3 style="margin-bottom: 25px; text-align: center;">Compose Message</h3>
                        <div class="form-group" >
                            <select id='privacy'>
                                <option value="Public">Public</option>
                                <option value="Members">Members</option>
                                <option value="Officers">Officers</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" maxlength="50" class="form-control" id="title"  placeholder="Title" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea maxlength="500" class="form-control" id="content" placeholder="Message" rows="7" required></textarea>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" id = 'createPostBtn'  class="btn btn-success" style="margin-left: 10px;">Create Post</button>
                    <button type="button" id = 'createPostClose' class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>

</div>
</div>
</div>
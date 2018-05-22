<!DOCTYPE html>
<script>
  function uploadFile(){
    var file    = document.querySelector('input[type=file]').files[0];
  }
    $(document).ready(function(){
      $('#uploadFormB').on("submit",function(e){
               e.preventDefault();
               $.ajax({
                  type: "post",
                  url :"<?php echo base_url(); ?>org/uploadFormB", 
                  async: false,
                  cache: false,
                  contentType: false,
                  processData: false,
                  data: new FormData(this),
                  success : function (data){
                      swal({title: "Success!", text: "You have successfully uploaded your file!", type: "success"},
                        function(){ 
                           location.reload();
                        }
                     );
                  },
                  error: function(XMLHttpRequest, textStatus, errorThrown) { 
                     //alert("Status: " + textStatus + " | Error: " + errorThrown); 
                     swal("Error!", "Your file may be too large or not of valid type! (PDF only)", "error");
                  }   
            });
          });

    });
    function _(x){
      return document.getElementById(x);
    }

    function showPrev(){
      _("cont1").style.display = "none";
      _("cont2").style.display = "block";
    }

    function back(){
      _("cont1").style.display = "block";
      _("cont2").style.display = "none";
    }

</script>
<html class="no-js">
  <head>
    <title>Form B: Adviser's Consent</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sidenav.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/upload.css">
    <script src="<?php echo base_url();?>js/pdf.js"></script>
    <script src="<?php echo base_url();?>js/pdf.worker.js"></script>

    <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
  </head>

    <body>
        <div class="animated fadeIn" id="panel">
            <div class="col-4">
                <!-- insert sidenav -->
                <div class="sidenav">
                    <?php if($stay == "old"){ ?>
                    <ul class="menu">
                        <li><a href="<?php echo base_url(); ?>org/applyforaccreditation">Home</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formA">Accreditation Application</a></li>
                        <li class="active"><a href="<?php echo base_url(); ?>org/formB">Consent of Adviser</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formC">Organization Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formD">Officers' Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formE">Members' Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formF">Activity Report</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formG">Financial Report</a></li>
                        <li><a href="<?php echo base_url(); ?>org/plans">Plans</a></li>
                    </ul>

                    <?php } else{ ?>
                    <ul class="menu">
                        <li><a href="<?php echo base_url(); ?>org/applyforaccreditation">Home</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formA">Accreditation Application</a></li>
                        <li class="active"><a href="<?php echo base_url(); ?>org/formB">Consent of Adviser</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formC">Organization Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formD">Officers' Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/formE">Members' Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>org/plans">Plans</a></li>
                    </ul>
                    <?php } ?>
                <button class="submitAll" onclick="location.href = '<?php echo base_url(); ?>org/submitAll';">Submit All</button>    
                </div>
            </div>
                   
          <!-- Page Content -->
          <div class="main">
            <h1>Form B: Adviser's Consent</h1>

            <div class="content" id="cont1">
              <div class="box">
                <form enctype="multipart/form-data" method='POST' id='uploadFormB'>
                    <input type="file" name="formB" id="file-to-upload" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" accept="application/pdf" multiple/>
                    <label for="file-to-upload"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose a file&hellip;</span></label>                     
                    <br><br><br>
                
                 <div class="myBtn">
                    <button class="btn btn-danger" id="prevBtn" onclick="showPrev()">Preview</button> 
                 </div>
              </div>
            </div>

            <div class="content" id="cont2" style="display: none;">
              <div class="box">
                <div id="pdf-main-container">
                  <div id="pdf-loader">Loading document ...</div>
                    <div id="pdf-contents">
                      <canvas id="pdf-canvas" width="800"></canvas>
                      <div id="pdf-meta">
                        <div id="pdf-buttons">
                          <button class="btn btn-info" id="pdf-prev">Previous</button>
                          <button class="btn btn-info" id="pdf-next">Next</button>
                        </div>
                        <div id="page-count-container">Page <div id="pdf-current-page"></div> of <div id="pdf-total-pages"></div></div>
                      </div> <!--end meta -->
                      <div id="page-loader">Loading page ...</div>
                    </div> <!-- end contents-->
                </div> <!-- end container pdf-->
              <div class="myBtn"> 
                <button class="btn btn-danger" id ='submitFormB' onclick="document.getElementById('submitFormB').click();" >Upload</button>
                <button class="btn btn-danger" type="button" id="back" onclick="back()">Back</button>
              </div>
              </div>
            </div> <!--end cont2-->
            </form>
            <p>&nbsp;&nbsp;For the document template, &nbsp; <a href="<?php echo base_url(); ?>assets/org/accreditation/form_B/formB_template.docx" download>Click Here.</a></p>
            
          </div>
        <script src="<?php echo base_url();?>js/custom-file-input.js"></script>
        <script src="<?php echo base_url();?>js/preview.js"></script>
      </div>
  </body>
</html>
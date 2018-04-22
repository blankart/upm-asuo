  <script>
           /* $(document).ready(function(){
            load_data();

            function load_data(query)
            {

              
            }

            $('#idInputOrg').keyup(function(){
            var search = $(this).val();
              alert('hullo ');
            if(search != '')
            {
               alert('hullo ');
                $.ajax({
               type:"post",
               url:"<?php //echo base_url(); ?>admin/searchStudents",
               cache: false,
               data:{query: search},
               dataType: 'json',
               async: false,
               success:function(data){
                  alert(JSON.stringify(data.result));
               // $('#studResult').html(data);

               //$('#studResult').html();
            }
            });
            }
            else
            {
            load_data();
            }
            });
            });
*/
            function searchStudValidate(data)
            {
               var query = data;o
               alert(query);
            }

            function _(x){
               return document.getElementById(x);
            }
            function resetStudModal(){
                _("studSearch").style.display = "block";
                _("studResult").style.display = "none";
            }
            function viewStudApp(){
               swal("Sample info");
            }
            function rejectStud(){
               swal({
            html: true,
            title: "<h4>Confirm Action</h4>",
            text: "Do you want to reject this account?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Reject",
            closeOnConfirm: false
            },
            function(){
            swal("Deleted!", "This account has been rejected.", "success");
            });
            }
            function approveStud(){
               swal({
            html: true,
            title: "<h4>Confirm Action</h4>",
            text: "Do you want to validate this account?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-success",
            confirmButtonText: "Validate",
            closeOnConfirm: false
            },
            function(){
            swal("Approved!", "This account has been approved.", "success");
            });
            }

         </script>
<div class="modal animated bounceIn" id="validatestudact" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-dialog-centered" style="min-width: 1000px;">
   <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
         <h4 class="modal-title">Validate Student Account</h4>
         <button type="button" onclick="resetStudModal()" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">

         <div id="studSearch">
            <div class="container">
               <div class="mail-box">
                  <aside class="lg-side">
                     <div class="inbox-head">
                        <form class="pull-right position needs-validation" onsubmit="return false">
                           <table class="table table-inbox table-hover">
                              <tbody>
                                 <div class="mat-input" style="margin-top: 30px;">
                                    <div class="mat-input-outer">
                                       <input type="username" id="idInputStud" onkeyup="searchStudValidate(this.value)"class="form-control" autocomplete="off" required/>
                                       <label class="">Enter UP Mail</label>
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
         <!--<div id="studResult">

         </div>-->
         <!-- Modal footer -->
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" onclick="resetStudModal()" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

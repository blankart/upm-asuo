<!-- JS code -->
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/my-login.css">
<link rel="stylesheet" type="text/css" href="../css/animations.css">
<link rel="stylesheet" type="text/css" href="../css/material-search.css">
<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">

<script>
   function _(x){
      return document.getElementById(x);
   }  
   function searchValidate(){
      _("validate1").style.display = "none";
      alert(_("idInput").value);
   }
</script>
<button type="button" data-toggle="modal" class="btn btn-danger" data-target="#modalclick">Click me</button>
<div class="modal fade" id="modalclick" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title">Activate Student Account</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
            <div id="validate1">
               <table class="table table-inbox table-hover">
                  <tbody>
                     <div class="mat-input" style="margin-top: 30px;">
                        <div class="mat-input-outer">
                           <input type="text" id="idInput" onsubmit="return false" autocomplete="off"/>
                           <label class="">Enter student number</label>
                           <div class="border"></div>
                        </div>
                     </div>
                     <div style="text-align: center">
                        <h4 style="margin-top: 30px; font-size: 15px; text-align: center;">Search Format: 20XX-XXXXX</h4>
                        <button onclick="searchValidate()" class="btn btn-danger pull-right">Search</button>
                        <button onclick="viewAllValidate()" class="btn btn-danger pull-right">View All Applications</button>
                     </div>
                  </tbody>
               </table>
            </div>
            <div id="validate2">

            </div>
         </div>
         <!-- Modal footer -->
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<script src="../js/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../js/my-login.js"></script>
<script src="../js/jquery-3.3.1.js"></script>
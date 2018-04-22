 <script>
  $(document).ready(function(){
var search = $(this).val();
      $.ajax({
        type:"post",
        url:"<?php echo base_url(); ?>admin/searchAccredApp",
        cache: false,
        data:{query: search},
        dataType: 'json',
        async: false,
        success:function(result){
          var output = "<div class='container' id='searchValidate'>" +
                       "<table class='table table-striped custab'>"+
                       "<thead>"+
                       "<tr>"+
                       "<th>Organization ID</th>"+
                       "<th>Organization Name</th>"+
                       "<th class='text-center'>Action</th>"+
                       "</tr>"+
                       "</thead>";
   
          for (var key in result) {
            if (result.hasOwnProperty(key)) {
              output+="<tr>"+
                      "<td>"+result[key]['org_id']+"</td>"+
                      "<td>"+result[key]['org_name']+"</td>"+
                      //actions
                      "<td class='text-center'><button class='btn btn-info btn-xs' onclick='viewDocuments("+result[key]['org_id']+")' style='margin-left: 10px;'>View Documents</button>" + 
                      "<button onclick='accredit("+result[key]['org_id']+")' class='btn btn-success btn-xs' style='margin-left: 10px;'>Accredit</button>" +
                      "<button onclick='reject("+result[key]['org_id']+")' class='btn btn-danger btn-xs' style='margin-left: 10px;'>Reject</button></td>" +
                      "</tr>";
            }
          }
          $("#myResult").html(output);
        }
      });
  });
  function _(x){
    return document.getElementById(x);
  } 

  function viewAllOrg(orgID){
    _("orgMatches").style.display = "block";
  }

  function searchBox(){
      var search = $("#orgID").val();
      $.ajax({
        type:"post",
        url:"<?php echo base_url(); ?>admin/searchAccredApp",
        cache: false,
        data:{query: search},
        dataType: 'json',
        async: false,
        success:function(result){
          var output = "<div class='container' id='searchValidate'>" +
                       "<table class='table table-striped custab'>"+
                       "<thead>"+
                       "<tr>"+
                       "<th>Organization ID</th>"+
                       "<th>Organization Name</th>"+
                       "<th class='text-center'>Action</th>"+
                       "</tr>"+
                       "</thead>";
   
          for (var key in result) {
            if (result.hasOwnProperty(key)) {
              output+="<tr>"+
                      "<td>"+result[key]['org_id']+"</td>"+
                      "<td>"+result[key]['org_name']+"</td>"+
                      //actions
                      "<td class='text-center'><button class='btn btn-info btn-xs' onclick='viewDocuments("+result[key]['org_id']+")' style='margin-left: 10px;'>View Documents</button>" + 
                      "<button onclick='accredit("+result[key]['org_id']+")' class='btn btn-success btn-xs' style='margin-left: 10px;'>Accredit</button>" +
                      "<button onclick='reject("+result[key]['org_id']+")' class='btn btn-danger btn-xs' style='margin-left: 10px;'>Reject</button></td>" +
                      "</tr>";
            }
          }
          $("#myResult").html(output);
        }
      });
  } //end function

  function accredit(myID){
    swal({
      html: true,
      title: "<h4>Confirm Action</h4>",
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
        }

      });
    });
  }

  function reject(myID){
    swal({
      html: true,
      title: "<h4>Confirm Action</h4>",
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
        }

      });
    });
  }

  function viewDocuments(myID){
    swal("*insert documents here*");
  }


  function resetOrgModal(){
    _("orgsSearch").style.display = "block";
    _("orgMatches").style.display = "none";
  }
</script>




<div class="modal animated bounceInUp" id="viewaccreditapp" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" style="min-width: 1200px;">
    <div class="modal-content">

      <!-- Modal Header -->
        <div class="modal-header">
           <h4 class="modal-title">View Accreditation Applications</h4>
        </div>
      
      <!-- Modal body -->
      <div class="modal-body">
         <div id="orgSearch">
            <div class="container">
               <div class="mail-box">
                  <aside class="lg-side">
                     <div class="inbox-head">
                        <form class="pull-right position needs-validation" onsubmit="return false">
                           <table class="table table-inbox table-hover">
                              <tbody>
                                 <div class="mat-input" style="margin-top: 30px;">
                                    <div class="mat-input-outer">
                                       <input type="username" id="orgID" onkeyup="searchBox()" class="form-control" autocomplete="off" required/>
                                       <label class="">Enter Organization Name</label>
                                       <div class="border"></div>
                                    </div>
                                 </div>
                                 <div style="text-align: center">
                                    <h4 style="margin-top: 30px; font-size: 15px; text-align: center;">Search Format: UP Organization Name</h4>
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
          <div id="myResult" style="height: 300px; overflow-y: scroll;">
          
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="resetOrgModal()" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
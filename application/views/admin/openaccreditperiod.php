<script>
  $('#openaccredbutton').click(function(){
    $('#accreditperiodalert').hide();
  });
  $(document).ready(function(){
    $('#accreditperiodalert').hide();
  });

    function getDate(date){
      return new Date(date).getTime();
    }
   function setAccredPer(){
    getDate();
    if ($('#startDate').val()!="" && $('#endDate').val()!="")
    {
      if (getDate($('#startDate').val())>=getDate($('#endDate').val())){
      $('#accreditperiodalert').slideDown(400);
      $('#accreditperiodalert').html('<strong>Error: </strong>End date must be greater than the start date.');
    }
    else if (getDate($('#endDate').val())<=getDate("<?php echo Date('M-d-Y');?>")){
      $('#accreditperiodalert').slideDown(400);
      $('#accreditperiodalert').html('<strong>Error: </strong>End date must be greater than the current date.');
    }
    else{
      $('#accreditperiodalert').hide();
      swal({
       title: "Are you sure?",
       text: "Setting the accreditation will open accreditation processes in orgs.",
       type: "warning",
       showCancelButton: true,
       confirmButtonClass: "btn-danger",
       confirmButtonText: "Yes, set it!",
       closeOnConfirm: false
      },
   function(){
      //AJAX NESTED WITH SUCCESS SWAL
      });
    }
  }
    else{
      $('#accreditperiodalert').slideDown(400);
      $('#accreditperiodalert').html('<strong>Error: </strong>Field/s required.');
    }
    
      /*swal({
       title: "Are you sure?",
       text: "Setting the accreditation will open accreditation processes in orgs.",
       type: "warning",
       showCancelButton: true,
       confirmButtonClass: "btn-danger",
       confirmButtonText: "Yes, set it!",
       closeOnConfirm: false
      },
   function(){
      swal("Period Set!", "You have set the accreditation period.", "success");
      });*/
   }
</script>
<div class="modal animated bounceInUp" id="openaccreditperiod" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 700px;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-calendar fa-2x pull-left admin-icon" style='margin-right: 20px;'></i>Open Accreditation Period</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
              <p class="form-text text-muted">Set accreditation period for the academic year.</p>
               <div class="form-group">
                <div class='notice notice-danger' id='accreditperiodalert'></div>
                  <center><label class="control-label">Start Date</label>
                  <center><input id='startDate' class="form-control" style="min-width: 160px" type="date" required>
               </div>
               <div class="form-group">
                  <center><label class="control-label">End Date</label>
                  <center><input id='endDate' class="form-control" style="min-width: 160px" type="date" required>
               </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-basic" data-dismiss="modal">Close</button> <button type="submit" onclick="setAccredPer()" class="btn btn-danger">Save</button>
            </div>
            </div>
        </div>
    </div>
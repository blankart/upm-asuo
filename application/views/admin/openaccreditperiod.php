<script>
   function setAccredPer(){
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
      swal("Period Set!", "You have set the accreditation period.", "success");
      });
   }
</script>
<div class="modal animated bounceInUp" id="openaccreditperiod" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 350px;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Open Accreditation Period</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
              <p class="form-text text-muted">Set accreditation period for the academic year.</p>
               <div class="form-group">
                  <center><label class="control-label">Start Date</label>
                  <center><input class="form-control" style="max-width: 160px" type="date" name="startDate">
               </div>
               <div class="form-group">
                  <center><label class="control-label">End Date</label>
                  <center><input class="form-control" style="max-width: 160px" type="date" name="endDate">
               </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-basic" data-dismiss="modal">Close</button> <button type="submit" onclick="setAccredPer()" class="btn btn-danger">Save</button>
            </div>
            </div>
        </div>
    </div>
<div class="modal animated bounceInUp" id="applyforaccreditation">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Accreditation Requirements</h4>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <table>
          <tr>
            <!-- Form A: Accreditation Application-->
            <form method="post" action="viewFormA" target="_blank">
              <td>Accreditation Application</td>
              <td width="500" align="right"><button type="submit" value="formA" class="btn btn-info" data-toggle="modal" data-target="#formA">Edit</button></td>
            </form> 
          </tr>
          <tr>
            <!-- Form B: Consent of Adviser-->
            <form method="post" action="viewFormB" target="_blank">
              <td>Consent of Adviser</td>
              <td align="right"><button type="submit" value="formB" class="btn btn-info" data-toggle="modal" data-target="#formB">Edit</button></td>
            </form> 
          </tr>
          <tr>
            <!-- Form C: Organization Profile-->
            <form method="post" action="viewFormC" target="_blank">
              <td>Organization Profile</td>
              <td align="right"><button type="submit" value="formC" class="btn btn-info" data-toggle="modal" data-target="#formC">Edit</button></td>
            </form>
          </tr>
          <tr>
            <!-- Form D: Officer's Profile-->
            <form method="post" action="viewFormD" target="_blank">
              <td>Officers' Profile</td>
              <td align="right"><button type="submit" value="formD" class="btn btn-info" data-toggle="modal" data-target="#formD">Edit</button></td>
            </form>
          </tr>
          <tr>
            <!-- Form E: Member's Profile-->
            <form method="post" action="viewFormE" target="_blank">
              <td>Members' Profile</td>
              <td align="right"><button type="submit" value="formE" class="btn btn-info" data-toggle="modal" data-target="#formE">Edit</button></td>
            </form>
          </tr>
          <tr>
            <!-- Form F: Financial Profile-->
            <form method="post" action="viewFormF" target="_blank">
              <td>Financial Report</td>
              <td align="right"><button type="submit" value="formF" class="btn btn-info" data-toggle="modal" data-target="#formF">Edit</button></td>
            </form>
          </tr>
        </table>

        <!-- progress bars -->
        <div class="progress">
          <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">70% Complete (danger)</div>
        </div>
        
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
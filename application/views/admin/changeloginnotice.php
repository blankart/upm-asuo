<div class="modal animated bounceInUp" id="changeloginnotice" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 700px;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-edit fa-2x pull-left" style='margin-right: 20px;'></i>Change Login Notice</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
				<div>
                    <p class="form-text text-muted">Message entered will appear on the login page and can be viewed by all.</p><br>
				</div>
				<div class="form-group">
					<input type="text" minlength="1" maxlength="50" class="form-control" id="sendNoticeTitle" name="subject" placeholder="Title" required>
				</div>   
				<div class="form-group">
					<textarea minlength="1" maxlength="500" class="form-control" type="textarea" id="loginNotice" placeholder="Message" rows="7" required></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Submit</a>
            </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
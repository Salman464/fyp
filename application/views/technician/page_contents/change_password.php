<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Change Password</h4>
			</div>
		</div>
		<div class="card" id="changePassword">
			<div class="card-body">
				<div class="card-title" style="border-bottom: 1px solid black;">
					<h4>Change password</h4>
				</div>
				<form action="<?php echo site_url('User/updatePassword'); ?>" method="post">
					<div class="row p-t-20">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Old Password</label>
								<input type="password" name="old_pass" class="form-control" value="" placeholder="Enter your current Password" required>
							</div>
						</div>
					</div>
                    <div class="row p-t-20">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">New Password</label>
								<input type="password" name="new_pass" class="form-control" value="" placeholder="Enter new password" required>
							</div>
						</div>
                        <div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Confirm Password</label>
								<input type="password" name="confirm_pass" class="form-control" value="" placeholder="Confirm new password" required>
							</div>
						</div>
					</div>
					<div class="form-actions text-right">
						<button type="submit" class="btn btn-success">Change Password</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

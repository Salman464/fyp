<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Profile</h4>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="card-title" style="border-bottom: 1px solid black;">
					<h3>Details</h3>
				</div>
				<div class="row p-t-20">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">User ID</label>
							<input type="number" class="form-control"
								   value="<?php echo $this->session->userdata('user_id'); ?>" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Name</label>
							<input type="text" class="form-control"
								   value="<?php echo $this->session->userdata('name'); ?>" disabled>
						</div>
					</div>
				</div>
				<div class="row p-t-20">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Email</label>
							<input type="Email" class="form-control"
								   value="<?php echo $this->session->userdata('email'); ?>" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Contact#</label>
							<input type="text" class="form-control"
								   value="<?php echo $this->session->userdata('phone_number'); ?>" disabled>
						</div>
					</div>
				</div>
				<div class="row p-t-20">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Role</label>
							<?php
							if ($this->session->userdata('user_type') === '1') {
								$role = "Admin";
							} else if ($this->session->userdata('user_type') === '2') {
								$role = "IT Admin";
							} else if ($this->session->userdata('user_type') === '3') {
								$role = "Complainant";
							} else if ($this->session->userdata('user_type') === '4') {
								$role = "Storeman";
							} else if ($this->session->userdata('user_type') === '5') {
								$role = "Treasurer";
							} else if ($this->session->userdata('user_type') === '6') {
								$role = "Purchaser";
							} else if ($this->session->userdata('user_type') === '9') {
								$role = "Technician";
							}
							?>
							<input type="text" class="form-control" value="<?php echo $role; ?>" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Ext#</label>
							<input type="text" class="form-control" value="<?php echo $this->session->userdata('ext'); ?>" disabled>
						</div>
					</div>
				</div>
				<div class="form-actions text-right">
					<button type="Edit" href="javascript:void(0)" class="btn btn-info"
							onclick="showDetails('details','updateInfo')"><i class="fa fa-pencil"
																			 style="margin-right: 10px;"></i>Edit
					</button>
				</div>
			</div>
		</div>
		<div class="card" id="updateInfo" style="display: none;">
			<div class="card-body">
				<div class="card-title" style="border-bottom: 1px solid black;">
					<h3>Update Info</h3>
				</div>
				<form action="<?php echo site_url('User/updateInfo'); ?>" method="post">
					<input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">
					<div class="row p-t-20">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Name</label>
								<input type="text" name="name" class="form-control"
									   value="<?php echo $this->session->userdata('name'); ?>" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Contact#</label>
								<input type="number" pattern="\d*" onKeyPress="if(this.value.length==15) return false;"
									   name="phone_number" class="form-control"
									   value="<?php echo $this->session->userdata('phone_number'); ?>" required>
							</div>
						</div>
					</div>
					<div class="row p-t-20">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Ext#</label>
								<input type="number" pattern="\d*" onKeyPress="if(this.value.length==4) return false;" name="ext" class="form-control" value="<?php echo $this->session->userdata('ext'); ?>" required>
							</div>
						</div>
					</div>
					<div class="form-actions text-right">
						<button type="submit" class="btn btn-success">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

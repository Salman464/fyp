<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Users</h4>
			</div>
			<div class="col-md-7 align-self-center text-right">
				<div class="d-flex justify-content-end align-items-center">
					<button type="button" class="btn btn-info" data-toggle="modal" data-target="#add-Admin"><i class="fa fa-plus-circle" style="margin-right: 5px;"></i> Create New User
					</button>
				</div>
			</div>
		</div>
		<div id="add-Admin" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<form role="form" action="<?php echo site_url('Admin/add_admin'); ?>" method="post"  class="form-horizontal form-material">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Add User's Details</h4>
							<button type="reset" value="reset" class="close" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times-circle" style="margin-right: 5px;"></i></button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<div class="col-md-12 m-b-20">
									<input type="number" pattern="\d*" onKeyPress="if(this.value.length==15) return false;" name="id" class="form-control" placeholder="ID" required>
								</div>
								<div class="col-md-12 m-b-20">
									<select name="adminType" required class="form-control custom-select" required>
										<option value="">--Select User Type--</option>
										<option value="1">Admin</option>
										<option value="2">IT Supervisor</option>
										<option value="3">Complainant</option>
										<option value="4">Store Man</option>
										<option value="5">Treasurer</option>
										<option value="6">Purchaser</option>
										<option value="7">Asset Keeper</option>
									</select>
								</div>
								<div class="col-md-12 m-b-20">
									<input type="text" class="form-control" name="admin_name" placeholder="Name" required>
								</div>
								<div class="col-md-12 m-b-20">
									<input type="number" pattern="\d*" onKeyPress="if(this.value.length==15) return false;" class="form-control" name="phone_number" placeholder="Phone Number" required>
								</div>
								<div class="col-md-12 m-b-20">
									<input type="number" pattern="\d*" onKeyPress="if(this.value.length==4) return false;" class="form-control" name="ext" placeholder="Extension Number" required>
								</div>
								<div class="col-md-12 m-b-20">
									<input type="email" class="form-control" id="mail" name="email" placeholder="Email" required>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn waves-effect waves-light btn-rounded btn-info">
								Save
							</button>
							<button type="reset" value="reset" class="btn waves-effect waves-light btn-rounded btn-secondary" data-dismiss="modal">Cancel
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<?php if ($this->session->flashdata('errors')) { ?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo "Error: Email is already registered, use another email!"; ?>
			</div>
		<?php } ?>
		<?php if ($this->session->flashdata('success')) { ?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo "created Successfully"; ?>
			</div>
		<?php } ?>
		<div class="card">
			<div class="card-body">
				<!-- Nav tabs -->
				<div class="vtabs customvtab">
					<ul class="nav nav-tabs tabs-vertical" role="tablist">
						<li class="nav-item"><a class="nav-link active " data-toggle="tab" href="#allComplaints" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">All Users</span> </a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pending" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Admins</span></a>
						</li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#processing" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">IT Admins</span></a>
						</li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#productWaiting" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Complainants</span></a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#resolve" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Store Man</span></a>
						</li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#reject" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Treasurers</span></a>
						</li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#purchaser" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Purchasers</span></a>
						</li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active" id="allComplaints" role="tabpanel">
							<div class="p-20">
								<div class="table-responsive">
									<table id="allComplaintsTable" class="table table-bordered table-striped">
										<thead>
										<tr>
										<tr>
											<th>User ID#</th>
											<th>Name</th>
											<th>Role</th>
											<th>Phone Number</th>
											<th>Email</th>
										</tr>
										</tr>
										</thead>
										<tbody>
										<?php foreach ($allUsers as $row) { ?>
											<tr>
												<td><b><?php echo $row->user_id; ?></b></td>
												<td><?php echo $row->name; ?></td>
												<td>
													<?php if ($row->user_type == 1) {
														echo "Admin";
													} else if ($row->user_type == 2) {
														echo "IT Admin";
													} else if ($row->user_type == 3) {
														echo "Complainant";
													} else if ($row->user_type == 4) {
														echo "Store Man";
													} else if ($row->user_type == 5) {
														echo "Treasurer";
													} else if ($row->user_type == 6) {
														echo "Purchaser";
													} ?>
												</td>
												<td><?php echo $row->phone_number; ?></td>
												<td><?php echo $row->email; ?></td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="tab-pane p-20" id="pending" role="tabpanel">
							<div class="table-responsive">
								<table id="pendingComplaints" class="table table-bordered table-striped">
									<thead>
									<tr>
									<tr>
										<th>User ID#</th>
										<th>Name</th>
										<th>Role</th>
										<th>Phone Number</th>
										<th>Email</th>
									</tr>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($admins as $row) { ?>
										<tr>
											<td><b><?php echo $row->user_id; ?></b></td>
											<td><?php echo $row->name; ?></td>
											<td>
												<?php if ($row->user_type == 1) {
													echo "Admin";
												} else if ($row->user_type == 2) {
													echo "IT Admin";
												} else if ($row->user_type == 3) {
													echo "Complainant";
												} else if ($row->user_type == 4) {
													echo "Store Man";
												} else if ($row->user_type == 5) {
													echo "Treasurer";
												} else if ($row->user_type == 6) {
													echo "Purchaser";
												} ?>
											</td>
											<td><?php echo $row->phone_number; ?></td>
											<td><?php echo $row->email; ?></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane p-20" id="processing" role="tabpanel">
							<div class="table-responsive">
								<table id="processingComplaints" class="table table-bordered table-striped">
									<thead>
									<tr>
									<tr>
										<th>User ID#</th>
										<th>Name</th>
										<th>Role</th>
										<th>Phone Number</th>
										<th>Email</th>
									</tr>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($itadmins as $row) { ?>
										<tr>
											<td><b><?php echo $row->user_id; ?></b></td>
											<td><?php echo $row->name; ?></td>
											<td>
												<?php if ($row->user_type == 1) {
													echo "Admin";
												} else if ($row->user_type == 2) {
													echo "IT Admin";
												} else if ($row->user_type == 3) {
													echo "Complainant";
												} else if ($row->user_type == 4) {
													echo "Store Man";
												} else if ($row->user_type == 5) {
													echo "Treasurer";
												} else if ($row->user_type == 6) {
													echo "Purchaser";
												} ?>
											</td>
											<td><?php echo $row->phone_number; ?></td>
											<td><?php echo $row->email; ?></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane p-20" id="productWaiting" role="tabpanel">
							<div class="table-responsive">
								<table id="productWaitingComplaints" class="table table-bordered table-striped">
									<thead>
									<tr>
									<tr>
										<th>User ID#</th>
										<th>Name</th>
										<th>Role</th>
										<th>Phone Number</th>
										<th>Email</th>
									</tr>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($complainant as $row) { ?>
										<tr>
											<td><b><?php echo $row->user_id; ?></b></td>
											<td><?php echo $row->name; ?></td>
											<td>
												<?php if ($row->user_type == 1) {
													echo "Admin";
												} else if ($row->user_type == 2) {
													echo "IT Admin";
												} else if ($row->user_type == 3) {
													echo "Complainant";
												} else if ($row->user_type == 4) {
													echo "Store Man";
												} else if ($row->user_type == 5) {
													echo "Treasurer";
												} else if ($row->user_type == 6) {
													echo "Purchaser";
												} ?>
											</td>
											<td><?php echo $row->phone_number; ?></td>
											<td><?php echo $row->email; ?></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane p-20" id="resolve" role="tabpanel">
							<div class="table-responsive">
								<table id="resolveComplaints" class="table table-bordered table-striped">
									<thead>
									<tr>
									<tr>
										<th>User ID#</th>
										<th>Name</th>
										<th>Role</th>
										<th>Phone Number</th>
										<th>Email</th>
									</tr>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($store as $row) { ?>
										<tr>
											<td><b><?php echo $row->user_id; ?></b></td>
											<td><?php echo $row->name; ?></td>
											<td>
												<?php if ($row->user_type == 1) {
													echo "Admin";
												} else if ($row->user_type == 2) {
													echo "IT Admin";
												} else if ($row->user_type == 3) {
													echo "Complainant";
												} else if ($row->user_type == 4) {
													echo "Store Man";
												} else if ($row->user_type == 5) {
													echo "Treasurer";
												} else if ($row->user_type == 6) {
													echo "Purchaser";
												} ?>
											</td>
											<td><?php echo $row->phone_number; ?></td>
											<td><?php echo $row->email; ?></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane p-20" id="reject" role="tabpanel">
							<div class="table-responsive">
								<table id="rejectComplaints" class="table table-bordered table-striped">
									<thead>
									<tr>
									<tr>
										<th>User ID#</th>
										<th>Name</th>
										<th>Role</th>
										<th>Phone Number</th>
										<th>Email</th>
									</tr>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($treasurer as $row) { ?>
										<tr>
											<td><b><?php echo $row->user_id; ?></b></td>
											<td><?php echo $row->name; ?></td>
											<td>
												<?php if ($row->user_type == 1) {
													echo "Admin";
												} else if ($row->user_type == 2) {
													echo "IT Admin";
												} else if ($row->user_type == 3) {
													echo "Complainant";
												} else if ($row->user_type == 4) {
													echo "Store Man";
												} else if ($row->user_type == 5) {
													echo "Treasurer";
												} else if ($row->user_type == 6) {
													echo "Purchaser";
												} ?>
											</td>
											<td><?php echo $row->phone_number; ?></td>
											<td><?php echo $row->email; ?></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane p-20" id="purchaser" role="tabpanel">
							<div class="table-responsive">
								<table id="myTable" class="table table-bordered table-striped">
									<thead>
									<tr>
									<tr>
										<th>User ID#</th>
										<th>Name</th>
										<th>Role</th>
										<th>Phone Number</th>
										<th>Email</th>
									</tr>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($purchaser as $row) { ?>
										<tr>
											<td><b><?php echo $row->user_id; ?></b></td>
											<td><?php echo $row->name; ?></td>
											<td>
												<?php if ($row->user_type == 1) {
													echo "Admin";
												} else if ($row->user_type == 2) {
													echo "IT Admin";
												} else if ($row->user_type == 3) {
													echo "Complainant";
												} else if ($row->user_type == 4) {
													echo "Store Man";
												} else if ($row->user_type == 5) {
													echo "Treasurer";
												} else if ($row->user_type == 6) {
													echo "Purchaser";
												} ?>
											</td>
											<td><?php echo $row->phone_number; ?></td>
											<td><?php echo $row->email; ?></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

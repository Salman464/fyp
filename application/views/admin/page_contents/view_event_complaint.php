<?php extract($complaint_details);
if ($complaint_feedback != 0) {
	extract($complaint_feedback);
}
?>
<div class="page-wrapper printArea">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Complaint# <?php echo $complaint_id; ?></h4>
			</div>
			<div class="col-md-7 align-self-center text-right">
				<div class="d-flex justify-content-end align-items-center">
					<a style="font-size: 18px;" href="javascript:void(0)" onclick="printSection()">Print<i class="fas fa-print" style="color: black; margin-left:5px;"></i></a>
				</div>
			</div>
		</div>
		<div id="close_complaint" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<form action="<?php echo site_url('Admin/close_complaint'); ?>" method="post" class="form-horizontal form-material">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Remarks</h4>
							<button type="reset" value="reset" class="close" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times-circle" style="margin-right: 5px;"></i></button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<input type="hidden" name="complaint_id" value="<?php echo $complaint_id; ?>">
								<div class="col-md-12 m-b-20">
									<div class="custom-control mb-3 custom-radio">
										<input checked type="radio" id="customRadio1" value="Resolved" name="remarks" class="custom-control-input">
										<label class="custom-control-label" for="customRadio1">Resolved</label>
									</div>
									<div class="custom-control custom-radio">
										<input type="radio" id="customRadio2" value="Rejected" name="remarks" class="custom-control-input">
										<label class="custom-control-label" for="customRadio2">Rejected</label>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn waves-effect waves-light btn-rounded btn-info">Save
							</button>
							<button type="reset" value="reset" class="btn waves-effect waves-light btn-rounded btn-secondary" data-dismiss="modal">
								Cancel
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="card-title " style="border-bottom: 1px solid black;">
							<h3><?php echo $subject; ?> <?php echo ($status == 3) ? "<p class='label label-lg label-success'>Closed</p>" : ""; ?></h3>
						</div>
						<div class="card-subtitle ">
							Date: <?php echo date('d M Y | h:i A', strtotime($complaint_date)); ?>
						</div>
						<?php $dateString = date('Y-m-d', strtotime($expected_completion_time));
						if ($dateString[0] !== "-") { ?>
							<div style="color: <?php echo $expected_completion_time < time() ? "limegreen" : "red"; ?>" class="card-subtitle ">
								Due Time:
								<?php echo date('d M Y | h:i A', strtotime($expected_completion_time)); ?>
							</div>
						<?php } ?>
						<div class="form-group " style="text-align: justify; padding: 0px 10px 0px; margin-bottom: 16px;">
							<label>Department: </label>
							<input type="text" disabled value="<?php echo $dept_name; ?>">
						</div>
						<p class="card-text " style="text-align: justify; padding: 0px 10px 0px; font-size:1rem; margin-bottom: 16px;">
							<?php echo $description; ?>
						</p>
						<?php if ($status != 3 && $dept_name != "IT") { ?>
							<?php if ($technician_id == 1) { ?>
								<a class="card-link" id="buttonToggler" href="<?php echo site_url('Admin/addEventTechnician/' . $complaint_id); ?>">
									<button class="btn btn-success">Assign
										Technician
									</button>
								</a>
							<?php } ?>
							<a class="card-link" id="reqButtonToggler" onclick="toggleView2('productDetails')">
								<button class="btn btn-success">Request
									Product!
								</button>
							</a>
							<?php $dateString = date('Y-m-d', strtotime($expected_completion_time));
							if ($dateString[0] === "-") { ?>
								<a class="card-link" id="completionFormBtn" onclick="showDetails('completionFormBtn', 'completionForm')">
									<button class="btn btn-success">Enter Complaint
										Completion Time!
									</button>
								</a>
							<?php } ?>
							<button style="margin-left: 5px;" type="button" class="btn btn-info" data-toggle="modal" data-target="#close_complaint">Close
								Complaint
							</button>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<div class="card" id="completionForm" style="display: none;">
			<form onsubmit="return validateCompletionTime()" action="<?php echo site_url('Admin/updateTime/' . $complaint_id); ?>" method="post">
				<div class="card-body">
					<div class="form-group  row">
						<label for="example-text-input" class="col-2 col-form-label">Completion Time</label>
						<div class="col-9">
							<input type="hidden" id="complaint_date" class="form-control" value="<?php echo date("Y-m-d\Th:i", strtotime($complaint_date)); ?>">
							<input name="date" id="date" class="form-control" type="datetime-local" value="">
							<p id="dateErr" style="display: none; color: red;">Complaint Completion time must be greater that complaint time!</p>
						</div>
						<div class="col-1">
							<button type="submit" class="btn btn-sm btn-info">Update</button>
						</div>
					</div>
				</div>
			</form>
		</div>
		<?php if ($status >= 1) {
			if (!empty($technicians)) {
				?>
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<div class="card-title" style="border-bottom: 1px solid black;">
									<h3>Technicians Assigned</h3>
								</div>
								<div class="table-responsive">
									<table class="table table-bordered m-t-30 table-hover contact-list">
										<thead>
										<tr>
											<th>Technician ID</th>
											<th>Name</th>
											<th>Phone Number</th>
											<th>Email</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
										<?php foreach ($technicians as $v) { ?>
											<tr>
												<td><?php echo $v->technician_id; ?></td>
												<td><?php echo $v->name; ?></td>
												<td><?php echo $v->phone_number; ?></td>
												<td><?php echo $v->email; ?></td>
												<td>
													<form action="<?php echo site_url('Admin/removeFromJob'); ?>" method="POST">
														<input type="hidden" name="complaint_id" value="<?php echo $complaint_id; ?>">
														<input type="hidden" name="technician_id" value="<?php echo $v->technician_id; ?>">
														<button class="btn btn-sm btn-danger"><i style="margin-right: 10px;" class="fa fa-trash"></i>Remove</button></a>
													</form>
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php }
		} ?>
		<div class="row" id="productDetails" style="display: none;">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="card-title" style="border-bottom: 1px solid black;">
							<h3>Request For Product</h3>
						</div>
						<div align="right" style="margin-bottom:5px;">
							<button type="button" name="add" id="add" class="btn btn-success btn-xs">Add
							</button>
						</div>
						<form action="<?php echo site_url('Admin/addAsset'); ?>" id="product_form">
							<input type="hidden" name="complaint_id" value="<?php echo $complaint_id; ?>">
							<input type="hidden" name="redirect" value="<?php echo site_url('Admin/sendMail'); ?>">
							<div class="table-responsive">
								<table class="table table-striped table-bordered" id="product_data">
									<tr>
										<th>Product Name</th>
										<th>Product Details</th>
										<th>Qty</th>
										<th>Edit</th>
										<th>Remove</th>
									</tr>
								</table>
							</div>
							<div align="center">
								<button type="submit" name="insert" id="insert" class="btn btn-primary" value="Submit">
									Submit
								</button>
							</div>
						</form>
						<div id="product_dialogue" title="Add Data">
							<div class="form-group">
								<label>Product Name</label>
								<input type="text" name="product_name" id="product_name" class="form-control" />
								<span id="error_product_name" class="text-danger"></span>
							</div>
							<div class="form-group">
								<label>Product Details</label>
								<textarea name="product_details" id="product_details" class="form-control"></textarea>
								<span id="error_product_details" class="text-danger"></span>
							</div>
							<div class="form-group">
								<label>Product Qty</label>
								<input type="number" name="product_qty" id="product_qty" class="form-control" />
								<span id="error_product_qty" class="text-danger"></span>
							</div>
							<div class="form-group" align="center">
								<input type="hidden" name="row_id" id="hidden_row_id" />
								<button type="button" name="save" id="save" class="btn btn-info">Save</button>
							</div>
						</div>
					</div>
					<div id="action_alert" title="Action"></div>
				</div>
			</div>
		</div>
		<?php if ($asset_details !== 0) { ?>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="card-title " style="border-bottom: 1px solid black;">
								<h3>Product Required Details</h3>
							</div>
							<div class="card-text ">
								<div class="table-responsive">
									<table class="table table-bordered m-t-30 table-hover contact-list">
										<thead>
										<tr>
											<th>Asset ID</th>
											<th>Name</th>
											<th>Details</th>
											<th>Quantity</th>
											<th>Amount</th>
											<th>Status</th>
											<th>View Details</th>
										</tr>
										</thead>
										<tbody>
										<?php foreach ($asset_details as $v) { ?>
											<tr>
												<td><?php echo $v->asset_id; ?></td>
												<td><?php echo $v->aname; ?></td>
												<td><?php echo $v->details; ?></td>
												<td><?php echo $v->quantity; ?></td>
												<td><?php echo $v->total_amount; ?></td>
												<td><?php
													if ($v->status == 0) {
														echo "Pending";
													} else if ($v->status == 1) {
														echo "Issued";
													} else {
														echo "Not Available";
													} ?>
												</td>
												<td>
													<form method="post" action="<?php echo site_url('Admin/track_request/' . $v->asset_id); ?>" style="display: inline;">
														<input type="hidden" name="asset_id" value="<?php echo $v->asset_id; ?>">
														<input type="hidden" name="complaint_id" value="<?php echo $complaint_id; ?>">
														<button value="submit" class="btn btn-info btn-sm" type="submit">Track Request
														</button>
													</form>
													<?php if ($v->status > 1) {
														if ($v->reqToTreasurer == 0) { ?>
															<form method="post" action="<?php echo site_url('Admin/req_to_treasurer'); ?>" style="display: inline;">
																<input type="hidden" name="asset_id" value="<?php echo $v->asset_id; ?>">
																<input type="hidden" name="complaint_id" value="<?php echo $complaint_id; ?>">
																<button value="submit" type="submit" class="btn btn-sm btn-info">Request to
																	Treasurer
																</button>
															</form>
														<?php }
													} ?>
												</td>
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
		<?php } ?>
		<?php if ($complaint_feedback == 0) { ?>
			<div class="card">
				<div class="card-body">
					<div class="card-title" style="border-bottom: 1px solid black;">
						<h3>Remarks</h3>
					</div>
					<form method="POST" action="<?php echo site_url('Admin/complaint_feedback/' . $complaint_id); ?>" class="mt-4">
						<div class="form-group">
							<textarea type="text" name="feedback" rows="5" class="form-control" placeholder="Your Remarks Here.." required></textarea>
							<small class="form-text text-muted">Your Feedback is important. It will help us to
								improve our services.</small>
						</div>
						<button type="submit" class="btn btn-info">Submit</button>
					</form>
				</div>
			</div>
		<?php } else { ?>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="card-title" style="border-bottom: 1px solid black;">
								<h3>Remarks</h3>
							</div>
							<p class="card-text" id="rem" style="text-align: justify; padding: 0px 10px 0px; font-size:1rem; margin-bottom: 16px;">
								<?php echo $complaint_feedback['feedback']; ?>
							</p>
							<div class="mb-5" id="update_rem" style="display: none;">
								<form method="POST" action="<?php echo site_url('Admin/update_complaint_feedback/' . $complaint_id); ?>" class="mt-4">
									<div class="form-group">
										<label for="">Update Remarks</label>
										<textarea type="text" name="feedback" rows="5" class="form-control" placeholder="Your Remarks Here.." required><?php echo $complaint_feedback['feedback']; ?></textarea>
										<small class="form-text text-muted">Your Feedback is important. It will help us to
											improve our services.</small>
									</div>
									<button type="submit" class="btn btn-sm btn-success">Update</button>
								</form>
							</div>
							<a class="card-link" id="edit_remarks" onclick="editRemarks()">
								<button class="btn btn-info">Edit Remarks</button>
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

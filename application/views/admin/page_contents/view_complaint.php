<?php extract($complaint_details); ?>
<?php if ($dept_name != "IT") { ?>
	<div class="page-wrapper printArea">
		<div class="container-fluid">
			<div class="row page-titles">
				<div class="col-md-5 align-self-center">
					<h4 class="text-themecolor">Complaint# <?php echo $complaint_id; ?></h4>
				</div>
				<?php if ($asset_details !== 0) { ?>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<a style="font-size: 18px;" href="javascript:void(0)" onclick="printSections()">Print<i class="fas fa-print" style="color: black; margin-left:5px;"></i></a>
					</div>
				</div>
				<?php }else{ ?>
					<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<a style="font-size: 18px;" href="javascript:void(0)" onclick="printSection()">Print<i class="fas fa-print" style="color: black; margin-left:5px;"></i></a>
					</div>
				</div>
				<?php } ?>
			</div>

			<?php ?>
			

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

			<div class="card ">
				<div class="card-body">
					<div class="card-title" style="border-bottom: 1px solid black;">
						<h3>Complainant Information</h3>
					</div>
					<div class="justify-content-center table-responsive">
						<table class="infoTable" style="width:80%; margin-left: auto; margin-right: auto;">
							<tr>
								<th class="infoHead">Id:</th>
								<td class="infoDetail"><?php echo $user_id; ?></td>
								<th class="infoHead">Name:</th>
								<td class="infoDetail"><?php echo $name; ?></td>
							</tr>
							<tr>
								<th class="infoHead">Contact #:</th>
								<td class="infoDetail"><?php echo $phone_number; ?></td>
								<th class="infoHead">Email:</th>
								<td class="infoDetail"><?php echo $email; ?></td>
							</tr>
							<tr>
								<th class="infoHead">Ext :</th>
								<td class="infoDetail"><?php echo $ext; ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="card-title " style="border-bottom: 1px solid black;">
								<h3><?php echo $subject; ?> <?php if ($status == 3) {
										echo "<p class='p-2 label label-lg label-success'>Closed</p>";
									} else if ($status == 2) {
										echo "<p class='p-2 label label-lg label-primary'>Product Requested</p>";
									} else if ($status == 1) {
										echo "<p class='p-2 label label-lg label-info'>In-Process</p>";
									} else {
										echo "<p class='p-2 label label-lg label-warning'>Pending</p>";
									} ?></h3>
							</div>
							<div class="card-subtitle ">
								Date: <?php echo date('d M Y | h:i A', strtotime($complaint_date)); ?>
							</div>
							<?php $dateString = date('Y-m-d', strtotime($expected_completion_time));
						
							if (!($expected_completion_time === $complaint_date)) { ?>
								<div style="color: <?php echo $expected_completion_time < $completion_time ? "red":"limegreen"; ?>" class="card-subtitle ">
									Due Time:
									<?php echo date('d M Y | h:i A', strtotime($expected_completion_time)); ?>
								</div>
							<?php } ?>
							<div id="depts" class="form-group" style="text-align: justify; padding: 0px 10px 0px; margin-bottom: 16px;">
								<label>Department: </label>
								<input type="text" disabled value="<?php echo $dept_name; ?>">
								<?php if ($status != 3) { ?>
									<a class="card-link" id="changeDeptt" onclick="showDetails('changeDeptt', 'changeDept')">
										<button class="btn btn-sm btn-info">Change Department
										</button>
									</a>
								<?php } ?>
							</div>
							<p class="card-text " style="text-align: justify; padding: 0px 10px 0px; font-size:1rem; margin-bottom: 16px;">
								<?php echo $description; ?>
							</p>
							<?php if ($status != 3 && $dept_name != "IT") { ?>
								<?php if ($technician_id == 1) { ?>
									<a class="card-link" id="buttonToggler" onclick="showDetails('buttonToggler', 'techniciansDetail')">
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
		
								if ($expected_completion_time === $complaint_date) { ?>
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
			<div class="row" id="changeDept" style="display: none;">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<form action="<?php echo site_url('Admin/updateDepartment'); ?>" method="POST">
								<input type="hidden" name="complaint_id" value="<?php echo $complaint_id; ?>">
								<div class="col-6" style="display: inline-block;">
									<label class="control-label">Department</label>
									<select name="dept_name" class="form-control custom-select" required>
										<option value=""></option>
										<option value='1'>Electricity</option>
										<option value='2'>Furniture</option>
										<option value='3'>HVAC</option>
										<option value='4'>Plumbing</option>
										<option value='5'>Mechanical</option>
										<option value='6'>Civil</option>
										<option value='7'>Surveillance</option>
									</select>
								</div>
								<button type="submit" class="btn btn-xs btn-success">Update</button>
							</form>
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
			<?php $display = $technician_id == 1 ? "none" : "block";
			?>
			<div class="row" id="techniciansDetail" style="display: <?php echo $display; ?>;">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="row flex-container" style="border-bottom: 1px solid black;">
								<div class="card-title col-md-8 ">
									<h3>Technician's Details</h3>
								</div>
								<?php if ($technician_id == 1 && $dept_name != "IT") { ?>
									<div class="col-md-4 text-right" style="align-self: center; margin-bottom: 20px;">
										<form class="app-search  d-md-block d-lg-block">
											<input type="text" id="myInput" class="form-control" onkeyup="searchForName()" placeholder="Search for technician" style="border: 2px solid #03A8F3;">
										</form>
									</div>
								<?php } else {
									if ($status != 3 && $dept_name != "IT") { ?>
										<div class="col-md-4 text-right" style="align-self: center; margin-bottom: 20px;">
											<button id="reAssignBtn" onclick="showDetails('reAssignBtn', 'reAssign')" class="btn btn-info d-md-block d-lg-block" style="margin-left: auto;">
												Assign Task to other Technician
											</button>
										</div>
									<?php }
								} ?>
							</div>
							<div class="card-text">
								<?php if ($technician_id == 1 && $dept_name != "IT") { ?>
									<div class="table-responsive">
										<table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list">
											<thead>
											<tr>
												<th>ID</th>
												<th>Name</th>
												<th>Email</th>
												<th>Phone</th>
												<th>Department</th>
												<th>Action</th>
											</tr>
											</thead>
											<tbody>
											<?php foreach ($technicians as $tech) { ?>
												<tr>
													<td><?php echo $tech->technician_id; ?></td>
													<td><?php echo $tech->name; ?></td>
													<td><?php echo $tech->email; ?></td>
													<td><?php echo $tech->phone_number; ?></td>
													<td><?php echo $tech->n; ?></td>
													<td>
														<form action="<?php echo site_url('Admin/assignTechnician'); ?>" method="POST">
															<input type="hidden" name="complaint_id" value="<?php echo $complaint_id; ?>">
															<input type="hidden" name="technician_id" value="<?php echo $tech->technician_id; ?>">
															<button class="btn btn-info d-none d-lg-block m-l-15" type="submit"><i class="fas fa-check-square" style="margin-right: 5px;"></i>
																Assign
																Task
															</button>
														</form>
													</td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
									</div>
								<?php } else { ?>
									<div class="card-body">
										<div class="form-body ">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group row">
														<label class="control-label text-right col-md-3">Name:</label>
														<div class="col-md-9">
															<p class="form-control-static"><?php echo $tname; ?></p>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group row">
														<label class="control-label text-right col-md-3">Department:</label>
														<div class="col-md-9">
															<p class="form-control-static"><?php echo $dept_name; ?></p>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group row">
														<label class="control-label text-right col-md-3">Phone#:</label>
														<div class="col-md-9">
															<p class="form-control-static"><?php echo $tphone_number; ?></p>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group row">
														<label class="control-label text-right col-md-3">Email
															Address:</label>
														<div class="col-md-9">
															<p class="form-control-static"><?php echo $tmail; ?></p>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-12">
													<div class="text-right">
														<form onsubmit="return validateDates()" action="<?php echo site_url('Admin/view_technician_performance/'.$technician_id) ?>" role="form" method="get">
														<input type="text" name="end_date" value="<?php echo date("Y-m-d",strtotime('+1 day')); ?>" hidden>
														<input type="text" name="start_date" value="<?php echo date("Y-m-d",strtotime('-1 month')) ?>" hidden>
															<button class="btn btn-info" type="submit" name="submit">View Technician</button>
														</form>
													</div>
												</div>
											</div>
										</div>
										<div class="table-responsive" style="display: none;" id="reAssign">
											<table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list">
												<thead>
												<tr>
													<th>ID</th>
													<th>Name</th>
													<th>Email</th>
													<th>Phone</th>
													<th>Department</th>
													<th>Action</th>
												</tr>
												</thead>
												<tbody>
												<?php foreach ($technicians as $tech) { ?>
													<tr>
														<td><?php echo $tech->technician_id; ?></td>
														<td><?php echo $tech->name; ?></td>
														<td><?php echo $tech->email; ?></td>
														<td><?php echo $tech->phone_number; ?></td>
														<td><?php echo $tech->technician_id; ?></td>
														<td>
															<form action="<?php echo site_url('Admin/reAssignTechnician'); ?>" method="POST">
																<input type="hidden" name="complaint_id" value="<?php echo $complaint_id; ?>">
																<input type="hidden" name="technician_id" value="<?php echo $tech->technician_id; ?>">
																<button class="btn btn-info d-none d-lg-block m-l-15" type="submit"><i class="fas fa-check-square" style="margin-right: 5px;"></i>
																	Assign Task
																</button>
															</form>
														</td>
													</tr>
												<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
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
												<th>S no#</th>
												<th>Name</th>
												<th>Details</th>
												<th>Quantity</th>
												<th>Amount</th>
												<th>Inventory Status</th>
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
				<div id='asset_det' style="display:none">
				<?php if ($asset_details !== 0) { ?>
				<?php
					foreach ($asset_details as $a) {

						$data['asset_id'] = $a->asset_id;
						$data['asset_timeline'] = $this->AdminModel->assetTimeline($a->asset_id);
						$data['treasurer_timeline'] = $this->AdminModel->treasurerTimeline($a->asset_id);
						$data['purchaser_timeline'] = $this->AdminModel->purchaserTimeline($a->asset_id);
		
						
						$this->load->view('admin/page_contents/track_material_request', $data);
					}
				?>
				<?php } ?>
				</div>

			<?php } ?>
			<?php if (!empty($complaint_feedback)) { ?>
				<div class="row">
					<div class="col-12">
						<div class="card ">
							<div class="card-body">
								<div class="card-title" style="border-bottom: 1px solid black;">
									<h3>Complaint Feedback</h3>
								</div>
								<p class="card-text" style="text-align: justify; padding: 0px 10px 0px; font-size:1rem; margin-bottom: 16px;">
									<?php echo $complaint_feedback['feedback']; ?>
								</p>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } else { ?>

	<div class="page-wrapper printArea">
		<div class="container-fluid">
			<div class="row page-titles">
				<div class="col-md-5 align-self-center">
					<?php extract($complaint_details);
					if ($complaint_feedback != 0) {
						extract($complaint_feedback);
					}
					?>
					<h4 class="text-themecolor">Complaint# <?php echo $complaint_id; ?></h4>
				</div>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<a style="font-size: 18px;" href="javascript:void(0)" onclick="printSection()">Print<i class="fas fa-print" style="color: black; margin-left:5px;"></i></a>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<div class="card-title" style="border-bottom: 1px solid black;">
						<h3>Subject: <?php echo $subject; ?></h3>
					</div>
					<div class="card-subtitle">
						Department: <?php echo $dept_name; ?>
					</div>
					<p class="card-text" style="text-align: justify; padding: 0px 10px 0px; font-size:1rem; margin-bottom: 16px;">
						<?php echo $description; ?>
					</p>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<div class="card-title" style="border-bottom: 1px solid black;">
						<h3>Complaint Status</h3>
					</div>
					<div id="content" style="margin: 20px 0px;">
						<ul class="timeline">
							<?php foreach ($complaint_timeline as $d) { ?>
								<li class="event" data-date="<?php echo date('d M Y | h:i A', strtotime($d->date)); ?>">
									<?php if ($d->status == 0) {
										$stats = "Received";
									} else if ($d->status == 1) {
										$stats = "In-Process";
									} else if ($d->status == 2) {
										$stats = "Product Requested";
									} else {
										$stats = "Closed";
									} ?>
									<h3><?php echo $stats; ?></h3>
									<?php if ($d->status == 1) { ?>
										<p><?php echo $d->remarks; ?> <span style="margin-left: 5px; color:royalblue; text-decoration: underline;"><a id="buttonToggler" onclick="showDetails('buttonToggler', 'techniciansDetail')">View Technician's Details</a></span>
										</p>
									<?php } else { ?>
										<p><?php echo $d->remarks; ?></p>
									<?php } ?>
								</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
			
			<div class="row" id="techniciansDetail" style="display: none">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="row flex-container" style="border-bottom: 1px solid black;">
								<div class="card-title col-md-8">
									<h3>Technician's Details</h3>
								</div>
							</div>
							<div class="card-body">
								<form class="form-horizontal" role="form">
									<div class="form-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group row">
													<label class="control-label text-right col-md-3">Name:</label>
													<div class="col-md-9">
														<p class="form-control-static"><?php echo $tname; ?></p>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group row">
													<label class="control-label text-right col-md-3">Department:</label>
													<div class="col-md-9">
														<p class="form-control-static"><?php echo $dept_name; ?></p>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group row">
													<label class="control-label text-right col-md-3">Phone#:</label>
													<div class="col-md-9">
														<p class="form-control-static"><?php echo $tphone_number; ?></p>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group row">
													<label class="control-label text-right col-md-3">Email
														Address:</label>
													<div class="col-md-9">
														<p class="form-control-static"><?php echo $tmail; ?></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<?php if ($status == 3) {
				if ($complaint_feedback == 0) { ?>
					<div class="card">
						<div class="card-body">
							<div class="card-title" style="border-bottom: 1px solid black;">
								<h3>Feedback</h3>
							</div>
							<form method="POST" action="<?php echo site_url('Admin/complaint_feedback/' . $complaint_id); ?>" class="mt-4">
								<div class="form-group">
									<textarea type="text" name="feedback" rows="5" class="form-control" placeholder="Your Feedback Here.." required></textarea>
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
										<h3>Complaint Feedback</h3>
									</div>
									<p class="card-text" style="text-align: justify; padding: 0px 10px 0px; font-size:1rem; margin-bottom: 16px;">
										<?php echo $complaint_feedback['feedback']; ?>
									</p>
								</div>
							</div>
						</div>
					</div>
				<?php }
			} ?>
		</div>

		

	</div>
<?php } ?>
<script>
	function printSections() {
    toggleView2('asset_det');
    var divsToPrint = document.getElementsByClassName('printArea');
    var printContents = "";
    for (n = 0; n < divsToPrint.length; n++) {
        printContents += divsToPrint[n].innerHTML + "<br>";
    }
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    toggleView3('asset_det');
}

function toggleView3(x) {
    x = document.getElementById(x);
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "none";
    }
}
</script>
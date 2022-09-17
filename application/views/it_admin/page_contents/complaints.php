<div class="row printArea" style="display: none;">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="row p-t-20">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">From</label>
							<input id="start_date" type="date" value="<?php echo $misc['start_date']; ?>" name="start_date" placeholder="Select Start Date" class="form-control" id="validationCustom02" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">To</label>
							<input id="end_date" type="date" value="<?php echo $misc['end_date']; ?>" name="end_date" placeholder="Select End Date" class="form-control" id="validationCustom02" required>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="page-wrapper printArea">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Complaints</h4>
			</div>
			<div class="col-md-7 align-self-center text-right">
				<div class="d-flex justify-content-end align-items-center">
				<a style="font-size: 18px; margin-right:10px;" href="javascript:void(0)" onclick="printSection()">Print<i class="fas fa-print" style="color: black; margin-left:5px;"></i></a>
					<a href="create_complaint">
						<button type="button" class="btn btn-info"><i class="fa fa-plus-circle" style="margin-right: 5px;"></i> Create New
							Complaint
						</button>
					</a>
				</div>
			</div>
		</div>
		<div class="col-12 m-2" align="right">
			<button onclick="toggleView()" class="btn btn-md btn-info"><i class="fas fa-filter"></i> Filter</button>
		</div>
		<div class="card" id="complaintFilter" style="display: none;">
			<div class="card-body">
				<form onsubmit="return validateDates()" action="<?php echo site_url('ITAdmin/complaints'); ?>" method="post">
					<div class="form-body">
						<h3 class="card-title">Filter</h3>
						<hr>
						<div class="row p-t-20">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Start Date</label>
									<input id="start_date" type="date" value="<?php echo $misc['start_date']; ?>" name="start_date" placeholder="Select Start Date" class="form-control" id="validationCustom02" required>
									<small class="form-text text-muted" id="msg" style="color: red;">Start date must be less than End date.</small>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">End Date</label>
									<input id="end_date" type="date" value="<?php echo $misc['end_date']; ?>" name="end_date" placeholder="Select End Date" class="form-control" id="validationCustom02" required>
								</div>
							</div>
						</div>
					</div>
					<div align="right" class="form-actions">
						<button type="submit" class="btn btn-info">View</button>
					</div>
				</form>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<div class="vtabs customvtab">
					<ul class="nav nav-tabs tabs-vertical" role="tablist">
						<li class="nav-item"><a class="nav-link active " data-toggle="tab" href="#allComplaints" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">All Complaints</span> </a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pending" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Pending</span></a>
						</li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#processing" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">In-Process</span></a>
						</li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#productWaiting" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Product Requested</span></a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#resolve" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Resolved</span></a>
						</li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#reject" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Rejected</span></a>
						</li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#byMe" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Complaints By Me</span></a></li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active" id="allComplaints" role="tabpanel">
							<div class="p-20">
								<div class="table-responsive">
									<table id="allComplaintsTable" class="table table-bordered table-striped">
										<thead>
										<tr>
											<th>Complaint ID#</th>
											<th>Complainant</th>
											<th>Complaint Date</th>
											<th>Department</th>
											<th>Subject</th>
											<th>Current Status</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
										<?php foreach ($allComplaints as $roww) { ?>
											<tr>
												<td>
													<b><a href="<?php echo site_url('ITAdmin/view_complaint/' . $roww->complaint_id); ?>"><?php echo $roww->complaint_id; ?></a></b>
												</td>
												<td><?php echo $roww->name; ?></td>
												<td><?php echo date('d M Y', strtotime($roww->complaint_date)); ?></td>
												<td><?php echo $roww->dept_name; ?></td>
												<td><?php echo $roww->subject; ?></td>
												<?php if ($roww->status == 0) {
													$stats = "Pending";
													$color = "warning";
												} else if ($roww->status == 1) {
													$stats = "In-Process";
													$color = "info";
												} else if ($roww->status == 2) {
													$stats = "Product Requested";
													$color = "primary";
												} else {
													$stats = "Closed";
													$color = "success";
												} ?>
												<td>
													<span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span>
												</td>
												<td>
													<a href="<?php echo site_url('ITAdmin/view_complaint/' . $roww->complaint_id); ?>"><span class="label label-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Complaint</span></a>
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="tab-pane p-20" id="byMe" role="tabpanel">
							<div class="table-responsive">
								<table id="complaintsByMe" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>Complaint ID#</th>
										<th>Complainant</th>
										<th>Complaint Date</th>
										<th>Department</th>
										<th>Subject</th>
										<th>Current Status</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($complaintsByMe as $pending) { ?>
										<tr>
											<td>
												<b><a href="<?php echo site_url('ITAdmin/view_complaint/' . $pending->complaint_id); ?>"><?php echo $pending->complaint_id; ?></a></b>
											</td>
											<td><?php echo $pending->name; ?></td>
											<td><?php echo date('d M Y', strtotime($pending->complaint_date)); ?></td>
											<td><?php echo $pending->dept_name; ?></td>
											<td><?php echo $pending->subject; ?></td>
											<?php if ($pending->status == 0) {
												$stats = "Pending";
												$color = "warning";
											} else if ($pending->status == 1) {
												$stats = "In-Process";
												$color = "info";
											} else if ($pending->status == 2) {
												$stats = "Product Requested";
												$color = "primary";
											} else {
												$stats = "Closed";
												$color = "success";
											} ?>
											<td>
												<span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span>
											</td>
											<td>
												<a href="<?php echo site_url('ITAdmin/view_complaint/' . $pending->complaint_id); ?>"><span class="label label-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Complaint</span></a>
											</td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane p-20" id="pending" role="tabpanel">
							<div class="table-responsive">
								<table id="pendingComplaints" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>Complaint ID#</th>
										<th>Complainant</th>
										<th>Complaint Date</th>
										<th>Department</th>
										<th>Subject</th>
										<th>Current Status</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($pendingComplaints as $pending) { ?>
										<tr>
											<td>
												<b><a href="<?php echo site_url('ITAdmin/view_complaint/' . $pending->complaint_id); ?>"><?php echo $pending->complaint_id; ?></a></b>
											</td>
											<td><?php echo $pending->name; ?></td>
											<td><?php echo date('d M Y', strtotime($pending->complaint_date)); ?></td>
											<td><?php echo $pending->dept_name; ?></td>
											<td><?php echo $pending->subject; ?></td>
											<?php if ($pending->status == 0) {
												$stats = "Pending";
												$color = "warning";
											} else if ($pending->status == 1) {
												$stats = "In-Process";
												$color = "info";
											} else if ($pending->status == 2) {
												$stats = "Product Requested";
												$color = "primary";
											} else {
												$stats = "Closed";
												$color = "success";
											} ?>
											<td>
												<span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span>
											</td>
											<td>
												<a href="<?php echo site_url('ITAdmin/view_complaint/' . $pending->complaint_id); ?>"><span class="label label-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Complaint</span></a>
											</td>
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
										<th>Complaint ID#</th>
										<th>Complainant</th>
										<th>Complaint Date</th>
										<th>Department</th>
										<th>Subject</th>
										<th>Current Status</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($InProcessComplaints as $pending) { ?>
										<tr>
											<td>
												<b><a href="<?php echo site_url('ITAdmin/view_complaint/' . $pending->complaint_id); ?>"><?php echo $pending->complaint_id; ?></a></b>
											</td>
											<td><?php echo $pending->name; ?></td>
											<td><?php echo date('d M Y', strtotime($pending->complaint_date)); ?></td>
											<td><?php echo $pending->dept_name; ?></td>
											<td><?php echo $pending->subject; ?></td>
											<?php if ($pending->status == 0) {
												$stats = "Pending";
												$color = "warning";
											} else if ($pending->status == 1) {
												$stats = "In-Process";
												$color = "info";
											} else if ($pending->status == 2) {
												$stats = "Product Requested";
												$color = "primary";
											} else {
												$stats = "Closed";
												$color = "success";
											} ?>
											<td>
												<span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span>
											</td>
											<td>
												<a href="<?php echo site_url('ITAdmin/view_complaint/' . $pending->complaint_id); ?>"><span class="label label-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Complaint</span></a>
											</td>
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
										<th>Complaint ID#</th>
										<th>Complainant</th>
										<th>Complaint Date</th>
										<th>Department</th>
										<th>Subject</th>
										<th>Current Status</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($ReqAssetComplaints as $waitingProduct) { ?>
										<tr>
											<td>
												<b><a href="<?php echo site_url('ITAdmin/view_complaint/' . $waitingProduct->complaint_id); ?>"><?php echo $waitingProduct->complaint_id; ?></a></b>
											</td>
											<td><?php echo $waitingProduct->name; ?></td>
											<td><?php echo date('d M Y', strtotime($waitingProduct->complaint_date)); ?></td>
											<td><?php echo $waitingProduct->dept_name; ?></td>
											<td><?php echo $waitingProduct->subject; ?></td>
											<?php if ($waitingProduct->status == 0) {
												$stats = "Pending";
												$color = "warning";
											} else if ($waitingProduct->status == 1) {
												$stats = "In-Process";
												$color = "info";
											} else if ($waitingProduct->status == 2) {
												$stats = "Product Requested";
												$color = "primary";
											} else {
												$stats = "Closed";
												$color = "success";
											} ?>
											<td>
												<span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span>
											</td>
											<td>
												<a href="<?php echo site_url('ITAdmin/view_complaint/' . $waitingProduct->complaint_id); ?>"><span class="label label-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Complaint</span></a>
											</td>
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
										<th>Complaint ID#</th>
										<th>Complainant</th>
										<th>Complaint Date</th>
										<th>Department</th>
										<th>Subject</th>
										<th>Current Status</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($Resolved as $row) { ?>
										<tr>
											<td>
												<b><a href="<?php echo site_url('ITAdmin/view_complaint/' . $row->complaint_id); ?>"><?php echo $row->complaint_id; ?></a></b>
											</td>
											<td><?php echo $row->name; ?></td>
											<td><?php echo date('d M Y', strtotime($row->complaint_date)); ?></td>
											<td><?php echo $row->dept_name; ?></td>
											<td><?php echo $row->subject; ?></td>
											<?php if ($row->status == 0) {
												$stats = "Pending";
												$color = "warning";
											} else if ($row->status == 1) {
												$stats = "In-Process";
												$color = "info";
											} else if ($row->status == 2) {
												$stats = "Product Requested";
												$color = "primary";
											} else {
												$stats = "Resolved";
												$color = "success";
											} ?>
											<td>
												<span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span>
											</td>
											<td>
												<a href="<?php echo site_url('ITAdmin/view_complaint/' . $row->complaint_id); ?>"><span class="label label-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Complaint</span></a>
											</td>
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
										<th>Complaint ID#</th>
										<th>Complainant</th>
										<th>Complaint Date</th>
										<th>Department</th>
										<th>Subject</th>
										<th>Current Status</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($Rejected as $row2) { ?>
										<tr>
											<td>
												<b><a href="<?php echo site_url('ITAdmin/view_complaint/' . $row2->complaint_id); ?>"><?php echo $row2->complaint_id; ?></a></b>
											</td>
											<td><?php echo $row2->name; ?></td>
											<td><?php echo date('d M Y', strtotime($row2->complaint_date)); ?></td>
											<td><?php echo $row2->dept_name; ?></td>
											<td><?php echo $row2->subject; ?></td>
											<?php if ($row2->status == 0) {
												$stats = "Pending";
												$color = "warning";
											} else if ($row2->status == 1) {
												$stats = "In-Process";
												$color = "info";
											} else if ($row2->status == 2) {
												$stats = "Product Requested";
												$color = "primary";
											} else {
												$stats = "Rejected";
												$color = "danger";
											} ?>
											<td>
												<span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span>
											</td>
											<td>
												<a href="<?php echo site_url('ITAdmin/view_complaint/' . $row2->complaint_id); ?>"><span class="label label-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Complaint</span></a>
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
	</div>
</div>

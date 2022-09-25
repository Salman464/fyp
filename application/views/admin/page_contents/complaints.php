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
		<?php ?>
		<div class="row col-12">
			<div class="col-md-6 col-sm-12">
				<!-- <input type="checkbox" data-toggle="toggle"> -->
				<button onclick="toggleReport()" class="btn btn-md btn-info"><i class="fas fa-report"></i> Genrate Report</button>
			</div>
			<div class="col-md-6 col-sm-12">
				<h4 align="right">FROM :<b class="text-danger"><?php echo $misc['start_date']; ?> </b>TO :<b class="text-danger"><?php echo $misc['end_date']; ?></b>
					<button onclick="toggleView()" class="btn btn-md btn-info"><i class="fas fa-filter"></i> Filter</button>
				</h4>
			</div>
			
		
		</div>
		<div class="card" id="complaintFilter" style="display: none;">
			<div class="card-body">
				<form onsubmit="return validateDates()" action="<?php echo site_url('Admin/complaints'); ?>" method="get">
					<div class="form-body">
						<h3 class="card-title">Filter</h3>
						<hr>
						<div class="row p-t-20">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Start Date</label>
									<input id="start_date" type="date" value="<?php echo $misc['start_date']; ?>" name="start_date" placeholder="Select Start Date" class="form-control" id="validationCustom02" required>
									<small class="form-text text-muted" id="msg" style="color: red;">Start date must be
										less than End date.</small>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">End Date</label>
									<input id="end_date" type="date" value="<?php echo $misc['end_date']; ?>" name="end_date" placeholder="Select End Date" class="form-control" id="validationCustom02" required>
								</div>
							</div>
						</div>
						<div class="row p-t-20">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Department</label>
									<select name="dept_id" class="form-control custom-select">
										<option <?php if ($misc['dept_id'] == "") {
											echo "selected";
										} ?> value="">All
										</option>
										<option <?php if ($misc['dept_id'] == "1") {
											echo "selected";
										} ?> value='1'>Electricity
										</option>
										<option <?php if ($misc['dept_id'] == "2") {
											echo "selected";
										} ?> value='2'>Furniture
										</option>
										<option <?php if ($misc['dept_id'] == "3") {
											echo "selected";
										} ?> value='3'>HVAC
										</option>
										<option <?php if ($misc['dept_id'] == "4") {
											echo "selected";
										} ?> value='4'>Plumbing
										</option>
										<option <?php if ($misc['dept_id'] == "5") {
											echo "selected";
										} ?> value='5'>Mechanical
										</option>
										<option <?php if ($misc['dept_id'] == "6") {
											echo "selected";
										} ?> value='6'>Civil
										</option>
										<option <?php if ($misc['dept_id'] == "7") {
											echo "selected";
										} ?> value='7'>Surveillance
										</option>
										<option <?php if ($misc['dept_id'] == "8") {
											echo "selected";
										} ?> value='8'>IT
										</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions text-right">
						<button type="submit" class="btn btn-info">View</button>
					</div>
				</form>
			</div>
		</div>


		<div class="card" id="genrateReport" style="display: none;">
			<div class="card-body">
				<form onsubmit="return validateDates()" action="<?php echo site_url('Admin/generateReport'); ?>" method="get">
					<div class="form-body">
						<h4 class="card-title">Genrate detailed report</h4>
						<hr>
						<div class="row p-t-20">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">From</label>
									<input id="start_date" type="date" value="<?php echo $misc['start_date']; ?>" name="start_date" placeholder="Select Start Date" class="form-control" id="validationCustom02" required>
									<small class="form-text text-muted" id="msg" style="color: red;">Start date must be
										less than End date.</small>
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
					<div class="form-actions text-right">
						<button type="submit" class="btn btn-info">View</button>
					</div>
				</form>
			</div>
		</div>

		<?php if ($misc['dept_id'] == "") { ?>
			<div class="card-group">
				<div class="card">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div>
								<h3><i class="icon-doc"></i></h3>
								<p class="text-muted">Electric Department Complaints</p>
							</div>
							<div class="ml-auto">
								<h2 class="counter text-primary"><?php echo $electricityDeptComplaints; ?></h2>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div>
								<h3><i class="icon-doc"></i></h3>
								<p class="text-muted">Furniture Department Complaints</p>
							</div>
							<div class="ml-auto">
								<h2 class="counter text-primary"><?php echo $furnitureDeptComplaints; ?></h2>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div>
								<h3><i class="icon-doc"></i></h3>
								<p class="text-muted">HVAC Department Complaints</p>
							</div>
							<div class="ml-auto">
								<h2 class="counter text-primary"><?php echo $HVACDeptComplaints; ?></h2>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div>
								<h3><i class="icon-doc"></i></h3>
								<p class="text-muted">Plumbing Department Complaints</p>
							</div>
							<div class="ml-auto">
								<h2 class="counter text-primary"><?php echo $plumbingDeptComplaints; ?></h2>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-group">
				<div class="card">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div>
								<h3><i class="icon-doc"></i></h3>
								<p class="text-muted">Mechanical Department Complaints</p>
							</div>
							<div class="ml-auto">
								<h2 class="counter text-primary"><?php echo $MechanicalDeptComplaints; ?></h2>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div>
								<h3><i class="icon-doc"></i></h3>
								<p class="text-muted">Civil Department Complaints</p>
							</div>
							<div class="ml-auto">
								<h2 class="counter text-primary"><?php echo $civilDeptComplaints; ?></h2>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div>
								<h3><i class="icon-doc"></i></h3>
								<p class="text-muted">Surveillance Department Complaints</p>
							</div>
							<div class="ml-auto">
								<h2 class="counter text-primary"><?php echo $SurveillanceDeptComplaints; ?></h2>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div>
								<h3><i class="icon-doc"></i></h3>
								<p class="text-muted">IT Department Complaints</p>
							</div>
							<div class="ml-auto">
								<h2 class="counter text-primary"><?php echo $ITDeptComplaints; ?></h2>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Departmental complaints -->
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h4>Departmental complaints</h4>
						<hr>
						<div class="row p-t-20">
							<div class="col-md-1 col-sm-0">
							</div>
							<div class="col-md-10 col-sm-0 center">
								<?php if(1>0): ?>
									<canvas id="tspChart"></canvas>
								<?php else: ?>
									<h4>No Complaints available...!</h4>
								<?php endif; ?>
							</div>
							<div class="col-md-1 col-sm-0">
							</div>
						</div>
					</div>
				</div>
			</div>


		<?php }else{ ?>
			<!-- Line chart department-vise -->
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h4><?php if($misc['dept_id']==1):echo 'Electrical';
						elseif($misc['dept_id']==2):echo 'Furniture';
						elseif($misc['dept_id']==3):echo 'HVAC';
						elseif($misc['dept_id']==4):echo 'Plumbing';
						elseif($misc['dept_id']==5):echo 'Mechanical';
						elseif($misc['dept_id']==6):echo 'Civil';
						elseif($misc['dept_id']==7):echo 'Surveillance';
						elseif($misc['dept_id']==8):echo 'IT';
						elseif($misc['dept_id']==''):echo 'All';
						 ?>
						<?php endif; ?>
						Department</h4>
						<hr>
						<div class="row p-t-20">
							<div class="col-md-1 col-sm-0">
							</div>
							<div class="col-md-10 col-sm-0 center">
								<?php if(array_sum(array_values($departmentMonthlyComplaints))>0): ?>
									<canvas id="specificDeptChart"></canvas>
								<?php else: ?>
									<h4>No Complaints available...!</h4>
								<?php endif; ?>
							</div>
							<div class="col-md-1 col-sm-0">
							</div>
						</div>
					</div>
				</div>
			</div>

		<?php } ?>

		<div class="card">
			<div class="card-body">
				<!-- Nav tabs -->
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
										<?php foreach ($complaints as $row) { ?>
											<tr>
												<td>
													<b><a href="<?php echo site_url('Admin/view_complaint/' . $row->complaint_id); ?>"><?php echo $row->complaint_id; ?></a></b>
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
													$stats = "Closed";
													$color = "success";
												} ?>
												<td>
													<span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span>
												</td>
												<td>
													<a href="<?php echo site_url('Admin/view_complaint/' . $row->complaint_id); ?>"><span class="label label-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Complaint</span></a>
												</td>
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
												<b><a href="<?php echo site_url('Admin/view_complaint/' . $pending->complaint_id); ?>"><?php echo $pending->complaint_id; ?></a></b>
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
												<a href="<?php echo site_url('Admin/view_complaint/' . $pending->complaint_id); ?>"><span class="label label-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Complaint</span></a>
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
												<b><a href="<?php echo site_url('Admin/view_complaint/' . $pending->complaint_id); ?>"><?php echo $pending->complaint_id; ?></a></b>
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
												<a href="<?php echo site_url('Admin/view_complaint/' . $pending->complaint_id); ?>"><span class="label label-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Complaint</span></a>
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
												<b><a href="<?php echo site_url('Admin/view_complaint/' . $waitingProduct->complaint_id); ?>"><?php echo $waitingProduct->complaint_id; ?></a></b>
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
												<a href="<?php echo site_url('Admin/view_complaint/' . $waitingProduct->complaint_id); ?>"><span class="label label-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Complaint</span></a>
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
												<b><a href="<?php echo site_url('Admin/view_complaint/' . $row->complaint_id); ?>"><?php echo $row->complaint_id; ?></a></b>
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
												<a href="<?php echo site_url('Admin/view_complaint/' . $row->complaint_id); ?>"><span class="label label-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Complaint</span></a>
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
												<b><a href="<?php echo site_url('Admin/view_complaint/' . $row2->complaint_id); ?>"><?php echo $row2->complaint_id; ?></a></b>
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
												<a href="<?php echo site_url('Admin/view_complaint/' . $row2->complaint_id); ?>"><span class="label label-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Complaint</span></a>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	const labels = [
		'Electrical',
		'Furniture',
		'HVAC',
		'Plumbing',
		'Mechanical',
		'Civil',
		'Surveillance',
		'IT'
	];

	const data = {
		labels: labels,
		datasets: [{
		label: 'Complaints from departments',
		backgroundColor: ['rgb(255, 99, 132)'],
		borderColor: 'white',
		data:[<?php echo $electricityDeptComplaints; ?>,<?php echo $furnitureDeptComplaints; ?>,<?php echo $HVACDeptComplaints; ?>,<?php echo $plumbingDeptComplaints; ?>,<?php echo $MechanicalDeptComplaints; ?>,<?php echo $civilDeptComplaints; ?>,<?php echo $SurveillanceDeptComplaints; ?>,<?php echo $ITDeptComplaints; ?>],
		}]
	};

	const config = {
		type: 'bar',
		data: data,
	};	
	const myChart = new Chart(document.getElementById('tspChart'),config);
</script>

<script>
	const labels1 = <?php echo json_encode(array_keys($departmentMonthlyComplaints)); ?>;

	const data1 = {
		labels: labels1,
		datasets: [{
		label: 'Monthly Complaints',
		backgroundColor: ['rgb(255, 99, 132)'],
		borderColor:'rgb(255, 99, 132)',
		data: <?php echo json_encode(array_values($departmentMonthlyComplaints)); ?>,
		}]
	};

	const config1 = {
		type: 'line',
		data: data1,
	};	

	const specificDeptChart = new Chart(document.getElementById('specificDeptChart'),config1);
</script>
<script>
function toggleReport()
{
    var x = document.getElementById("genrateReport");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script>
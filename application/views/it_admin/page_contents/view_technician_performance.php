<div class="page-wrapper printArea">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Technician ID: <?php echo $technicianDetails['technician_id']; ?></h4>
				<?php 
					// foreach ($monthlyComplaint as $key => $value) {
					// 	echo $key,' => ',$value,'<hr>';
					// }
				 ?>
			</div>
			<div class="col-md-7 align-self-center text-right">
				<div class="d-flex justify-content-end align-items-center">
					<a style="font-size: 18px;" href="javascript:void(0)" onclick="printSection()">Print<i class="fas fa-print" style="color: black; margin-left:5px;"></i></a>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<form onsubmit="return validateDates()" action="<?php echo site_url('ITAdmin/view_technician_performance/' . $technicianDetails['technician_id']); ?>" method="get">
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
									<div class="valid-feedback">
										Looks good!
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="row p-t-20">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Status of Complaint</label>
									<select name="status" class="form-control custom-select">
										<option <?php if ($misc['status'] == ""){echo "selected";}?> value="">Any</option>
										<option <?php if ($misc['status'] == "1"){echo "selected";}?> value='1'>In-Process</option>
										<option <?php if ($misc['status'] == "3"){echo "selected";}?> value='3'>Closed</option>
									</select>
									<div class="valid-feedback">
										Looks good!
									</div>
								</div>
							</div>
						</div> -->
					</div>
					<div align="right" class="form-actions">
						<button type="submit" class="btn btn-info">View</button>
					</div>
				</form>
			</div>
		</div>

		<!-- Line chart -->
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4>Monthly Performance</h4>
					<hr>
					<div class="row p-t-20">
						<div class="col-md-1 col-sm-0">
						</div>
						<div class="col-md-10 col-sm-0 center">
							<?php if($allComplaints>0): ?>
								<canvas id="monthlyPerformance"></canvas>
							<?php else: ?>
								<h4>No performance available for given time period</h4>
							<?php endif; ?>
						</div>
						<div class="col-md-1 col-sm-0">
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<div class="form-body ">
					<h3 class="card-title">Technician's Details</h3>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-sm-4">Name:</label>
								<div class="col-sm-8">
									<p class="form-control-static"><?php echo $technicianDetails['name']; ?></p>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-sm-4">Department:</label>
								<div class="col-sm-8">
									<p class="form-control-static"><?php echo $technicianDetails['dept_name']; ?></p>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-sm-4">Phone#:</label>
								<div class="col-sm-8">
									<p class="form-control-static"><?php echo $technicianDetails['phone_number']; ?></p>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-sm-4">Email Address:</label>
								<div class="col-sm-8">
									<p class="form-control-static"><?php echo $technicianDetails['email']; ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row ">
			<div class="col-md-4">
				<a href="<?php echo site_url('ITAdmin/viewComplaintsType/'.'All'.'/'.$technicianDetails['technician_id'].'/'.$misc['start_date'].'/'.$misc['end_date']) ?>">
					<div class="card">
						<div class="card-body">
							<div class="d-flex no-block align-items-center">
								<div>
									<h3><i class="icon-doc"></i></h3>
									<p class="text-muted">All Complaints</p>
								</div>
								<div class="ml-auto">
									<h2 class="counter text-primary"><?php echo $allComplaintsCount; ?></h2>
								</div>
							</div>
						</div>
					</div>
				</a>	
			</div>
			<div class="col-md-4">
				<a href="<?php echo site_url('ITAdmin/viewComplaintsType/'.'Resolved'.'/'.$technicianDetails['technician_id'].'/'.$misc['start_date'].'/'.$misc['end_date']) ?>">
					<div class="card">
						<div class="card-body">
							<div class="d-flex no-block align-items-center">
								<div>
									<h3><i class="icon-doc"></i></h3>
									<p class="text-muted">Resolved Complaints</p>
								</div>
								<div class="ml-auto">
									<h2 class="counter text-primary"><?php echo $allResolvedComplaint; ?></h2>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-md-4">
				<a href="<?php echo site_url('ITAdmin/viewComplaintsType/'.'Rejected'.'/'.$technicianDetails['technician_id'].'/'.'/'.$misc['start_date'].'/'.$misc['end_date']) ?>">
					<div class="card">
						<div class="card-body">
							<div class="d-flex no-block align-items-center">
								<div>
									<h3><i class="icon-doc"></i></h3>
									<p class="text-muted">Rejected Complaints</p>
								</div>
								<div class="ml-auto">
									<h2 class="counter text-primary"><?php echo $allRejectedComplaint; ?></h2>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="row ">
			<div class="col-md-4">
				<a href="<?php echo site_url('ITAdmin/viewComplaintsType/'.'Pending'.'/'.$technicianDetails['technician_id'].'/'.$misc['start_date'].'/'.$misc['end_date']) ?>">
					<div class="card">
						<div class="card-body">
							<div class="d-flex no-block align-items-center">
								<div>
									<h3><i class="icon-doc"></i></h3>
									<p class="text-muted">Pending complaints</p>
								</div>
								<div class="ml-auto">
									<h2 class="counter text-primary"><?php echo $allPendings; ?></h2>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-md-4">
				<a href="<?php echo site_url('ITAdmin/viewComplaintsType/'.'Within-Due-Time'.'/'.$technicianDetails['technician_id'].'/'.$misc['start_date'].'/'.$misc['end_date']) ?>">
					<div class="card">
						<div class="card-body">
							<div class="d-flex no-block align-items-center">
								<div>
									<h3><i class="icon-doc"></i></h3>
									<p class="text-muted">Completed Within Due-Time</p>
								</div>
								<div class="ml-auto">
									<h2 class="counter text-primary"><?php echo $allCompletionsWithinTime; ?></h2>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			
			<div class="col-md-4">
				<a href="<?php echo site_url('ITAdmin/viewComplaintsType/'.'After-Due-Time'.'/'.$technicianDetails['technician_id'].'/'.$misc['start_date'].'/'.$misc['end_date']) ?>">
					<div class="card">
						<div class="card-body">
							<div class="d-flex no-block align-items-center">
								<div>
									<h3><i class="icon-doc"></i></h3>
									<p class="text-muted">Completed After Due-Time</p>
								</div>
								<div class="ml-auto">
									<h2 class="counter text-primary"><?php echo $allCompletionsAfterTime; ?></h2>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="table-responsive ">
					<table id="myTable" class="table table-bordered table-striped">
						<thead>
						<tr>
							<th>Complaint ID#</th>
							<th>Complainant</th>
							<th>Complaint Date</th>
							<th>Subject</th>
							<th>Current Status</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($complaints as $row) { ?>
							<tr>
								<td><b><a href="<?php echo site_url('ITAdmin/view_complaint/' . $row->complaint_id); ?>"><?php echo $row->complaint_id; ?></a></b></td>
								<td><?php echo $row->name; ?></td>
								<td><?php echo date('d M Y', strtotime($row->complaint_date)); ?></td>
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
								<td><span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span></td>
								<td><a href="<?php echo site_url('ITAdmin/view_complaint/' . $row->complaint_id); ?>"><span class="label label-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Complaint</span></a></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function validateDates() {

		var date1 = document.getElementById('start_date');
		var date2 = document.getElementById('end_date');
		if (date1.value > date2.value) {
			console.log(date1.value);
			console.log(date2.value);
			var err = document.getElementById('msg');
			err.classList.remove("text-muted");
			return false;
		}
		return true;
	}
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<script>
	const labels = [
		'Pending',
		'Resolved',
		'Rejected',
	];

	const data = {
		labels: labels,
		datasets: [{
		label: 'Complaints completion',
		backgroundColor: ['rgb(50, 99, 255,0.5)','rgb(00, 255, 100,0.5)','rgb(255, 50, 50,0.8)'],
		borderColor: 'white',
		data:[<?php echo $allPendings; ?>,<?php echo $allResolvedComplaint; ?>,<?php echo $allRejectedComplaint; ?>], //[0, 10, 5, 2, 20, 30, 45,39],
		}]
	};

	const config = {
		type: 'doughnut',
		data: data,
		options:{
			plugins:{
				tooltip:{
					enabled:false
				},
				datalabels:{
					formatter: (value,context) =>{
						const datapoints=context.chart.data.datasets[0].data;
						function totalSum(total,datapoint){
							return total+datapoint;
						}
						const total=datapoints.reduce(totalSum,0);
						const percent=((value/total)*100).toFixed(1);
						return ['Complaints:'+value,percent+'%'];
					}
				}
			}
		},
		plugins:[ChartDataLabels]
	};	
	const myChart = new Chart(document.getElementById('myChart'),config);
</script>
<script>
	//chart 2 line
	const labels2= <?php echo json_encode(array_keys($monthlyComplaint)); ?>;

	const data2 = {
		labels: labels2,
		datasets: [{
		label: 'Complaints handeled',
		backgroundColor: 'rgb(255, 99, 132)',
		borderColor: 'rgb(255, 99, 132)',
		data: <?php echo json_encode(array_values($monthlyComplaint)); ?>,
		}]
	};

	const config2 = {
		type: 'line',
		data: data2,
	};
	
	//const myChart = new Chart(document.getElementById('monthlyPerformance'),config = {type: 'line',data: data,options: {},});
</script>
<script>
	const monthlyPerformance = new Chart(
		document.getElementById('monthlyPerformance'),
		config2
	);
</script>
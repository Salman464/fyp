<div id="add-event" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<form action="<?php echo site_url('Admin/addEvent'); ?>" method="post" class="form-horizontal form-material">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Add Event's Details</h4>
					<button type="reset" value="reset" class="close" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times-circle" style="margin-right: 5px;"></i></button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<div class="col-md-12 m-b-20">
							<select name="dept_name" class="form-control custom-select" required>
								<option value="">--Select Department--</option>
								<option value='1'>Electricity</option>
								<option value='2'>Furniture</option>
								<option value='3'>HVAC</option>
								<option value='4'>Plumbing</option>
								<option value='5'>Mechanical</option>
								<option value='6'>Civil</option>
								<option value='7'>Surveillance</option>
								<option value='8'>IT</option>
							</select>
						</div>
						<div class="col-md-12 m-b-20">
							<select name="occ_id" class="form-control custom-select" required>
								<option value="">--Select Occurrence--</option>
								<option value='1'>Monthly</option>
								<option value='2'>Quarterly</option>
								<option value='3'>Half-yearly</option>
								<option value='4'>Annualy</option>
							</select>
						</div>
						<div class="col-md-12 m-b-20">
							<input type="text" maxlength="70" class="form-control" name="title" placeholder="Event Title" required>
						</div>
						<div class="col-md-12 m-b-20">
							<textarea name="description" class="form-control" cols="30" rows="10" placeholder="Event Description" required></textarea>
						</div>
						<div class="col-md-12 m-b-20">
							<div class="form-check form-check-inline">
								<input class="form-check-input" required type="radio" name="start_month" id="inlineRadio1" value="0">
								<label class="form-check-label" for="inlineRadio1">schedule from start of year</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="start_month" id="inlineRadio2" value="1">
								<label class="form-check-label" for="inlineRadio2">schedule from this month</label>
							</div>
							</select>
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
<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Events</h4>
			</div>
			<div class="col-md-7 align-self-center text-right">
				<div class="d-flex justify-content-end align-items-center">
					<button type="button" class="btn btn-info" data-toggle="modal" data-target="#add-event"><i class="fas fa-plus-circle" style="margin-right: 5px;"></i> Add New Event</button>
				</div>
			</div>
		</div>
		<div class="col-12 m-2" align="right">
			<button onclick="toggleView()" class="btn btn-md btn-info"><i class="fas fa-filter"></i> Filter</button>
		</div>
		<div class="card" id="complaintFilter" style="display: none;">
			<div class="card-body">
				<form action="<?php echo site_url('Admin/maintenance_schedules'); ?>" method="post">
					<div class="form-body">
						<h3 class="card-title">Filter</h3>
						<hr>
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
					<div align="right" class="form-actions">
						<button type="submit" class="btn btn-info">View</button>
					</div>
				</form>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<div class="card-title " style="border-bottom: 1px solid black;">
					<h3><?php

						$dep = "";

						if ($misc['dept_id'] == "1") {
							$dep = "Electricity";
						} else if ($misc['dept_id'] == "2") {
							$dep = "Furniture";
						} else if ($misc['dept_id'] == "3") {
							$dep = "HVAC";
						} else if ($misc['dept_id'] == "4") {
							$dep = "Plumbing";
						} else if ($misc['dept_id'] == "5") {
							$dep = "Mechanical";
						} else if ($misc['dept_id'] == "6") {
							$dep = "Civil";
						} else if ($misc['dept_id'] == "7") {
							$dep = "Surveillance";
						} else if ($misc['dept_id'] == "8") {
							$dep = "IT";
						} else {
							$dep = "";
						}
						?>All <?php echo $dep == "" ? "" : $dep; ?> Events</h3>
				</div>
				<div class="table-responsive">
					<table id="allComplaintsTable" class="table table-bordered table-striped">
						<thead>
						<tr>
							<th>Event ID#</th>
							<th>Department</th>
							<th>Title</th>
							<th>Description</th>
							<th>Occurrence</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($allEvents as $row) { ?>
							<tr>
								<td>
									<b><a href="<?php echo site_url('Admin/view_event/' . $row->id); ?>"><?php echo $row->id; ?></a></b>
								</td>
								<td><?php echo $row->dept_name; ?></td>
								<td><?php echo $row->title; ?></td>
								<td><?php echo $row->description; ?></td>
								<?php if ($row->occurrence_id == 1) {
									$stats = "Monthly";
								} else if ($row->occurrence_id == 2) {
									$stats = "Quarterly";
								} else if ($row->occurrence_id == 3) {
									$stats = "Half-Yearly";
								} else {
									$stats = "Yearly";
								} ?>
								<td>
									<?php echo $stats; ?>
								</td>
								<td>
									<a href="<?php echo site_url('Admin/view_event/' . $row->id); ?>"><button class="btn btn-xs btn-success" ><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Event</button></a>
									<form class="card-link" style="display: inline-block;" onsubmit="return startEventConfirmation()" action="<?php echo site_url('Admin/startEvent/' . $row->id); ?>">
										<button type="submit" id="<?php echo $row->title; ?>" class="btn btn-xs btn-danger">Quick start event</button>
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

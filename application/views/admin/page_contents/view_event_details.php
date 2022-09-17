<?php extract($event_details); ?>
<div class="page-wrapper printArea">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Event# <?php echo $id; ?></h4>
				<?php
				$date1 = strtotime($last_update);
				$date2 = date("Ymd", strtotime("+1 month", $date1));
				$date1 = date("Ymd", strtotime($last_update));
				?>
			</div>
			<div class="col-md-7 align-self-center text-right">
				<div class="d-flex justify-content-end align-items-center">
					<a style="font-size: 18px;" href="javascript:void(0)" onclick="printSection()">Print<i class="fas fa-print" style="color: black; margin-left:5px;"></i></a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="card-title " style="border-bottom: 1px solid black;">
							<h3><?php echo $title; ?></h3>
						</div>
						<div class="form-group " style="text-align: justify; padding: 0px 10px 0px; margin-bottom: 16px;">
							<label>Department: </label>
							<input type="text" disabled value="<?php echo $dept_name; ?>">
						</div>
						<p class="card-text " style="text-align: justify; padding: 0px 10px 0px; font-size:1rem; margin-bottom: 16px;">
							<?php echo $description; ?>
						</p>
						<form class="card-link" style="display: inline-block;" onsubmit="return startEventConfirmation()" action="<?php echo site_url('Admin/startEvent/' . $id); ?>">
							<button type="submit" id="<?php echo $title; ?>" class="btn btn-danger">Start Event</button>
						</form>
						<a class="card-link" href="javascript:void(0);">
							<button class="btn btn-success" id="btn_edit" onclick="toggleView2('updateInfo')">Edit Event</button>
						</a>
						<?php
						echo "<a class='card-link' target='_blank' href='https://calendar.google.com/calendar/r/eventedit?text={$title}&dates={$date1}T230000Z/{$date2}T030000Z&details={$description}'>
							<button class='btn btn-success' id='btn_gc'>Add to calendar</button>
						</a>";
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="card" id="updateInfo" style="display: none;">
			<div class="card-body">
				<div class="card-title" style="border-bottom: 1px solid black;">
					<h3>Update Event</h3>
				</div>
				<form action="<?php echo site_url('Admin/updateEvent'); ?>" method="post">
					<input type="hidden" name="event_id" value="<?php echo $id; ?>">
					<div class="row p-t-20">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Title</label>
								<input type="text" name="title" class="form-control" value="<?php echo $title; ?>" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Occurrence</label>
								<select name="occurrence" class="form-control custom-select">
									<option <?php if ($occurrence_id == 1) {
										echo "selected";
									} ?> value="1">Monthly
									</option>
									<option <?php if ($occurrence_id == 2) {
										echo "selected";
									} ?> value='2'>Quarterly
									</option>
									<option <?php if ($occurrence_id == 3) {
										echo "selected";
									} ?> value='3'>Half-yearly
									</option>
									<option <?php if ($occurrence_id == 4) {
										echo "selected";
									} ?> value='4'>Yearly
									</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Description</label>
								<textarea type="text" name="description" rows="10" class="form-control" value="" required><?php echo $description; ?></textarea>
							</div>
						</div>
					</div>
					<div class="form-actions text-right">
						<button type="submit" class="btn btn-success">Update</button>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="card-title " style="border-bottom: 1px solid black;">
							<h3>Event Performed</h3>
						</div>
						<div class="table-responsive">
							<table id="allComplaintsTable" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th>Complaint ID#</th>
									<th>Admin Name</th>
									<th>Complaint Date</th>
									<th>Remarks</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($event_performed as $row) { ?>
									<tr>
										<td><?php echo $row->complaint_id; ?></td>
										<td><?php echo $row->name; ?></td>
										<td><?php echo date('d M Y', strtotime($row->complaint_date)); ?></td>
										<td><?php echo $row->feedback; ?></td>
										<td>
											<a href="<?php echo site_url('Admin/view_event_complaint/' . $row->complaint_id); ?>"><span class="label label-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Details</span></a>
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

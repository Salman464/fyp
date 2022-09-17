<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Accidental Reports</h4>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="myTable" class="table table-bordered table-striped">
						<thead>
						<tr>
							<th>Accidental Report ID#</th>
							<th>Subject</th>
							<th>Department</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($accidental_reports as $row) { ?>
							<tr>
								<td><b><a href="<?php echo site_url('Treasurer/view_accidental_report/' . $row->id); ?>"><?php echo $row->id; ?></a></b></td>
								<td><?php echo $row->subject; ?></td>
								<td><?php echo $row->dept_name; ?></td>
								<td><?php echo date('d M Y | h:i A', strtotime($row->start_date)); ?></td>
								<td><?php echo date('d M Y | h:i A', strtotime($row->end_date)); ?></td>
								<?php if ($row->status == 0) {
									$stats = "Pending Approval";
									$color = "warning";
								} else if ($row->status == 1) {
									$stats = "Approved";
									$color = "success";
								}?>
								<td><span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span></td>
								<td><a href="<?php echo site_url('Treasurer/view_accidental_report/' . $row->id); ?>"><span class="label label-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Details</span></a></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

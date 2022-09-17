<div class="page-wrapper printArea">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Detail</h4>
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
					<h3>Complainant Information</h3>
				</div>
				<div class="justify-content-center table-responsive">
					<table class="infoTable" style="width:80%; margin-left: auto; margin-right: auto;">
						<?php foreach ($complainant as $row2) { ?>
							<tr>
								<th class="infoHead">Id: </th>
								<td class="infoDetail"><?php echo $row2->user_id; ?></td>
								<th class="infoHead">Name: </th>
								<td class="infoDetail"><?php echo $row2->name; ?></td>
							</tr>
							<tr>
								<th class="infoHead">Contact #: </th>
								<td class="infoDetail"><?php echo $row2->phone_number; ?></td>
								<th class="infoHead">Email: </th>
								<td class="infoDetail"><?php echo $row2->email; ?></td>
							</tr>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="card-title" style="border-bottom: 1px solid black;">
					<h3><?php echo $complaint['complaint_id'] . ": " . $complaint['subject']; ?></h3>
				</div>
				<div class="card-subtitle">
					Complaint Date: <?php echo date('d M Y | h:i A', strtotime($complaint['complaint_date'])); ?>
				</div>
				<p class="card-text" style="text-align: justify; padding: 0px 10px 0px; font-size:1rem; margin-bottom: 16px;">
					<?php echo $complaint['description']; ?>
				</p>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="card-title" style="border-bottom: 1px solid black;">
					<h3>Material Details</h3>
				</div>
				<table class="table table-hover table-bordered">
					<thead>
					<tr>
						<th>Request ID#</th>
						<th>Asset Name</th>
						<th>Detail</th>
						<th>Quantity</th>
						<th>Total Amount</th>
					</tr>
					</thead>
					<tbody>
					<?php if ($treasurer_requests->num_rows() > 0) {
						foreach ($treasurer_requests->result() as $row) { ?>
							<tr>
								<td><?php echo $row->req_id; ?></td>
								<td><?php echo $row->name; ?></td>
								<td><?php echo $row->details; ?></td>
								<td><?php echo $row->quantity; ?></td>
								<td><?php echo $row->total_amount; ?></td>
							</tr>
						<?php }
					} ?>
					<?php if ($row->status == 1) { ?>
						<tr>
							<td colspan="4" align="right"><b>Status</b></td>
							<td><span class="label label-success">Approved</span></td>
						</tr>
					<?php } else if ($row->status == 2) { ?>
						<tr>
							<td colspan="4" align="right"><b>Status</b></td>
							<td><span class="label label-danger">Rejected</span></td>
						</tr>
					<?php }  ?>
					</tbody>
				</table>
				<?php if ($row->status == 0) { ?>
					<div align="right" style="margin-right: 10px;">
						<form action="<?php echo site_url('Treasurer/approveReq'); ?>" method="GET">
							<input name="req" type="text" style="display: none;" value="<?php echo $row->req_id; ?>">
							<input type="hidden" name="asset" value="<?php echo $row->asset_id; ?>">
							<input type="hidden" name="complaint" value="<?php echo $row->complaint_id; ?>">
							<button type="submit" class="btn btn-success" name="approve"><i class="fas fa-check" style="margin-right: 10px;"></i>Approve</button>
						</form>
						<form id="form" method="POST">
							<input type="hidden" name="v" value="block">
							<button name="rej" type="submit" value="submit" class="btn btn-danger"><i class="fas fa-times" style="margin-right: 10px;"></i>Reject</button>
						</form>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php $d = "none"; ?>
		<?php
		if (isset($_POST["rej"])) {
			$d = $_POST['v'];
		} ?>
		<?php if ($row->status == 2) {
			if (!empty($technicalReport)) { ?>
				<div class="card">
					<div class="card-body">
						<div class="card-title" style="border-bottom: 1px solid black;">
							<h3>Reason</h3>
						</div>
						<p class="card-text" style="text-align: justify; padding: 0px 10px 0px; font-size:1rem; margin-bottom: 16px;">
							<?php echo $technicalReport[0]['remarks']; ?>
						</p>
					</div>
				</div>
			<?php }
		} ?>
		<div class="card" style="display: <?php echo $d; ?>">
			<div class="card-body">
				<div class="card-title" style="border-bottom: 1px solid black;">
					<h3>Reason</h3>
				</div>
				<form action="<?php echo site_url('Treasurer/rejectReq') ?>" method="post" class="mt-4">
					<div class="form-group">
						<input name="req" type="text" style="display: none;" value="<?php echo $row->req_id; ?>">
						<input type="hidden" name="complaint" value="<?php echo $row->complaint_id; ?>">
						<textarea name="report" type="text" rows="5" class="form-control" placeholder="Write Detailed Technical Reason Here..." required></textarea>
					</div>
					<button type="submit" class="btn btn-success">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

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
				<?php $dateString = date('Y-m-d', strtotime($expected_completion_time));
				if ($dateString[0] !== "-") { ?>
					<div style="color: <?php echo $expected_completion_time < time() ? "limegreen" : "red"; ?>" class="card-subtitle ">
						Due Time:
						<?php echo date('d M Y | h:i A', strtotime($expected_completion_time)); ?>
					</div>
				<?php } ?>
				<p class="card-text"
				   style="text-align: justify; padding: 0px 10px 0px; font-size:1rem; margin-bottom: 16px;">
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
									<p><?php echo $d->remarks; ?> <span
												style="margin-left: 5px; color:royalblue; text-decoration: underline;"><a
													id="buttonToggler"
													onclick="showDetails('buttonToggler', 'techniciansDetail')">View Technician's Details</a></span>
									</p>
								<?php } else if ($d->status == 2) { ?>
								<p><?php echo $d->remarks; ?> <span
											style="margin-left: 5px; color:royalblue; text-decoration: underline;"><a
												id="bb"
												onclick="showDetails('bb', 'assetDetails')">View Asset's Details</a></span>
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
													<p class="form-control-static"><?php echo $name; ?></p>
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
													<p class="form-control-static"><?php echo $phone_number; ?></p>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group row">
												<label class="control-label text-right col-md-3">Email Address:</label>
												<div class="col-md-9">
													<p class="form-control-static"><?php echo $email; ?></p>
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
		<div class="row" id="assetDetails" style="display: none">
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
										<th>Status</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($asset_details as $v) { ?>
										<tr>
											<td><?php echo $v->asset_id; ?></td>
											<td><?php echo $v->aname; ?></td>
											<td><?php echo $v->details; ?></td>
											<td><?php echo $v->quantity; ?></td>
											<td><?php
												if ($v->status == 0) {
													echo "Pending";
												} else if ($v->status == 1) {
													echo "Issued";
												} else {
													echo "Not Available";
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
		<?php if ($status == 3) {
			if ($complaint_feedback == 0) { ?>
				<div class="card">
					<div class="card-body">
						<div class="card-title" style="border-bottom: 1px solid black;">
							<h3>Feedback</h3>
						</div>
						<form method="POST"
							  action="<?php echo site_url('StoreMan/complaint_feedback/' . $complaint_id); ?>"
							  class="mt-4">
							<div class="form-group">
								<textarea type="text" name="feedback" rows="5" class="form-control"
										  placeholder="Your Feedback Here.." required></textarea>
								<small class="form-text text-muted">Your Feedback is important. It will help us to
									improve our services.</small>
							</div>
							<button type="submit" class="btn btn-info">Submit</button>
						</form>
					</div>
				</div>
			<?php } else { ?>
				<div class="card">
					<div class="card-body">
						<div class="card-title" style="border-bottom: 1px solid black;">
							<h3>Complaint Feedback</h3>
						</div>
						<p class="card-text"
						   style="text-align: justify; padding: 0px 10px 0px; font-size:1rem; margin-bottom: 16px;">
							<?php echo $complaint_feedback['feedback']; ?>
						</p>
					</div>
				</div>
			<?php }
		} ?>
	</div>
</div>

<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Tasks Performed</h4>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="vtabs customvtab">
					<ul class="nav nav-tabs tabs-vertical" role="tablist">
						<li class="nav-item"><a class="nav-link active " data-toggle="tab" href="#allComplaints" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">All Complaints</span> </a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pending" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Pending</span></a>
						</li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#processing" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Resolved</span></a>
						</li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#productWaiting" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Rejected</span></a></li>
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
											<th>Date</th>
											<th>Subject</th>
											<th>Description</th>
											<th>Status</th>
										</tr>
										</thead>
										<tbody>
										<?php foreach ($allComplaints as $row) { ?>
											<tr>
												<td><b><?php echo $row->complaint_id; ?></b></td>
												<td><?php echo $row->complaint_date; ?></td>
												<td><?php echo $row->subject; ?></td>
												<td><?php echo $row->description; ?></td>
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
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="tab-pane p-20" id="pending" role="tabpanel">
							<div class="table-responsive">
								<table id="pendingComplaintsTable" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>Complaint ID#</th>
										<th>Date</th>
										<th>Subject</th>
										<th>Description</th>
										<th>Status</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($pendingComplaints as $row) { ?>
										<tr>
											<td><b><?php echo $row->complaint_id; ?></b></td>
											<td><?php echo $row->complaint_date; ?></td>
											<td><?php echo $row->subject; ?></td>
											<td><?php echo $row->description; ?></td>
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
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane p-20" id="processing" role="tabpanel">
							<div class="table-responsive">
								<table id="resolvedComplaintsTable" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>Complaint ID#</th>
										<th>Date</th>
										<th>Subject</th>
										<th>Description</th>
										<th>Status</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($resolvedComplaints as $row) { ?>
										<tr>
											<td><b><?php echo $row->complaint_id; ?></b></td>
											<td><?php echo $row->complaint_date; ?></td>
											<td><?php echo $row->subject; ?></td>
											<td><?php echo $row->description; ?></td>
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
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane p-20" id="productWaiting" role="tabpanel">
							<div class="table-responsive">
								<table id="rejectedComplaintsTable" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>Complaint ID#</th>
										<th>Date</th>
										<th>Subject</th>
										<th>Description</th>
										<th>Status</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($rejectedComplaints as $row) { ?>
										<tr>
											<td><b><?php echo $row->complaint_id; ?></b></td>
											<td><?php echo $row->complaint_date; ?></td>
											<td><?php echo $row->subject; ?></td>
											<td><?php echo $row->description; ?></td>
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
												$stats = "Rejected";
												$color = "danger";
											} ?>
											<td>
												<span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span>
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

<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">View Requests</h4>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="vtabs customvtab">
					<ul class="nav nav-tabs tabs-vertical" role="tablist">
						<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#All_Requests" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">All requests</span> </a> </li>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#pending_Requests" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Pending Requests</span> </a> </li>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#Approved_Requests" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Approved Requests</span> </a> </li>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#Rejected_Requests" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Rejected Requests</span> </a> </li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="All_Requests" role="tabpanel">
							<div class="p-20">
								<div class="table-responsive">
									<table id="myTable" class="table table-bordered table-striped">
										<thead>
										<tr>
											<th>Request ID#</th>
											<th>Asset Name</th>
											<th>Detail</th>
											<th>Quantity</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
										<?php foreach ($treasurer_request as $row) { ?>
											<tr>
												<td><?php echo $row->req_id; ?></td>
												<td><?php echo $row->name; ?></td>
												<td><?php echo $row->details; ?></td>
												<td><?php echo $row->quantity; ?></td>
												<?php if ($row->status == 0) {
													$stats = "Pending";
													$color = "warning";
												} else if ($row->status == 1) {
													$stats = "Approved";
													$color = "success";
												} else if ($row->status == 2) {
													$stats = "Rejected";
													$color = "danger";
												} ?>
												<td><span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span></td>
												<td>
													<form action="<?php echo site_url('Treasurer/detail/' . $row->complaint_id); ?>" method="post">
														<input type="hidden" name="req_id" value="<?php echo $row->req_id; ?>">
														<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Detail</button>
													</form>
												</td>
											</tr>
										<?php }  ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="tab-pane p-20" id="pending_Requests" role="tabpanel">
							<div class="table-responsive">
								<table id="pendingComplaints" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>Request ID#</th>
										<th>Asset Name</th>
										<th>Detail</th>
										<th>Quantity</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($pending_treasurer_request as $row) { ?>
										<tr>
											<td>
												<?php echo $row->req_id ?>
											</td>
											<td><?php echo $row->name ?></td>
											<td><?php echo $row->details ?></td>
											<td><?php echo $row->quantity ?></td>
											<?php if ($row->status == 0) {
												$stats = "Pending";
												$color = "warning";
											} else if ($row->status == 1) {
												$stats = "Approved";
												$color = "success";
											} else if ($row->status == 2) {
												$stats = "Rejected";
												$color = "danger";
											} ?>
											<td><span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span></td>
											<td>
												<form action="<?php echo site_url('Treasurer/detail/' . $row->complaint_id); ?>" method="post">
													<input type="hidden" name="req_id" value="<?php echo $row->req_id; ?>">
													<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Detail</button>
												</form>
											</td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane p-20" id="Approved_Requests" role="tabpanel">
							<div class="table-responsive">
								<table id="processingComplaints" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>Request ID#</th>
										<th>Asset Name</th>
										<th>Detail</th>
										<th>Quantity</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($approved_treasurer_request as $row) { ?>
										<tr>
											<td>
												<?php echo $row->req_id ?>
											</td>
											<td><?php echo $row->name ?></td>
											<td><?php echo $row->details ?></td>
											<td><?php echo $row->quantity ?></td>
											<?php if ($row->status == 0) {
												$stats = "Pending";
												$color = "warning";
											} else if ($row->status == 1) {
												$stats = "Approved";
												$color = "success";
											} else if ($row->status == 2) {
												$stats = "Rejected";
												$color = "danger";
											} ?>
											<td><span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span></td>
											<td>
												<form action="<?php echo site_url('Treasurer/detail/' . $row->complaint_id); ?>" method="post">
													<input type="hidden" name="req_id" value="<?php echo $row->req_id; ?>">
													<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Detail</button>
												</form>
											</td>
										</tr>
									<?php }  ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane p-20" id="Rejected_Requests" role="tabpanel">
							<div class="table-responsive">
								<table id="productWaitingComplaints" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>Request ID#</th>
										<th>Asset Name</th>
										<th>Detail</th>
										<th>Quantity</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($rejected_treasurer_request as $row) { ?>
										<tr>
											<td>
												<?php echo $row->req_id ?>
											</td>
											<td><?php echo $row->name ?></td>
											<td><?php echo $row->details ?></td>
											<td><?php echo $row->quantity ?></td>
											<?php if ($row->status == 0) {
												$stats = "Pending";
												$color = "warning";
											} else if ($row->status == 1) {
												$stats = "Approved";
												$color = "success";
											} else if ($row->status == 2) {
												$stats = "Rejected";
												$color = "danger";
											} ?>
											<td><span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span></td>
											<td>
												<form action="<?php echo site_url('Treasurer/detail/' . $row->complaint_id); ?>" method="get">
													<input type="hidden" name="req_id" value="<?php echo $row->req_id; ?>">
													<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Detail</button>
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
		</div>
	</div>
</div>

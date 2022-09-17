<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Complaint History</h4>
			</div>
		</div>
		<?php?>
		<div class="card">
			<div class="card-body">
				<div class="vtabs customvtab">
					<ul class="nav nav-tabs tabs-vertical" role="tablist">
						<li class="nav-item"><a class="nav-link active " data-toggle="tab" href="#allComplaints"
												role="tab"><span class="hidden-sm-up"></span> <span
										class="hidden-xs-down">All Complaints</span> </a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pending" role="tab"><span
										class="hidden-sm-up"></span> <span class="hidden-xs-down">Pending</span></a>
						</li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#processing" role="tab"><span
										class="hidden-sm-up"></span> <span class="hidden-xs-down">In-Process</span></a>
						</li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#productWaiting"
												role="tab"><span class="hidden-sm-up"></span> <span
										class="hidden-xs-down">Product Requested</span></a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#resolve" role="tab"><span
										class="hidden-sm-up"></span> <span class="hidden-xs-down">Resolved</span></a>
						</li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#reject" role="tab"><span
										class="hidden-sm-up"></span> <span class="hidden-xs-down">Rejected</span></a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="allComplaints" role="tabpanel">
							<div class="p-20">
								<div class="table-responsive">
									<table id="allComplaintsTable" class="table table-bordered table-striped">
										<thead>
										<tr>
											<th>Complaint ID#</th>
											<th>Complaint Date</th>
											<th>Subject</th>
											<th>Department</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
										<?php foreach ($complaints as $row) { ?>
											<tr>
												<td>
													<b><a href="<?php echo site_url('Complinant/view_complaint/' . $row->complaint_id); ?>"><?php echo $row->complaint_id; ?></a></b>
												</td>
												<td><?php echo date('d M Y | h:i A', strtotime($row->complaint_date)); ?></td>
												<td><?php echo $row->subject; ?></td>
												<td><?php echo $row->dept_name; ?></td>
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
													<a href="<?php echo site_url('Complinant/view_complaint/' . $row->complaint_id); ?>"><span
																class="label label-danger"><i class="fa fa-pencil"
																							  style="margin-right: 10px;"></i>Track Complaint</span></a>
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="pending" role="tabpanel">
							<div class="p-20">
								<div class="table-responsive">
									<table id="pendingComplaints" class="table table-bordered table-striped">
										<thead>
										<tr>
											<th>Complaint ID#</th>
											<th>Complaint Date</th>
											<th>Subject</th>
											<th>Department</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
										<?php foreach ($pendingComplaints as $row) { ?>
											<tr>
												<td>
													<b><a href="<?php echo site_url('Complinant/view_complaint/' . $row->complaint_id); ?>"><?php echo $row->complaint_id; ?></a></b>
												</td>
												<td><?php echo date('d M Y | h:i A', strtotime($row->complaint_date)); ?></td>
												<td><?php echo $row->subject; ?></td>
												<td><?php echo $row->dept_name; ?></td>
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
													<a href="<?php echo site_url('Complinant/view_complaint/' . $row->complaint_id); ?>"><span
																class="label label-danger"><i class="fa fa-pencil"
																							  style="margin-right: 10px;"></i>Track Complaint</span></a>
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="processing" role="tabpanel">
							<div class="p-20">
								<div class="table-responsive">
									<table id="processingComplaints" class="table table-bordered table-striped">
										<thead>
										<tr>
											<th>Complaint ID#</th>
											<th>Complaint Date</th>
											<th>Subject</th>
											<th>Department</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
										<?php foreach ($InProcessComplaints as $row) { ?>
											<tr>
												<td>
													<b><a href="<?php echo site_url('Complinant/view_complaint/' . $row->complaint_id); ?>"><?php echo $row->complaint_id; ?></a></b>
												</td>
												<td><?php echo date('d M Y | h:i A', strtotime($row->complaint_date)); ?></td>
												<td><?php echo $row->subject; ?></td>
												<td><?php echo $row->dept_name; ?></td>
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
													<a href="<?php echo site_url('Complinant/view_complaint/' . $row->complaint_id); ?>"><span
																class="label label-danger"><i class="fa fa-pencil"
																							  style="margin-right: 10px;"></i>Track Complaint</span></a>
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="productWaiting" role="tabpanel">
							<div class="p-20">
								<div class="table-responsive">
									<table id="productWaitingComplaints" class="table table-bordered table-striped">
										<thead>
										<tr>
											<th>Complaint ID#</th>
											<th>Complaint Date</th>
											<th>Subject</th>
											<th>Department</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
										<?php foreach ($ReqAssetComplaints as $row) { ?>
											<tr>
												<td>
													<b><a href="<?php echo site_url('Complinant/view_complaint/' . $row->complaint_id); ?>"><?php echo $row->complaint_id; ?></a></b>
												</td>
												<td><?php echo date('d M Y | h:i A', strtotime($row->complaint_date)); ?></td>
												<td><?php echo $row->subject; ?></td>
												<td><?php echo $row->dept_name; ?></td>
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
													<a href="<?php echo site_url('Complinant/view_complaint/' . $row->complaint_id); ?>"><span
																class="label label-danger"><i class="fa fa-pencil"
																							  style="margin-right: 10px;"></i>Track Complaint</span></a>
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="resolve" role="tabpanel">
							<div class="p-20">
								<div class="table-responsive">
									<table id="resolveComplaints" class="table table-bordered table-striped">
										<thead>
										<tr>
											<th>Complaint ID#</th>
											<th>Complaint Date</th>
											<th>Subject</th>
											<th>Department</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
										<?php foreach ($Resolved as $row) { ?>
											<tr>
												<td>
													<b><a href="<?php echo site_url('Complinant/view_complaint/' . $row->complaint_id); ?>"><?php echo $row->complaint_id; ?></a></b>
												</td>
												<td><?php echo date('d M Y | h:i A', strtotime($row->complaint_date)); ?></td>
												<td><?php echo $row->subject; ?></td>
												<td><?php echo $row->dept_name; ?></td>
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
													<a href="<?php echo site_url('Complinant/view_complaint/' . $row->complaint_id); ?>"><span
																class="label label-danger"><i class="fa fa-pencil"
																							  style="margin-right: 10px;"></i>Track Complaint</span></a>
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="reject" role="tabpanel">
							<div class="p-20">
								<div class="table-responsive">
									<table id="rejectComplaints" class="table table-bordered table-striped">
										<thead>
										<tr>
											<th>Complaint ID#</th>
											<th>Complaint Date</th>
											<th>Subject</th>
											<th>Department</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
										<?php foreach ($Rejected as $row) { ?>
											<tr>
												<td>
													<b><a href="<?php echo site_url('Complinant/view_complaint/' . $row->complaint_id); ?>"><?php echo $row->complaint_id; ?></a></b>
												</td>
												<td><?php echo date('d M Y | h:i A', strtotime($row->complaint_date)); ?></td>
												<td><?php echo $row->subject; ?></td>
												<td><?php echo $row->dept_name; ?></td>
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
												<td>
													<a href="<?php echo site_url('Complinant/view_complaint/' . $row->complaint_id); ?>"><span
																class="label label-danger"><i class="fa fa-pencil"
																							  style="margin-right: 10px;"></i>Track Complaint</span></a>
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


<!--				<div class="table-responsive">-->
<!--					<table id="myTable" class="table table-bordered table-striped">-->
<!--						<thead>-->
<!--						<tr>-->
<!--							<th>Complaint ID#</th>-->
<!--							<th>Complaint Date</th>-->
<!--							<th>Subject</th>-->
<!--							<th>Department</th>-->
<!--							<th>Status</th>-->
<!--							<th>Action</th>-->
<!--						</tr>-->
<!--						</thead>-->
<!--						<tbody>-->
<!--						--><?php //foreach ($complaints as $row) { ?>
<!--							<tr>-->
<!--								<td>-->
<!--									<b><a href="-->
<!--				--><?php //echo site_url('Complinant/view_complaint/' . $row->complaint_id); ?><!--">-->
<!--											--><?php //echo $row->complaint_id; ?><!--</a></b>-->
<!--								</td>-->
<!--								<td>-->
<!--									--><?php //echo date('d M Y | h:i A', strtotime($row->complaint_date)); ?><!--</td>-->
<!--								<td>--><?php //echo $row->subject; ?><!--</td>-->
<!--								<td>--><?php //echo $row->dept_name; ?><!--</td>-->
<!--								--><?php //if ($row->status == 0) {
//									$stats = "Pending";
//									$color = "warning";
//								} else if ($row->status == 1) {
//									$stats = "In-Process";
//									$color = "info";
//								} else if ($row->status == 2) {
//									$stats = "Product Requested";
//									$color = "primary";
//								} else {
//									$stats = "Closed";
//									$color = "success";
//								} ?>
<!--								<td><span class="label label---><?php //echo $color; ?><!--">-->
<!--				--><?php //echo $stats; ?><!--</span></td>-->
<!--								<td>-->
<!--									<a href="-->
<!--				--><?php //echo site_url('Complinant/view_complaint/' . $row->complaint_id); ?><!--"><span-->
<!--												class="label label-danger"><i class="fa fa-pencil"-->
<!--																			  style="margin-right: 10px;"></i>Track Complaint</span></a>-->
<!--								</td>-->
<!--							</tr>-->
<!--						--><?php //} ?>
<!--						</tbody>-->
<!--					</table>-->
<!--				</div>-->
			</div>
		</div>
	</div>
</div>

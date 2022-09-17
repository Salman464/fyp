<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Required Products</h4>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="vtabs customvtab">

					<ul class="nav nav-tabs tabs-vertical" role="tablist">
						<li class="nav-item"> <a class="nav-link active " data-toggle="tab" href="#allRequests" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">All Requests</span> </a> </li>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#pending" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Pending Requests</span></a> </li>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#issued" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Issued Products</span></a> </li>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#not-available" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Not Available</span></a> </li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="allRequests" role="tabpanel">
							<div class="p-20">
								<div class="table-responsive">
									<table id="myTable" class="table table-bordered table-striped">
										<thead>
										<tr>
											<th>ID#</th>
											<th>Complaint ID#</th>
											<th>Product Name</th>
											<th>Product Detail</th>
											<th>Quantity</th>
											<th>Status</th>
											<th>View Details.</th>
										</tr>
										</thead>
										<tbody>
										<?php
										foreach ($asset as $row) { ?>
											<tr>
												<td><?php echo $row->asset_id ?></td>
												<td><?php echo $row->complaint_id ?></td>
												<td><?php echo substr($row->name,0,12) ?></td>
												<td><?php echo substr($row->details,0,49) ?></td>
												<td><?php echo $row->quantity ?></td>
												<?php if ($row->status == 0) {
													$stats = "Pending";
													$color = "warning";
												} else if ($row->status == 1) {
													$stats = "Issued";
													$color = "success";
												} else if ($row->status == 2) {
													$stats = "Not Available";
													$color = "danger";
												} ?>
												<td><span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span></td>
												<td><a href="<?php echo site_url('StoreMan/view_request_product/') . $row->asset_id ?>"> <span class="label label-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Detail</span></a></td>
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
										<th>ID#</th>
										<th>Complaint ID#</th>
										<th>Product Name</th>
										<th>Product Detail</th>
										<th>Quantity</th>
										<th>Status</th>
										<th>View Details.</th>
									</tr>
									</thead>
									<tbody>
									<?php
									foreach ($pendingAssets as $row) { ?>
										<tr>
											<td><?php echo $row->asset_id; ?></td>
											<td><?php echo $row->complaint_id; ?></td>
											<td><?php echo substr($row->name,0,12) ?></td>
											<td><?php echo substr($row->details,0,49) ?></td>
											<td><?php echo $row->quantity; ?></td>
											<?php if ($row->status == 0) {
												$stats = "Pending";
												$color = "warning";
											} else if ($row->status == 1) {
												$stats = "Issued";
												$color = "success";
											} else if ($row->status == 2) {
												$stats = "Not Available";
												$color = "danger";
											} ?>
											<td><span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span></td>
											<td><a href="<?php echo site_url('StoreMan/view_request_product/') . $row->asset_id; ?>"> <span class="label label-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Detail</span></a></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane p-20" id="issued" role="tabpanel">
							<div class="table-responsive">
								<table id="processingComplaints" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>ID#</th>
										<th>Complaint ID#</th>
										<th>Product Name</th>
										<th>Product Detail</th>
										<th>Quantity</th>
										<th>Status</th>
										<th>View Details.</th>
									</tr>
									</thead>
									<tbody>
									<?php
									foreach ($issued as $row) { ?>
										<tr>
											<td><?php echo $row->asset_id; ?></td>
											<td><?php echo $row->complaint_id; ?></td>
											<td><?php echo substr($row->name,0,12) ?></td>
											<td><?php echo substr($row->details,0,49) ?></td>
											<td><?php echo $row->quantity; ?></td>
											<?php if ($row->status == 0) {
												$stats = "Pending";
												$color = "warning";
											} else if ($row->status == 1) {
												$stats = "Issued";
												$color = "success";
											} else if ($row->status == 2) {
												$stats = "Not Available";
												$color = "danger";
											} ?>
											<td><span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span></td>
											<td><a href="<?php echo site_url('StoreMan/view_request_product/') . $row->asset_id; ?>"> <span class="label label-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Detail</span></a></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane p-20" id="not-available" role="tabpanel">
							<div class="table-responsive">
								<table id="productWaitingComplaints" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>ID#</th>
										<th>Complaint ID#</th>
										<th>Product Name</th>
										<th>Product Detail</th>
										<th>Quantity</th>
										<th>Status</th>
										<th>View Details.</th>
									</tr>
									</thead>
									<tbody>
									<?php
									foreach ($nAAssets as $row) { ?>
										<tr>
											<td><?php echo $row->asset_id; ?></td>
											<td><?php echo $row->complaint_id; ?></td>
											<td><?php echo substr($row->name,0,12) ?></td>
											<td><?php echo substr($row->details,0,49) ?></td>
											<td><?php echo $row->quantity; ?></td>
											<?php if ($row->status == 0) {
												$stats = "Pending";
												$color = "warning";
											} else if ($row->status == 1) {
												$stats = "Issued";
												$color = "success";
											} else if ($row->status == 2) {
												$stats = "Not Available";
												$color = "danger";
											} ?>
											<td><span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span></td>
											<td><a href="<?php echo site_url('StoreMan/view_request_product/') . $row->asset_id; ?>"> <span class="label label-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Detail</span></a></td>
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

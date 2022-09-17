<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Required Products</h4>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<!-- Nav tabs -->
				<div class="vtabs customvtab">
					<ul class="nav nav-tabs tabs-vertical" role="tablist">
						<li class="nav-item"> <a class="nav-link active " data-toggle="tab" href="#allRequests" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">All Requests</span> </a> </li>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#pendingRequests" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Pending Requests</span></a> </li>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#issuedProducts" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Issued Products</span></a> </li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="allRequests" role="tabpanel">
							<div class="p-20">
								<div class="table-responsive">
									<table id="myTable" class="table table-bordered table-striped">
										<thead>
										<tr>
											<th>ID#</th>
											<th>Product Name</th>
											<th>Quantity</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
										<?php foreach ($allReqs as $row) { ?>
											<tr>
												<td><?php echo $row->id; ?></td>
												<td><?php echo $row->name; ?></td>
												<td><?php echo $row->quantity; ?></td>
												<?php if ($row->status == 0) {
													$stats = "Pending";
													$color = "warning";
												} else if ($row->status == 1) {
													$stats = "Issued";
													$color = "success";
												} ?>
												<td><span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span></td>
												<td><a href="<?php echo site_url('Purchaser/detail_product/' . $row->id); ?>"><button type="submit" value="submit" class="btn btn-xs btn-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Details</button></a></td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="tab-pane p-20" id="pendingRequests" role="tabpanel">
							<div class="table-responsive">
								<table id="pendingComplaints" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>ID</th>
										<th>Product Name</th>
										<th>Quantity</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($pendingReqs as $row) { ?>
										<tr>
											<td><?php echo $row->id; ?></td>
											<td><?php echo $row->name; ?></td>
											<td><?php echo $row->quantity; ?></td>
											<?php if ($row->status == 0) {
												$stats = "Pending";
												$color = "warning";
											} else if ($row->status == 1) {
												$stats = "Issued";
												$color = "success";
											} ?>
											<td><span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span></td>
											<td><a href="<?php echo site_url('Purchaser/detail_product/' . $row->id); ?>"><button type="submit" value="submit" class="btn btn-xs btn-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Details</button></a></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane p-20" id="issuedProducts" role="tabpanel">
							<div class="table-responsive">
								<table id="processingComplaints" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>ID</th>
										<th>Product Name</th>
										<th>Quantity</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($issued as $row) { ?>
										<tr>
											<td><?php echo $row->id; ?></td>
											<td><?php echo $row->name; ?></td>
											<td><?php echo $row->quantity; ?></td>
											<?php if ($row->status == 0) {
												$stats = "Pending";
												$color = "warning";
											} else if ($row->status == 1) {
												$stats = "Issued";
												$color = "success";
											} ?>
											<td><span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span></td>
											<td><a href="<?php echo site_url('Purchaser/detail_product/' . $row->id); ?>"><button type="submit" value="submit" class="btn btn-xs btn-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Details</button></a></td>
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

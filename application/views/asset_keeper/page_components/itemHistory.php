<div class="page-wrapper printArea">
	<div class="container-fluid">
		<div class="row page-titles">
			<a href="<?php echo site_url('AssetKeeper/availableInventory') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i></a>
			<div class="col-md-4 align-self-center">
				<h4 class="text-themecolor"><b><?php echo $title; ?></b></h4>
			</div>
			<div class="col-md-7 align-self-center text-right">
				<div class="d-flex justify-content-end align-items-center">
					<a style="font-size: 18px;" href="javascript:void(0)" onclick="printSection()">Print<i class="fas fa-print" style="color: black; margin-left:5px;"></i></a>
				</div>
			</div>
		</div>


	
		<div class="card">
			<div class="card-header">
				<h3><i class="fa fa-trash" style="margin-right: 5px; color:red;"></i> Utilization History</h3>
			</div>
			<div class="card-body">
				<!-- Nav tabs -->
				<div class="vtabs customvtab">
					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active" id="all" role="tabpanel">
							<div class="p-20">
								<div class="row">
									<div class="col-md-2 col-sm-4">
										<h4>
											<b>ID# :</b>
										</h4>
										<h4>
											<b>Item Name :</b>
										</h4>
										<h4>
											<b>Description:</b>
										</h4>
									</div>
									<div class="col-md-8 col-sm-8">
										<h4>
											<?php echo $item['id'] ?>
										</h4>
										<h4>
											<?php echo $item['name'] ?>
										</h4>
										<h4>
											<?php echo $item['description'] ?>
										</h4>
									</div>
								</div></br>
	
								<div class="row"></div>
								<div class="table-responsive">
									<?php if(!empty($history)): ?>
									<table id="allItemsTable" class="table table-bordered table-striped">
										<thead>
										<tr>
											<th>Usage</th>
											<th>Quantity</th>
											<th>Used on</th>
                                            <th>Utilized in Complaint#</th>
										</tr>
										
										</thead>
										<tbody>
										<?php foreach ($history as $row){ ?>
											<tr>
												<td><?php echo $row['usedin']; ?></td>
												<td><?php echo $row['usedquantity']; ?></td>
												<td><?php echo $row['issued_at']; ?></td>
                                                <td><a class="btn btn-info btn-sm" href="<?php echo site_url('AssetKeeper/usedInComplaint/'.$row['complaint_id']); ?>"><i class="fa fa-edit"></i>Complaint<?php echo ' #'.$row['complaint_id']; ?></a></td>	
									
											</tr>
										<?php } ?>
										</tbody>
									</table>
									<?php else:?>
										<div class="col-12">
											<div class="alert alert-dismissible" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo htmlspecialchars("No Utilize History Available....!"); ?>
											</div>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header">
				<h3><i class="fa fa-arrow-down" style="margin-right: 5px; color:green;"></i>Add to Inventory History</h3>	
			</div>
			<div class="card-body">
			<div class="vtabs customvtab">
					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active" id="all" role="tabpanel">
							<div class="p-20 table-responsive">
								<?php if(!empty($added)): ?>
									<table id="addedTable" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>ID#</th>
												<th>Added date</th>
												<th>Added quantity</th>
												<th>Comment/Remark</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($added as $value): ?>
											<tr>
												<td><?php echo $value['id'] ?></td>
												<td><?php echo $value['added_on'] ?></td>
												<td><?php echo $value['added_quantity'] ?></td>
												<td><?php echo $value['remark'] ?></td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								<?php else: ?>
									<div class="col-12">
										<div class="alert alert-dismissible" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo htmlspecialchars("No Add History Available....!"); ?>
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

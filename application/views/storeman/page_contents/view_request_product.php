<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Request Details</h4>
			</div>
		</div>
		<?php if ($this->session->flashdata('errors')) { ?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $this->session->flashdata('errors'); $this->session->set_flashdata('errors',''); ?>
			</div>
		<?php } ?>
		<?php if ($this->session->flashdata('success')) { ?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $this->session->flashdata('success'); $this->session->set_flashdata('success',''); ?>
			</div>
		<?php } ?>
		<?php extract($complaint); ?>
		<div class="card" style="display: none;" id="complaintDetails">
			<div class="card-body">
				<div class="card-title" style="border-bottom: 1px solid black;">
					<h3><?php echo $complaint_id . ": " . $subject; ?> </h3>
				</div>
				<div class="card-subtitle">
					<?php echo date('d M Y | h:i A', strtotime($complaint_date)); ?>
				</div>
				<p class="card-text" style="text-align: justify; padding: 0px 10px 0px; font-size:1rem; margin-bottom: 16px;">
					<?php echo $description; ?>
				</p>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<?php extract($asset); ?>
				<div class="form">
					<div class="form-body">
						<div class="card-title" style="border-bottom: 1px solid black;">
							<h3>Product Request Detail</h3>
						</div>
						<div class="row p-t-20">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Asset ID</label>
									<input type="number" id="requestID" class="form-control" value="<?php echo $asset_id; ?>" readonly>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Complaint ID</label>
									<input type="number" value="<?php echo $complaint_id; ?>" id="productName" class="form-control form-control-danger" readonly>
									<a id="details" class="btn" onclick="showDetails('details', 'complaintDetails')"><small class="form-control-feedback">View Details</small></a>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Product Name</label>
									<input type="text" id="productDetail" value="<?php echo $name; ?>" class="form-control form-control-danger" readonly>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Required quantity</label>
									<input type="number" id="productDetail" value="<?php echo $quantity; ?>" class="form-control form-control-danger" readonly>
								</div>
							</div>
						</div>
						<div class="row">

							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Detail Of Product</label>
									<textarea type="text" rows="6" class="form-control" readonly><?php echo $details; ?></textarea>
								</div>
							</div>
								<div class="col-md-6">
							<form style="display: inline;" method="post" action="<?php echo site_url('StoreMan/updateProductStatus'); ?>">

									<?php if ($asset['status'] == 0 || $asset['status'] == 2) { ?>
										<div class="form-group">
											<label class="control-label" for="inputGroupSelect01">Select product from inventory</label></br>
											<select name="item_id" class="form-control custom-select" id="inputGroupSelect01" required>
												<option selected value="">Select product...</option>
												<?php foreach ($product as $row): ?>
													<option class="form-control" value="<?php echo $row['id']; ?>"><?php echo $row['id'].'-'.$row['name']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										
										<div class="text-right">
											
											<input type="hidden" name="asset_id" value="<?php echo $asset_id; ?>">
											<input type="hidden" name="complaint_id" value="<?php echo $asset['complaint_id']; ?>">
											<input type="hidden" name="stat" value="1">
											<input type="hidden" name="old_stat" value="<?php $asset['status'] ?>">
											<input type="hidden" name="usage" value="<?php echo $complaint['description']; ?>">
											<input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
											<button type="submit" name="submit" id="submit" class="btn btn-success">Issue</button>
											
										</div>
									<?php }?>
							</form>
								</div>
						</div>
					</div>
				</div>
				
				<form method="post" action="<?php echo site_url('StoreMan/updateAmount'); ?>">
						<input type="hidden" name="asset_id" value="<?php echo $asset_id; ?>">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label" for="amount">Total Amount</label>
									<input type="number" name="amount" value="<?php echo set_value('total_amount', $asset['total_amount']); ?>" class="form-control" placeholder="Enter Expected Amount" <?php echo $asset['status'] == 1 ? "Readonly" : ""; ?> required>
									<?php if ($asset['status']!=1):?>
									<button class="btn mt-2 btn-sm btn-info" type="submit" value="submit">Update</button>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</form>
				
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="amount">Total Amount</label>
								<input type="number" name="amount" value="<?php echo set_value('total_amount', $asset['total_amount']); ?>" class="form-control" placeholder="Enter Expected Amount" readonly required>
							</div>
						</div>
					</div> -->
					<?php if ($asset['status'] == 0 || $asset['status'] == 2) { ?>
						<div class="text-right">
							
							<?php if ($asset['status'] != 2) { ?>
								<form style="display: inline;" method="post" action="<?php echo site_url('StoreMan/updateProductStatus'); ?>">
									<input type="hidden" name="asset_id" value="<?php echo $asset_id; ?>">
									<input type="hidden" name="complaint_id" value="<?php echo $asset['complaint_id']; ?>">
									<input type="hidden" name="old_stat" value="<?php $asset['status'] ?>">
									<input type="hidden" name="stat" value="2">
									<button type="submit" class="btn btn-danger">Not Available</button>
								</form>
							<?php } ?>
						</div>
					<?php }?>
			</div>
		</div>
	</div>
</div>
<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Product Details</h4>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="form-body">
					<div class="card-title" style="border-bottom: 1px solid black;">
						<h3>Product Details</h3>
					</div>
					<?php extract($asset); ?>
					<div class="row p-t-20">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Product ID</label>
								<input type="number" id="requestID" class="form-control" value="<?php echo $asset_id; ?>" readonly>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Product Name</label>
								<input type="text" id="productDetail" value="<?php echo $name; ?>" class="form-control form-control-danger" readonly>
							</div>
						</div>
					</div>

					<div class="row">

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Quantity</label>
								<input type="number" id="productDetail" class="form-control form-control-danger" placeholder="2" readonly>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Total Amount</label>
								<input type="number" value="<?php echo $total_amount; ?>" class="form-control" placeholder="Enter Expected Amount" readonly>
								<small class="form-text text-muted">Amount Approved from Treasurer</small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Product Details</label>
								<textarea type="text" rows="6" class="form-control" readonly><?php echo $details; ?></textarea>
							</div>
						</div>
					</div>
					<?php if ($status == 0) { ?>
						<div class="col text-right">
							<form action="<?php echo site_url('Purchaser/issueProduct'); ?>" method="post">
								<input type="hidden" value="<?php echo $id; ?>" name="req">
								<input type="hidden" value="<?php echo $asset_id; ?>" name="asset_id">
								<button type="submit" class="btn btn-success">Issue</button>
							</form>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

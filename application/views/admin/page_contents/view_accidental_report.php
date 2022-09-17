<div class="page-wrapper printArea">
	<div class="container-fluid">
		<div class="row page-titles">
			<?php foreach ($accidental_report_details as $value) { ?>
				<div class="col-md-5 align-self-center">
					<h4 class="text-themecolor">Accidental Report# <?php echo $value->id; ?></h4>
				</div>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<a style="font-size: 18px; margin-right:10px;" href="javascript:void(0)"
						   onclick="printSection()">Print<i class="fas fa-print"
															style="color: black; margin-left:5px;"></i></a>
						<?php if ($value->status == 0) { ?>
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#add-contact"><i
										class="fas fa-plus-circle" style="margin-right: 5px;"></i> Add Assets Details
							</button>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php foreach ($accidental_report_details

		as $key) { ?>
		<div class="card">
			<div class="card-body">
				<div id="add-contact" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
					 aria-hidden="true" style="display: none;">
					<div class="modal-dialog">
						<form action="<?php echo site_url('Admin/addAssetDetailsAccidentalReport'); ?>" method="post"
							  class="form-horizontal form-material">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="myModalLabel">Add Asset Details</h4>
									<button type="reset" value="reset" class="close" data-dismiss="modal"
											aria-hidden="true"><i class="fas fa-times-circle"
																  style="margin-right: 5px;"></i></button>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<div class="col-md-12 m-b-20">
											<input type="hidden" name="accidental_report_id" class="form-control"
												   value="<?php echo $key->id; ?>" readonly required>
										</div>
										<div class="col-md-12 m-b-20">
											<input type="text" name="asset_name" class="form-control"
												   placeholder="Asset Name" required>
										</div>
										<div class="col-md-12 m-b-20">
											<input type="number" class="form-control" name="qty" placeholder="Quantity"
												   required>
										</div>
										<div class="col-md-12 m-b-20">
											<textarea name="asset_details" class="form-control"
													  placeholder="Asset Details" required cols="30"
													  rows="10"></textarea>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn waves-effect waves-light btn-rounded btn-info">
										Save
									</button>
									<button type="reset" value="reset"
											class="btn waves-effect waves-light btn-rounded btn-secondary"
											data-dismiss="modal">Cancel
									</button>
								</div>
						</form>
					</div>
				</div>
			</div>
			<div class="card-title" style="border-bottom: 1px solid black;">
				<h3><?php echo $key->subject; ?><?php echo ($key->status == 1) ? "<p class='label label-lg label-success'>Approved</p>" : ""; ?></h3>
			</div>
			<div class="card-subtitle">
				Date: <?php echo date('d M Y | h:i A', strtotime($key->date_created)); ?>
			</div>
			<div class="form-group" style="text-align: justify; padding: 0px 10px 0px; margin-bottom: 16px;">
				<label>Department: </label>
				<input type="text" disabled value="<?php echo $key->dept_name; ?>">
			</div>
			<p class="card-text"
			   style="text-align: justify; padding: 0px 10px 0px; font-size:1rem; margin-bottom: 16px;">
				<?php echo $key->description; ?>
			</p>
		</div>
	</div>
	<?php } ?>
	<!-- Check if There is any asset req against complaint id then assign variable's value 'block' otherwise 'none';! -->
	<?php $display = $accidental_asset_details == 0 ? "none" : "block";
	?>
	<div class="row" id="productDetails" style="display: <?php echo $display; ?>;">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="card-title" style="border-bottom: 1px solid black;">
						<h3>Product Details</h3>
					</div>
					<div class="card-text">
						<?php if ($accidental_asset_details !== 0) { ?>
							<div class="table-responsive">
								<table id="product_data" class="table table-bordered m-t-30 table-hover contact-list">
									<thead>
									<tr>
										<th>Name</th>
										<th>Details</th>
										<th>Quantity</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($accidental_asset_details as $v) { ?>
										<tr>
											<td><?php echo $v->asset_name; ?></td>
											<td><?php echo $v->asset_details; ?></td>
											<td><?php echo $v->qty; ?></td>
										</tr>
									<?php } ?>
									</tbody>
									<tfoot>
									<tr>
										<td colspan="2"><b>Total Cost</b></td>
										<td><?php echo $key->total_cost; ?></td>
									</tr>
									</tfoot>
								</table>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

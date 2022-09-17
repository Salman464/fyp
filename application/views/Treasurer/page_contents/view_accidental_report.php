<div class="page-wrapper printArea">
	<div class="container-fluid">
		<div class="row page-titles">
			<?php foreach ($accidental_report_details as $value) { ?>
				<div class="col-md-5 align-self-center">
					<h4 class="text-themecolor">Accidental Report# <?php echo $value->id; ?></h4>
				</div>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<a style="font-size: 18px; margin-right:10px;" href="javascript:void(0)" onclick="printSection()">Print<i class="fas fa-print" style="color: black; margin-left:5px;"></i></a>
						<?php if ($value->status == 0) { ?>
							<a href="<?php echo site_url('Treasurer/ApproveAccidentalReport/'.$value->id); ?>" type="button" class="btn btn-success">Approve</a>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php foreach ($accidental_report_details as $key) { ?>
			<div class="card">
				<div class="card-body">
					<div class="card-title" style="border-bottom: 1px solid black;">
						<h3><?php echo $key->subject; ?></h3>
					</div>
					<div class="card-subtitle">
						Date: <?php echo date('d M Y | h:i A', strtotime($key->date_created)); ?>
					</div>
					<div class="form-group" style="text-align: justify; padding: 0px 10px 0px; margin-bottom: 16px;">
						<label>Department: </label>
						<input type="text" disabled value="<?php echo $key->dept_name; ?>">
					</div>
					<p class="card-text" style="text-align: justify; padding: 0px 10px 0px; font-size:1rem; margin-bottom: 16px;">
						<?php echo $key->description; ?>
					</p>
				</div>
			</div>
		<?php } ?>
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

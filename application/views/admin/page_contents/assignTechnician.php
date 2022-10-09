<div class="page-wrapper printArea">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Assign Technician</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list">
								<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Department</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($technicians_details as $tech) { ?>
									<tr>
										<td><?php echo $tech->technician_id; ?></td>
										<td><?php echo $tech->name; ?></td>
										<td><?php echo $tech->email; ?></td>
										<td><?php echo $tech->phone_number; ?></td>
										<td><?php echo $tech->n; ?></td>
										<td>
											<form action="<?php echo site_url('Admin/assignTech'); ?>" method="POST">
												<input type="hidden" name="complaint_id" value="<?php echo $misc['complaint_id']; ?>">
												<input type="hidden" name="technician_id" value="<?php echo $tech->technician_id; ?>">
												<input type="hidden" name="technician_email" value="<?php echo $tech->email; ?>">
												<button class="btn btn-info d-none d-lg-block m-l-15" type="submit"><i class="fas fa-check-square" style="margin-right: 5px;"></i>
													Assign
													Task
												</button>
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

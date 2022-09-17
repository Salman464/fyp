<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Technicians</h4>
			</div>
			<div class="col-md-7 align-self-center text-right">
				<div class="d-flex justify-content-end align-items-center">
					<button type="button" class="btn btn-info" data-toggle="modal" data-target="#add-contact"><i class="fas fa-plus-circle" style="margin-right: 5px;"></i> Add New Technician
					</button>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div id="add-contact" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
					<div class="modal-dialog">
						<form action="<?php echo site_url('Admin/addTechnician'); ?>" method="post" class="form-horizontal form-material">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="myModalLabel">Add Technician's Details</h4>
									<button type="reset" value="reset" class="close" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times-circle" style="margin-right: 5px;"></i></button>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<div class="col-md-12 m-b-20">
											<input type="number" pattern="\d*" onKeyPress="if(this.value.length==15) return false;" name="id" class="form-control" placeholder="Enter ID here..." required>
										</div>
										<div class="col-md-12 m-b-20">
											<select name="dept_name" class="form-control custom-select" required>
												<option value="">--Select Department--</option>
												<option value='1'>Electricity</option>
												<option value='2'>Furniture</option>
												<option value='3'>HVAC</option>
												<option value='4'>Plumbing</option>
												<option value='5'>Mechanical</option>
												<option value='6'>Civil</option>
												<option value='7'>Surveillance</option>
												<option value='8'>IT</option>
											</select>
										</div>
										<div class="col-md-12 m-b-20">
											<input type="text" class="form-control" name="tech_name" placeholder="Name" required>
										</div>
										<div class="col-md-12 m-b-20">
											<input type="number" pattern="\d*" onKeyPress="if(this.value.length==15) return false;" class="form-control" name="phone_number" placeholder="Phone Number" required>
										</div>
										<div class="col-md-12 m-b-20">
											<input type="email" class="form-control" name="email" placeholder="Email" required>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn waves-effect waves-light btn-rounded btn-info">
										Save
									</button>
									<button type="reset" value="reset" class="btn waves-effect waves-light btn-rounded btn-secondary" data-dismiss="modal">Cancel
									</button>
								</div>
							</div>
						</form>
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

				<div class="table-responsive">
					<table id="myTable" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Department</th>
								<th>Details</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($tech as $d) { ?>
								<tr>
									<td><?php echo $d->technician_id; ?></td>
									<td><?php echo $d->name; ?></td>
									<td><?php echo $d->email; ?></td>
									<td><?php echo $d->phone_number; ?></td>
									<td><?php echo $d->dept_name; ?></td>
									<td>
										<form action="<?php echo site_url('Admin/view_technician_performance/' . $d->technician_id); ?>" method="get">
											<input type="hidden" name="status" value="">
											<?php
											$t = date("Y-m-d", strtotime('+1 day'));
											$d2 = date('Y-m-d', strtotime('-30 days'));
											?>
											<input type="hidden" name="start_date" value="<?php echo $d2; ?>">
											<input type="hidden" name="end_date" value="<?php echo $t; ?>">
											<button class="btn btn-info d-none d-lg-block m-l-15" type="submit"><i class="fas fa-check-square" style="margin-right: 5px;"></i> View
												Details
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

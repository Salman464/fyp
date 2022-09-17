<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Register Complaint</h4>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="card-title" style="border-bottom: 1px solid black;">
					<h3>Complaint</h3>
				</div>
				<form method="POST" action="<?php echo site_url('Admin/regComplaint') ?>">
					<div class="form-body">
						<div class="row p-t-20">
							<div class="col-md-6">
								<div class="form-group">
									<input name="user_id" type="hidden" id="user_id" class="form-control" value="<?php echo $this->session->userdata('user_id'); ?>">
									<label class="control-label">Subject</label>
									<input name="subject" maxlength="70" type="text" id="subject" class="form-control" required>
									<small id="subjectError" style="color: red;" class="form-control-feedback"></small>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
								<div class="form-group ">
									<label class="control-label">Complaint Date</label>
									<input name="" type="text" id="date" class="form-control" value="" readonly disabled>
								</div>
							</div>
							<!--/span-->
						</div>
						<!--/row-->
						<!-- <div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Department</label>
									<select name="dept_name" class="form-control custom-select" required>
										<option value=""></option>
										<option value='1'>Electricity</option>
										<option value='2'>Furniture</option>
										<option value='3'>HVAC</option>
										<option value='4'>Plumbing</option>
										<option value='5'>Mechanical</option>
										<option value='6'>Civil</option>
										<option value='7'>Surveillance</option>
										<option value='8'>IT</option>
									</select>
									<small id="departmentError" style="color: red;" class="form-control-feedback"></small>
								</div>
							</div>
							
						</div> -->
						<!--/row-->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Details</label>
									<textarea name="details" class="form-control custom-select" rows="10" placeholder="Write Details Here." required></textarea>
									<small id="departmentError" style="color: red;" class="form-control-feedback"></small>
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions text-right">
						<button type="submit" class="btn btn-success"> <i class="fa fa-check" style="margin-right: 10px;"></i>Send</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

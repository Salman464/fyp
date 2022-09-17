<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Accidental Report</h4>
			</div>
		</div>
		<form action="<?php echo site_url('Admin/regAccidentalReport'); ?>" method="post">
			<div class="card">
				<div class="card-body">
					<div class="card-title" style="border-bottom: 1px solid black;">
						<h3>Accidental Report</h3>
					</div>
					<div class="form-body">
						<div class="row p-t-20">
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
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
								<div class="form-group ">
									<label class="control-label">Start Date</label>
									<input type="datetime-local" name="start_date" class="form-control">
								</div>
							</div>
							<!--/span-->
						</div>
						<!--/row-->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Subject</label>
									<input name="subject" maxlength="70" type="text" id="subject" class="form-control" required>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
								<div class="form-group ">
									<label class="control-label">End Date</label>
									<input type="datetime-local" name="end_date" class="form-control">
								</div>
							</div>
						</div>
						<!--/row-->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Description</label>
									<textarea name="description" class="form-control custom-select" rows="10" placeholder="Write Description Here." required></textarea>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Total Cost</label>
									<input type="number" name="total_cost" class="form-control">
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions text-right">
						<button type="submit" class="btn btn-success"> <i class="fa fa-check" style="margin-right: 10px;"></i>Send</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

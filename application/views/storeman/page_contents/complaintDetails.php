<?php extract($cmp); ?>
<?php if ($dept_name != "IT") { ?>
	<div class="page-wrapper printArea">
		<div class="container-fluid">
			<div class="row page-titles">
				<div class="col-md-5 align-self-center">
					<h4 class="text-themecolor">Complaint# <?php echo $complaint_id; ?></h4>
				</div>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<a style="font-size: 18px;" href="javascript:void(0)" onclick="printSection()">Print<i class="fas fa-print" style="color: black; margin-left:5px;"></i></a>
					</div>
				</div>
			</div>

			<div class="card ">
				<div class="card-body">
					<div class="card-title" style="border-bottom: 1px solid black;">
						<h3>Complainant Information</h3>
					</div>
					<div class="justify-content-center table-responsive">
						<table class="infoTable" style="width:80%; margin-left: auto; margin-right: auto;">
							<tr>
								<th class="infoHead">Id:</th>
								<td class="infoDetail"><?php echo $complainant['user_id']; ?></td>
								<th class="infoHead">Name:</th>
								<td class="infoDetail"><?php echo $complainant['name']; ?></td>
							</tr>
							<tr>
								<th class="infoHead">Contact #:</th>
								<td class="infoDetail"><?php echo $complainant['phone_number']; ?></td>
								<th class="infoHead">Email:</th>
								<td class="infoDetail"><?php echo $complainant['email']; ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="card-title " style="border-bottom: 1px solid black;">
								<h3><?php echo $subject; ?> <?php if ($status == 3) {
										echo "<p class='p-2 label label-lg label-success'>Closed</p>";
									} else if ($status == 2) {
										echo "<p class='p-2 label label-lg label-primary'>Product Requested</p>";
									} else if ($status == 1) {
										echo "<p class='p-2 label label-lg label-info'>In-Process</p>";
									} else {
										echo "<p class='p-2 label label-lg label-warning'>Pending</p>";
									} ?></h3>
							</div>
							<div class="card-subtitle ">
								Complaint Date: <?php echo date('d M Y | h:i A', strtotime($complaint_date)); ?>
							</div>
							<?php $dateString = date('Y-m-d', strtotime($expected_completion_time));
							if ($dateString[0] !== "-") { ?>
								<div style="color: <?php echo $expected_completion_time < time() ? "limegreen" : "red"; ?>" class="card-subtitle ">
									Expected Due:
									<?php echo date('d M Y | h:i A', strtotime($expected_completion_time)); ?>
								</div>
							<?php } ?>
							<div id="depts" class="form-group" style="text-align: justify; padding: 0px 10px 0px; margin-bottom: 16px;">
								<label>Department: </label>
								<input type="text" disabled value="<?php echo $dept_name; ?>">
								
							</div>
							<p class="card-text " style="text-align: justify; padding: 0px 10px 0px; font-size:1rem; margin-bottom: 16px;">
								<?php echo $description; ?>
							</p>
							
						</div>
					</div>
				</div>
			</div>
	
		</div>
	</div>
<?php } ?>

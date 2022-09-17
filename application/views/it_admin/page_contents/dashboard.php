<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Dashboard</h4>
			</div>
		</div>

		<div class="row">
			<div class="m-b-20 m-l-20 col-md-8">
				<button onclick="toggleView()" class="btn btn-md btn-info"><i class="fas fa-tasks m-r-5"></i>Auto Handle Complaints</button>
				<!-- <button class="btn btn-info text-right">Manual</button> -->
				
				<!-- <a data-toggle='collapse' href='#collapseExample' id='#collapseExample' class='text-center btn btn-default'>Read More</a> -->
			</div>
			<div class="col-md-3">
				<h3 align="right">Status : <?php if($getAutoStat['status']==0) {echo('<span class="label label-success p-2">Manual');} else{echo('<span class="label label-warning p-2">Auto');}?> </span></h3>
			</div>
		</div>


		<div class="card" id="complaintFilter" style="display: none;">
			<div class="card-body">
				<form onsubmit="setCheckBox()" action="<?php echo site_url('ITAdmin/automate'); ?>" method="get">
					<div class="form-body">
						<h4 class="card-title">Automatically Resolve Compliants</h4>
						<hr>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="checkboxx" name="checkboxx" <?php if($getAutoStat['status']==1){echo('checked');} ?>>
							<label for="checkboxx">Automate</label>
						</div>
					</div>
					<div align="right" class="form-actions">
						<button type="submit" class="btn btn-info">Save</button>
					</div>
				</form>
			</div>
		</div>


		<a href="<?php echo site_url('ITAdmin/complaints'); ?>">
			<div class="card-group">
				<div class="card">
					<div class="card-body">
						<div class="d-flex no-block align-items-center">
							<div>
								<h3><i class="icon-doc"></i></h3>
								<p class="text-muted">All Complaints</p>
							</div>
							<div class="ml-auto">
								<h2 class="counter text-primary"><?php echo $allComplaints; ?></h2>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="d-flex no-block align-items-center">
							<div>
								<h3><i class="icon-doc"></i></h3>
								<p class="text-muted">Pending Complaints</p>
							</div>
							<div class="ml-auto">
								<h2 class="counter text-primary"><?php echo $allPendingComplaints; ?></h2>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="d-flex no-block align-items-center">
							<div>
								<h3><i class="icon-doc"></i></h3>
								<p class="text-muted">In-Process Complaints</p>
							</div>
							<div class="ml-auto">
								<h2 class="counter text-primary"><?php echo $allInProcessComplaints; ?></h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</a>
		<a href="<?php echo site_url('ITAdmin/complaints'); ?>">
			<div class="card-group">
				<div class="card">
					<div class="card-body">
						<div class="d-flex no-block align-items-center">
							<div>
								<h3><i class="icon-doc"></i></h3>
								<p class="text-muted">Material Requested</p>
							</div>
							<div class="ml-auto">
								<h2 class="counter text-primary"><?php echo $allMaterialRequestedComplaints; ?></h2>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="d-flex no-block align-items-center">
							<div>
								<h3><i class="icon-doc"></i></h3>
								<p class="text-muted">Resolved Complaints</p>
							</div>
							<div class="ml-auto">
								<h2 class="counter text-primary"><?php echo $allResolvedComplaints; ?></h2>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="d-flex no-block align-items-center">
							<div>
								<h3><i class="icon-doc"></i></h3>
								<p class="text-muted">Rejected Complaints</p>
							</div>
							<div class="ml-auto">
								<h2 class="counter text-primary"><?php echo $allRejectedComplaints; ?></h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
</div>
<script>
	function setCheckBox()
	{
		$box=document.getElementById('checkboxx');
		if($box.checked == true)
		{
			$box.value=1;
		}
		else
		{
			$box.value=0;
		}
	}
</script>
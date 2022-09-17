<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Dashboard</h4>
			</div>
		</div>
		<a href="<?php echo site_url('AssetKeeper/availableInventory'); ?>">
			<div class="card-group">
				<div class="card">
					<div class="card-body">
						<div class="d-flex no-block align-items-center">
							<div>
								<h3><i class="icon-doc"></i></h3>
								<p class="text-muted">Inventory</p>
							</div>

							<div class="ml-auto">
								<h2 class="counter text-primary"><?php echo $allcount ?></h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
</div>

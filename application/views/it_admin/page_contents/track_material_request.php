<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Material ID# <?php echo $asset_id; ?></h4>
			</div>
		</div>
		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-body">
						<div class="card-title" style="border-bottom: 1px solid black;">
							<h3>Storeman Request Status</h3>
						</div>
						<div id="content" style="margin: 20px 0px;">
							<ul class="timeline">
								<?php foreach ($asset_timeline as $d) { ?>
									<li class="event" data-date="<?php echo date('d M Y | h:i A', strtotime($d->date)); ?>">
										<?php if ($d->status == 0) {
											$stats = "Pending";
										} else if ($d->status == 1) {
											$stats = "Issued";
										} else if ($d->status == 2) {
											$stats = "Not Available";
										} ?>
										<h3><?php echo $stats; ?></h3>
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<?php if (!empty($treasurer_timeline)) { ?>
				<div class="col-6">
					<div class="card">
						<div class="card-body">
							<div class="card-title" style="border-bottom: 1px solid black;">
								<h3>Treasurer Request Status</h3>
							</div>
							<div id="content" style="margin: 20px 0px;">
								<ul class="timeline">
									<?php foreach ($treasurer_timeline as $d) { ?>
										<li class="event" data-date="<?php echo date('d M Y | h:i A', strtotime($d->date)); ?>">
											<?php if ($d->status == 0) {
												$stats = "Pending";
											} else if ($d->status == 1) {
												$stats = "Approved";
											} else if ($d->status == 2) {
												$stats = "Rejected";
											} ?>
											<h3><?php echo $stats; ?></h3>
											<p><?php echo $d->remarks; ?></p>
										</li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php if (!empty($purchaser_timeline)) { ?>
			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-body">
							<div class="card-title" style="border-bottom: 1px solid black;">
								<h3>Purchaser Request Status</h3>
							</div>
							<div id="content" style="margin: 20px 0px;">
								<ul class="timeline">
									<?php foreach ($purchaser_timeline as $d) { ?>
										<li class="event" data-date="<?php echo date('d M Y | h:i A', strtotime($d->date)); ?>">
											<?php if ($d->status == 0) {
												$stats = "Pending";
											} else if ($d->status == 1) {
												$stats = "Issued";
											} else if ($d->status == 2) {
												$stats = "Not Available";
											} ?>
											<h3><?php echo $stats; ?></h3>
										</li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

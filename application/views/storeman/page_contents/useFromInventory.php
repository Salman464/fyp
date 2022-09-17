<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Utilize Asset</h4>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="card-title" style="border-bottom: 1px solid black;">
					<h3>Use item</h3>
				</div>
            <form action="<?php echo site_url('StoreMan/copyToIssued/'.$item['id']); ?>" method="post">
				<div class="row p-t-20">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Name</label>
							<input type="text" class="form-control"
								   value="<?php echo $item['name']; ?>" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="inputGroupSelect01">Complaint#</label></br>
							<select name="complaint_id" class="custom-select" id="inputGroupSelect01" required>
								<option selected value="">Select Complaint No...</option>
								<?php foreach ($complaints as $row): ?>
									<option class="form-control" value="<?php echo $row['complaint_id']; ?>"><?php echo $row['complaint_id'].'-'.$row['subject']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
				<div class="row p-t-20">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Enter utilized quantity</label>
							<input type="number" class="form-control" name='item_quantity'
								   value="<?php echo $item['quantity']; ?>" min='0' max="<?php echo $item['quantity']; ?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Used for</label>
							<input type="text" class="form-control" name="item_useDesc"
								   placeholder="give berief description about usage..." required>
						</div>
					</div>
				</div>
				<div class="row p-t-20">
					
				</div>

				
				<div class="form-actions text-right">
					<button type="submit" name="submit" class="btn btn-danger"><i class="fa fa-trash" style="margin-right: 10px;"></i>Utilize
					</button>
                    <a href="<?php echo site_url('StoreMan/availableInventory') ?>" class="btn btn-secondary">Cancel</a>
				</div>
			</div>

            </div>
		</div>
		
	</div>
</div>

<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Update Item</h4>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="card-title" style="border-bottom: 1px solid black;">
					<h3>Update Item</h3>
				</div>
            <form action="<?php echo site_url('StoreMan/updateItem/'.$item['id']); ?>" method="post">
				<div class="row p-t-20">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Id</label>
							<input type="number" class="form-control"
								   value="<?php echo $item['id']; ?>" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Available Quantity</label>
							<input type="number" class="form-control" name="item_quantity"
								   value="<?php echo $item['quantity']; ?>" readonly required>
						</div>
					</div>
				</div>
				<div class="row p-t-20">
				<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Name</label>
							<input type="text" class="form-control" name="item_name"
								   value="<?php echo $item['name']; ?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Description</label>
							<input type="textarea" class="form-control" name="item_description"
								   value="<?php echo $item['description']; ?>" required>
						</div>
					</div>
				</div>
				
				<div class="form-actions text-right">
					<button type="submit" name="submit" class="btn btn-success">Update
					</button>
                    <a href="<?php echo site_url('StoreMan/availableInventory') ?>" class="btn btn-secondary">Cancel</a>
				</div>
			</div>

            </div>
		</div>
		
	</div>
</div>

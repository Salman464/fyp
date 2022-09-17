<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor"><?php echo $title ?></h4>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="card-title" style="border-bottom: 1px solid black;">
					<h3>Item details</h3>
				</div>
                <form action="#" method="#">
                    <div class="row p-t-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">#ID</label>
                                <input type="number" class="form-control"
                                    value="<?php echo $item['id']; ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Item Name</label>
                                <input type="text" class="form-control"
                                    value="<?php echo $item['name']; ?>" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row p-t-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Usage</label>
                                <input type="textarea" class="form-control"
                                    value="<?php echo $item['usedin']; ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Issued Quantity</label>
                                <input type="number" class="form-control"
                                    value="<?php echo $item['usedquantity']; ?>" min='0' disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row p-t-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Issued on</label>
                                <input type="text" class="form-control"
                                    value="<?php echo $item['issued_at']; ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Item Description</label>
                                <input type="textarea" class="form-control"
                                    value="<?php echo $item['description']; ?>" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row p-t-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Available Quantity in Inventory</label>
                                <input type="textarea" class="form-control"
                                    value="<?php echo $item['quantity']; ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Added to inventory on</label>
                                <input type="text" class="form-control"
                                    value="<?php echo $item['created_at']; ?>" disabled>
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-actions text-right">
                        <a href="<?php echo site_url('AssetKeeper/issuedItems') ?>" class="btn btn-secondary">Back</a>
                    </div>
                </form>
			</div>

            </div>
		</div>
		
	</div>
</div>

<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Available Inventory<?php  ?></h4>
			</div>
			<div class="col-md-7 align-self-center text-right">
				<div class="d-flex justify-content-end align-items-center">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#restore" style="margin-right: 5px;"><i class="fa fa-trash-undo" style="margin-right: 5px;"></i>Recently Deleted</button>
					<button type="button" class="btn btn-info" data-toggle="modal" data-target="#add-Item"><i class="fa fa-plus-circle" style="margin-right: 5px;"></i> Add New Item
					</button>
				</div>
			</div>
		</div>
		<div id="add-Item" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<form role="form" action="<?php echo site_url('StoreMan/addNewItem'); ?>" method="post"  class="form-horizontal form-material">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Enter Item's Details</h4>
							<button type="reset" value="reset" class="close" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times-circle" style="margin-right: 5px;"></i></button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<div class="col-md-12 m-b-20">
									<input type="text" onKeyPress="if(this.value.length>=50) return false;" class="form-control" name="item_name" placeholder="Enter Name..." required>
								</div>
								<div class="col-md-12 m-b-20">
									<input type="text" onKeyPress="if(this.value.length>=255) return false;" class="form-control" name="item_description" placeholder="Enter Item description..." required>
								</div>
								<div class="col-md-12 m-b-20">
									<input type="number" pattern="\d*" onKeyPress="if(this.value.length>=10) return false;" class="form-control" name="item_quantity" placeholder="Enter Quantity..." required>
								</div>
								<div class="col-md-12 m-b-20">
									<input type="text" onKeyPress="if(this.value.length>=49) return false;" class="form-control" name="item_remark" placeholder="Enter Comment/Remarks..." required>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn waves-effect waves-light btn-rounded btn-info",name="submit",value="submit">
								Add
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

		<!--Update quantity Fade modal-->
		<div id="update-quantity" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<form role="form" action="<?php echo site_url('StoreMan/updateQuantity/'); ?>" method="get" class="form-horizontal form-material">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Enter quantity to add</h4>
							<button type="reset" value="reset" class="close" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times-circle" style="margin-right: 5px;"></i></button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<div class="col-md-12 m-b-20">
									<input type="hidden" name="iid" id="iid">
									<input type="number" onKeyPress="if(this.value.length>=7) return false;" class="form-control" id="update_quantity" name="update_quantity" placeholder="Enter quantity you want to add.." required>
									<input type="text" onKeyPress="if(this.value.length>=49) return false;" class="form-control" id="remark" name="remark" placeholder="Enter a comment...(optional)">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn waves-effect waves-light btn-rounded btn-info",name="submit",value="submit">Update</button>
							<button type="reset" value="reset" class="btn waves-effect waves-light btn-rounded btn-secondary" data-dismiss="modal">Cancel</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!--End quantity udate modal-->

		<!--Delete confirmation modal-->
		<div class="modal fade" id="delConfirmModal" tabindex="-1" role="dialog" aria-labelledby="Delete item" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><b>Delete item</b></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
					<form role="form" action="<?php echo site_url('StoreMan/deleteEntire/'); ?>" method="post" class="form-horizontal form-material">
						<div class="modal-body">	
								<div class="col-md-12 m-b-20">
									<p>Are you sure to Delete?</p>
									<input type="hidden" name="did" id="did">
									<input type="text" class="form-control" id="dname" name="dname" disabled>
								</div>
							<p class="col center"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="margin-right: 5px;"></i>Item will be deleted!</p>							
						</div>
						<div class="modal-footer">
							<button type="submit" id="submit" name="submit" class="btn btn-primary">Delete</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!--Restore Model-->
		<div id="restore" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-lg">

					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Recently Deleted Items</h4>
							<button type="reset" value="reset" class="close" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times-circle" style="margin-right: 5px;"></i></button>
						</div>
						<div class="modal-body">
							<table id="restoreItemTable" class="table table-bordered table-striped" data-toggle="table" data-search="true" data-show-columns="true">
								<thead>
									<tr>
										<th>Deleted On</th>
										<th>Item ID#</th>
										<th>Item Name</th>
										<th>Description</th>
										<th>In stock</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($restoreable as $row){ ?>
									<tr>
										<td><?php echo $row['created_at']; ?></td>
										<td><b><?php echo $row['id']; ?></b></td>
										<td><?php echo substr($row['name'],0,15); ?></td>
										<td><?php echo substr($row['description'],0,15); ?></td>
										<td><?php echo $row['quantity']; ?></td>
										<td><a class="btn btn-success btn-sm" href="<?php echo site_url('StoreMan/restoreDeleted/'.$row['id']); ?>"><i class="fa fa-trash-undo" style="margin-right: 3px;"></i>Restore</a></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				
			</div>
		</div>


		<div class="card">
			<div class="card-body">
				<div class="vtabs customvtab">
					<div class="tab-content">
						<div class="tab-pane active" id="all" role="tabpanel">
							<div class="p-20">
								<div class="table-responsive">
									<div class="m-b-10">
										<input type="text" class="form-control-plaintext" id="myInput" onkeyup="searchItem()" placeholder="Search here....">
									</div>
									<table id="myTable3" class="table table-bordered table-striped" data-toggle="table" data-search="true" data-show-columns="true">
										<thead>
										<tr>
										<tr>
											<th>Item ID</th>
											<th>Item Name</th>
											<th>Description</th>
											<th>In stock</th>
											<th>Added on</th>
											<th>Actions</th>
										</tr>
										</tr>
										</thead>
										<tbody>
										<?php foreach (array_reverse($items) as $row){ ?>
											<tr>
												
													<td><b><?php echo $row['id']; ?></b></td>
													<td><?php echo substr($row['name'],0,12); ?></td>
													<td><?php echo substr($row['description'],0,49); ?></td>
													<td><?php echo $row['quantity']; ?></td>
													<td><?php echo $row['created_at']; ?></td>
													<td>
														<div class="btn-group">
															<a type="button" class="btn btn-info" href="<?php echo site_url('StoreMan/deleteItem/'.$row['id']); ?>">Utilize item</a>
															<button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																<span class="sr-only">Toggle Dropdown</span>
															</button>
															<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
																<button class="dropdown-item updateQbtn" data-toggle="modal" data-target="#update-quantity"><i class="fa fa-refresh" style="margin-right: 5px;"></i>update quantity</button>
																<a class="dropdown-item" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Details" aria-describedby="tooltip392481" href="<?php echo site_url('StoreMan/itemDetailsWithHistory/'.$row['id']); ?>" style="margin:3px;"><i class="fa fa-info" style="margin-right: 5px;"></i>More info</a>
																<div class="dropdown-divider"></div>
																<a class="dropdown-item" href="<?php echo site_url('StoreMan/editItem/'.$row['id']); ?>"><i class="fa fa-edit" style="margin-right: 5px;"></i> Edit</a>
																<button class="dropdown-item btn btn-danger delBtn" data-toggle="modal" data-target="#delConfirmModal"><i class="fa fa-trash" style="margin-right: 5px;"></i>Delete item</button>
															</div>
														</div>
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
			</div>
		</div>
	</div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

<script>
     $(document).ready(function () {
       $('.updateQbtn').on('click', function () {
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();
            console.log(data);
		$('#iid').val(data[0]);	
        });
    });
</script>
<script>
	$(document).ready(function () {
       $('.delBtn').on('click', function () {
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();
            console.log(data);
		$('#did').val(data[0]);
		$('#dname').val(data[0]+'-'+data[1]);	
        });
    });
</script>
<script>
function searchItem() {
	var input, filter, table, tr, td, i, txtValue;
	input = document.getElementById("myInput");
	filter = input.value.toUpperCase();
	table = document.getElementById("myTable3");
	tr = table.getElementsByTagName("tr");
	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[1];
		if (td) {
		txtValue = td.textContent || td.innerText;
		if (txtValue.toUpperCase().indexOf(filter) > -1) {
			tr[i].style.display = "";
		} else {
			tr[i].style.display = "none";
		}
		}       
	}
}
</script>
<div class="page-wrapper printArea">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor"><?php echo $title,' Complaints';  ?>
                <?php
                    //print_r($complaints);
                ?>
                </h4>
			</div>
            <div class="col-md-7 align-self-center text-right">
				<div class="d-flex justify-content-end align-items-center">
					<a style="font-size: 18px;" href="javascript:void(0)" onclick="printSection()">Print<i class="fas fa-print" style="color: black; margin-left:5px;"></i></a>
				</div>
			</div>
		</div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive ">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Complaint ID#</th>
                            <th>Complainant</th>
                            <th>Complaint Date</th>
                            <th>Subject</th>
                            <th>Current Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($complaints as $row) { ?>
                            <tr>
                                <td><b><a href="<?php echo site_url('ITAdmin/view_complaint/' . $row['complaint_id']); ?>"><?php echo $row['complaint_id']; ?></a></b></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo date('d M Y', strtotime($row['complaint_date'])); ?></td>
                                <td><?php echo $row['subject']; ?></td>
                                <?php if ($row['status'] == 0) {
                                    $stats = "Pending";
                                    $color = "warning";
                                } else if ($row['status'] == 1) {
                                    $stats = "In-Process";
                                    $color = "info";
                                } else if ($row['status'] == 2) {
                                    $stats = "Product Requested";
                                    $color = "primary";
                                } else {
                                    $stats = "Closed";
                                    $color = "success";
                                } ?>
                                <td><span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span></td>
                                <td><a href="<?php echo site_url('ITAdmin/view_complaint/'. $row['complaint_id']); ?>"><span class="label label-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Complaint</span></a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
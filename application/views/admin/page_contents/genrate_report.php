<div class="page-wrapper printArea">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h4 class="text-themecolor">Complaints Report</h4>
			</div>
            <div class="col-md-7 align-self-center text-right">
				<div class="d-flex justify-content-end align-items-center">
					<a style="font-size: 18px; margin-right:10px;" href="javascript:void(0)" onclick="printSection()">Print<i class="fas fa-print" style="color: black; margin-left:5px;"></i></a>
                    </a>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header text-center"><?php echo $duration['start_date']; ?> - <?php echo $duration['end_date']; ?></h5>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $days ?>-Days Complaints Report</h5>
                        
                        <?php
                            foreach ($dailyComplaints as $key => $value)
                            {
                                // echo "<br>";
                                //echo count($value);
                        ?>
                        <hr>
                        <h5 class="card-title text-center"><?php echo $key; ?></h5>
                        <hr>
                        <table id="" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Complaint ID#</th>
                                    <th>Complainant</th>
                                    <th>Technician</th>
                                    <th>Department</th>
                                    <th>Subject</th>
                                    <th>Current Status</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php foreach ($value as $row) { ?>
                                    <tr>
                                        <td>
                                            <b><a href="<?php echo site_url('Admin/view_complaint/' . $row->complaint_id); ?>"><?php echo $row->complaint_id; ?></a></b>
                                        </td>
                                        <td><?php echo $row->complainant; ?></td>
                                        <td><?php echo $row->Technician; ?></td>
                                        <td><?php echo $row->department; ?></td>
                                        <td><?php echo $row->subject; ?></td>
                                        <?php if ($row->status == 0) {
                                            $stats = "Pending";
                                            $color = "warning";
                                        } else if ($row->status == 1) {
                                            $stats = "In-Process";
                                            $color = "info";
                                        } else if ($row->status == 2) {
                                            $stats = "Product Requested";
                                            $color = "primary";
                                        } else {
                                            $stats = "Closed";
                                            $color = "success";
                                        } ?>
                                        <td>
                                            <span class="label label-<?php echo $color; ?>"><?php echo $stats; ?></span>
                                        </td>
                                        <!-- <td>
                                            <a href="<?php //echo site_url('Admin/view_complaint/' . $row->complaint_id); ?>"><span class="label label-danger"><i class="fa fa-pencil" style="margin-right: 10px;"></i>View Complaint</span></a>
                                        </td> -->
                                    </tr>
                                <?php } ?>
                            </tbody>  
                        </table>
                        <?php } ?>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
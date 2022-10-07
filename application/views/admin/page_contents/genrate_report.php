
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
                    <h5 class="card-header text-right"><?php echo $duration['start_date']; ?> - <?php echo $duration['end_date']; ?></h5>
                    <div class="card-body">
                        <h5 class="card-title text-center">Hey</h5>
                        
                        <?php
                            foreach ($dailyComplaints as $key => $value)
                            {
                                print_r($key);
                                echo "<br>";
                                //echo count($value);
                                foreach ($value as $complaint) 
                                {
                        ?>
                                    print_r($complaint);
                                    echo "<hr>";
                        <?php   }
                                echo "<br>";
                            }
                        ?>
                        
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
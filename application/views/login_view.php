<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/admin/assets/images/favicon.png">
	<title>Login</title>

	<link href="<?php echo base_url(); ?>assets/admin/dist/css/pages/login-register-lock.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="<?php echo base_url(); ?>assets/admin/dist/css/style.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/admin/node_modules/morrisjs/morris.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/admin/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/admin/dist/css/style.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/admin/dist/css/pages/dashboard1.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/admin/dist/css/pages/timeline-vertical-horizontal.css" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link href="<?php echo base_url(); ?>assets/admin/node_modules/footable/css/footable.bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">

	<link href="<?php echo base_url(); ?>assets/admin/dist/css/custom.css" rel="stylesheet">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

</head>

<body class="skin-default card-no-border">
<div class="preloader">
	<div class="loader">
		<div class="loader__figure"></div>
		<p class="loader__label">GIFT CMS</p>
	</div>
</div>
<section id="wrapper">
	<div class="login-register">
		<div class="login-box card">
			<div class="card">
				<!-- <?php if ($this->session->flashdata('message')) { ?>
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
						</button><?php //echo $this->session->flashdata('message'); ?>
					</div>
				<?php } ?> -->
				<?php if ($this->session->flashdata('success')) { ?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
						</button><?php echo $this->session->flashdata('success'); ?>
					</div>
				<?php } ?>
				<div class="card-body">
					<form id="loginform" class="form-horizontal needs-validation" novalidate method="POST" action="<?php echo site_url('Login/auth'); ?>">
						<div class="card-title" style="border-bottom: 1px solid black; margin-bottom: 30px;">
							<h3>Sign In</h3>
						</div>
						<div class="form-group ">
							<div class="col-xs-12">
								<input type="number" pattern="\d*" onKeyPress="if(this.value.length==15) return false;" class="form-control" name="id" id="validationCustom01" placeholder="ID" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12">
								<input type="password" maxlength="20" name="password" placeholder="Password" class="form-control" id="validationCustom02" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<div class="d-flex no-block align-items-center">
									<div class="ml-auto">
										<a href="javascript:void(0)" id="to-recover" class="text-muted"><i class="fas fa-lock m-r-5"></i> Forgot password?</a>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center">
							<div class="col-xs-12 p-b-20">
								<button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Log In</button>
							</div>
						</div>
						<div class="form-group m-b-0">
							<div class="col-sm-12 text-center">
								Don't have an account? <a href="<?php echo site_url('Login/regView'); ?>" class="text-info m-l-5"><b>Sign Up</b></a>
							</div>
						</div>
					</form>
					<form class="form-horizontal" id="recoverform" method="POST" action="<?php echo site_url('Login/reset'); ?>">
						<div class="form-group ">
							<div class="col-xs-12">
								<h3>Recover Password</h3>
								<p class="text-muted">Enter your Email and instructions will be sent to you! </p>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12">
								<input type="email" name="email" placeholder="Email" class="form-control" id="validationCustom02" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
						</div>
						<div class="form-group text-center">
							<div class="col-xs-12 p-b-20">
								<a href="javascript:void(0)" id="verify">
									<button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Send Reset
										Link
									</button>
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<script src="<?php echo base_url(); ?>assets/admin/node_modules/jquery/jquery-3.2.1.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="<?php echo base_url(); ?>assets/admin/node_modules/popper/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<!--Custom JavaScript -->
<script type="text/javascript">
	$(function() {
		$(".preloader").fadeOut();
	});
	$(function() {
		$('[data-toggle="tooltip"]').tooltip()
	});
	// ==============================================================
	// Login and Recover Password
	// ==============================================================
	$('#to-recover').on("click", function() {
		$("#loginform").slideUp();
		$("#recoverform").fadeIn();
	});
</script>

<script>
	// Example starter JavaScript for disabling form submissions if there are invalid fields
	(function() {
		'use strict';
		window.addEventListener('load', function() {
			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.getElementsByClassName('needs-validation');
			// Loop over them and prevent submission
			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			});
		}, false);
	})();
</script>

</body>

</html>

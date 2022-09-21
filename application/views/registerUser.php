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
	<title>Sign Up</title>

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
<section id="wrapper" class="fluid-wrapper">
	<div class="login-register" style="position : absolute;">
		<div class="login-box">

			<div class="card">
				<div class="col-md-12 col-sm-12">
					<?php if ($this->session->flashdata('errors')) { ?>
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo validation_errors(); ?>
						</div>
					<?php } ?>
					<div class="card-body">
						<form class="form-horizontal needs-validation" onsubmit="return validationSignUp()" role="form" novalidate method="POST" action="<?php echo site_url('Login/createUser'); ?>">
							<div class="card-title" style="border-bottom: 1px solid black; margin-bottom: 30px;">
								<h3>Create an Account</h3>
							</div>
							<div class="form-group ">
								<div class="col-xs-12">
									<input type="number" pattern="\d*" onKeyPress="if(this.value.length==15) return false;" class="form-control" name="id" id="validationCustom01" placeholder="ID" required>
									<p id="idLenErr" style="display: none; color: red;">Invalid GIFT Id length (must be <=9)!</p>
									<div class="valid-feedback">
										Looks good!
									</div>
								</div>
							</div>
							<div class="form-group ">
								<div class="col-xs-12">
									<input type="text" class="form-control" name="username" id="validationCustom02" placeholder="Name" required>
									<div class="valid-feedback">
										Looks good!
									</div>
								</div>
							</div>
							<div class="form-group ">
								<div class="col-xs-12">
									<input type="number" pattern="\d*" onKeyPress="if(this.value.length==15) return false;" class="form-control" name="phone_number" id="validationCustom03" placeholder="Phone Number" required>
									<div class="valid-feedback">
										Looks good!
									</div>
								</div>
							</div>
							<div class="form-group ">
								<div class="col-xs-12">
									<input type="number" pattern="\d*" onKeyPress="if(this.value.length==4) return false;" class="form-control" name="ext" id="validationCustom03" placeholder="Extension Number" required>
									
									<div class="valid-feedback">
										Looks good!
									</div>
								</div>
							</div>
							<div class="form-group ">
								<div class="col-xs-12">
									<input type="email" class="form-control" name="email" id="mail" placeholder="Email Address" required>
									<p id="mailErr1" style="display: none; color: red;">you must sign up with your gift email ends with @gift.edu.pk</p>
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-12">
									<input type="password" maxlength="20" name="password" placeholder="Password" class="form-control" id="pass" required>
									<p id="passLengthErr" style="display: none; color: red;">Password Length must be greater than 8 and less than 20 characters</p>
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-12">
									<input type="password" maxlength="20" name="confirmpassword" placeholder="Confirm Password" class="form-control" id="cpass" required>
									<p id="cpassErr" style="display: none; color: red;">Password doesn't match!</p>
									<p id="cpassLengthErr" style="display: none; color: red;">Password Length must be greater than 8 and less than 20 characters</p>
								</div>
							</div>
							<div class="form-group text-center">
								<div class="col-xs-12 p-b-20">
									<button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Sign Up
									</button>
								</div>
							</div>
							<div class="form-group m-b-0">
								<div class="col-sm-12 text-center">
									Already have an account<a href="<?php echo site_url('Login/index'); ?>" class="text-info m-l-5"><b>Sign
											In</b></a> now
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<footer>
			<p>Old school</p>
		</footer>
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
</script>

<script>
	function validationSignUp() {

		var isValid = true;

		let id = document.getElementById('validationCustom01').value;
		let name = document.getElementById('validationCustom02').value;
		let phone = document.getElementById('validationCustom03').value;
		let email = document.getElementById('mail').value;
		let pass = document.getElementById('pass').value;
		let cpass = document.getElementById('cpass').value;

		let idLenErr = document.getElementById('idLenErr');
		let mailErr1 = document.getElementById('mailErr1');
		let mailErr2 = document.getElementById('mailErr2');
		let cpassErr = document.getElementById('cpassErr');
		let passLengthErr = document.getElementById('passLengthErr');
		let cpassLengthErr = document.getElementById('cpassLengthErr');


		if (!email.endsWith("@gift.edu.pk")) {
			isValid = false;
			mailErr1.style.display = "block";
		}idLenErr

		if (id > 2147483647) {
			isValid = false;
			idLenErr.style.display = "block";
		}

		if (pass.length < 8) {
			isValid = false;
			passLengthErr.style.display = "block";
		}

		if (cpass.length < 8) {
			isValid = false;
			cpassLengthErr.style.display = "block";
		}

		if (pass != cpass) {
			isValid = false;
			cpassErr.style.display = "block";
		}

		return isValid;

	}
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

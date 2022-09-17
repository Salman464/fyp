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
	<title>Reset Password</title>

	<link href="<?php echo base_url(); ?>assets/admin/dist/css/pages/login-register-lock.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="<?php echo base_url(); ?>assets/admin/dist/css/style.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/admin/node_modules/morrisjs/morris.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/admin/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/admin/dist/css/style.min.css" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link href="<?php echo base_url(); ?>assets/admin/node_modules/footable/css/footable.bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">

	<link href="<?php echo base_url(); ?>assets/admin/dist/css/custom.css" rel="stylesheet">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

</head>

<body class="skin-default card-no-border">
<section id="wrapper">
	<div class="login-register">
		<div class="login-box card">
			<div class="card">
				<?php if ($this->session->flashdata('message')) { ?>
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
						</button><?php echo $this->session->flashdata('message'); ?>
					</div>
				<?php } ?>
				<div class="card-body">
					<form onsubmit="return validatePass()" class="form-horizontal" id="verifyForm" method="POST" action="<?php echo site_url('Login/changePassword'); ?>">
						<div class="form-group ">
							<div class="col-xs-12">
								<h3>Recover Password</h3>
								<p class="text-muted">Enter new Password!</p>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12">
								<input type="password" maxlength="20" name="password" placeholder="Password" class="form-control" id="pass" required>
								<p id="passLengthErr" style="display: none; color: red;">Password Length must be
									greater than 8 and less than 20 characters</p>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12">
								<input type="password" maxlength="20" name="cpassword" placeholder="Confirm Password" class="form-control" id="cpass" required>
								<p id="cpassLengthErr" style="display: none; color: red;">Password Length must be
									greater than 8 and less than 20 characters</p>
								<p id="cpassErr" style="display: none; color: red;">Password doesn't match!</p>
							</div>
						</div>
						<div class="form-group text-center">
							<div class="col-xs-12 p-b-20">
								<a href="javascript:void(0)" id="verify">
									<button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Reset
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
<script src="<?php echo base_url(); ?>assets/admin/node_modules/popper/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

<script>
	(function() {
		'use strict';
		window.addEventListener('load', function() {
			var forms = document.getElementsByClassName('needs-validation');
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

<script>
	function validatePass() {

		var isValid = true;

		let pass = document.getElementById('pass').value;
		let cpass = document.getElementById('cpass').value;

		let passLengthErr = document.getElementById('passLengthErr');
		let cpassLengthErr = document.getElementById('cpassLengthErr');
		let cpassMatchErr = document.getElementById('cpassErr');

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
			cpassMatchErr.style.display = "block";
		}
		return isValid;
	}

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

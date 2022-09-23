<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/admin/images/favicon.png">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/icons/font-awesome/css/fontawesome.min.css">
	<title><?php echo $title; ?></title>
	<link href="<?php echo base_url(); ?>assets/admin/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
	<link href="<?php echo base_url(); ?>assets/admin/dist/css/style.min.css" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link href="<?php echo base_url(); ?>assets/admin/dist/css/custom.css" rel="stylesheet">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body class="skin-blue fixed-layout">
<div class="preloader">
	<div class="loader">
		<div class="loader__figure"></div>
		<p class="loader__label">GIFT CMS</p>
	</div>
</div>
<div id="main-wrapper">
	<header class="topbar">
		<nav class="navbar top-navbar navbar-expand-md navbar-dark">
			<!-- ============================================================== -->
			<!-- Logo -->
			<!-- ============================================================== -->
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo site_url('technician/index'); ?>">
					<!-- Logo icon -->
					<b>
						<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
						<!-- Dark Logo icon -->
						<img src="<?php echo base_url(); ?>assets/admin/images/logo-icon.png" alt="homepage" class="dark-logo" />
						<!-- Light Logo icon -->
						<img src="<?php echo base_url(); ?>assets/admin/images/logo-light-icon.png" alt="homepage" class="light-logo" />
					</b>
					<!--End Logo icon -->
					<!-- Logo text -->
					<span>
                            <!-- dark Logo text -->
                            <img src="<?php echo base_url(); ?>assets/admin/images/logo-text.png" alt="homepage" class="dark-logo" />
						<!-- Light Logo text -->
                            <img src="<?php echo base_url(); ?>assets/admin/images/logo-light-text.png" class="light-logo" alt="homepage" />
                        </span>
				</a>
			</div>
			<div class="navbar-collapse">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
					<li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
				</ul>
				<ul class="navbar-nav my-lg-0">
					<li class="nav-item dropdown u-pro">
						<a class="nav-link dropdown-toggle waves-effect waves-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="hidden-md-down"><?php echo $this->session->userdata('name'); ?> &nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></span> </a>
						<div class="dropdown-menu dropdown-menu-right animated flipInY">
							<a href="<?php echo site_url('technician/profile'); ?>" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
							<div class="dropdown-divider"></div>
							<a href="<?php echo site_url('technician/change_password'); ?>" class="dropdown-item"><i class="ti-lock"></i> Change Password</a>
							<div class="dropdown-divider"></div>
							<a href="<?php echo site_url('Login/logout'); ?>" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
						</div>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<aside class="left-sidebar">
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
				<div class="dropdown-divider"></div>
				<li><a href="<?php echo site_url('technician/index'); ?>" aria-expanded="false"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a></li>
				<div class="dropdown-divider"></div>
				<div class="dropdown-divider"></div>
				<li><a href="<?php echo site_url('technician/tasks_performed'); ?>" aria-expanded="false"><i class="icon-note"></i><span class="hide-menu">Tasks Performed</span></a></li>
				<div class="dropdown-divider"></div>
			</ul>
		</nav>
	</aside>

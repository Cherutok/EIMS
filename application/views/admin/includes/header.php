<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="Employee Management System">
	<title>Employee Management System</title>

	<link rel="stylesheet" href="<?php echo base_url();?>/public/css/bootstrap.min.css" type="text/css"
		media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>/public/css/animate.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>/public/css/styles.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>/public/css/datatables.min.css" type="text/css"
		media="screen" />

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://use.fontawesome.com/releases/v5.11.1/js/all.js"></script>
	<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
	</script>
</head>

<body>
	<div class="main-wrapper">
		<div class="header">
			<div class="header-left">
				<a href="<?php echo base_url(); ?>" class="logo text-primary font-weight-bolder text-monospace">
					EMS
				</a>
			</div>

			<a id="toggle_btn" href="javascript:void(0);">
				<span class="bar-icon">
					<span></span>
					<span></span>
					<span></span>
				</span>
			</a>

			<a id="mobile_btn" class="mobile_btn" href="#sidebar">
				<i class="fa fa-bars"></i>
			</a>

			<ul class="nav user-menu">
				<li class="nav-item">
					<div class="top-nav-search fa-dashboard p-3">
						Administrator
					</div>
				</li>

				<li class="nav-item dropdown has-arrow main-drop">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<span class="status online"></span>
						<span><?php echo ucfirst($this->session->userdata('username')); ?></span>
					</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href=" <?php echo base_url();?>Administrators/logout"><i
								class="fas fa-power-off text-danger"></i> Logout</a>
					</div>
				</li>
			</ul>
			<!-- /Header Menu -->

			<!-- Mobile Menu -->
			<div class="dropdown mobile-user-menu">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
						class="fa fa-ellipsis-v"></i></a>
				<div class="dropdown-menu dropdown-menu-right">
					<a class="dropdown-item" href=" <?php echo base_url();?>Administrators/logout"><i
							class="fas fa-power-off text-danger"></i> Logout</a>
				</div>
			</div>
		</div>

		<!-- Sidebar -->
		<div class="sidebar m-2 bg-inverse-warning rounded" id="sidebar">
			<div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					<ul>
						<li class="submenu">
							<a onclick='location.href="<?php echo base_url(); ?>Administrators"' style="cursor:pointer">
								<i class="fas fa-home"></i>
								<span> Dashboard</span>
							</a>

						</li>
						<li class="submenu">
							<a onclick="location.href='<?php echo site_url("/Administrators/myprofile/".$this->session->userdata("username"));?>'"
								style="cursor:pointer;">
								<i class="fa fa-user-shield"></i>
								<span> Profile </span>
							</a>
						</li>


						<li class="menu-title">
							<span> </span>
						</li>
						<li class="submenu">
							<a href="">
								<i class="fas fa-user-tie"></i>
								<span>Clients</span>
								<i class="menu-arrow fas fa-caret-right"></i>
							</a>
							<ul style="display: none;">
								<li>
									<a href="<?php echo site_url('/administrators/create_client'); ?>">
										<i class="fas fa-plus-circle"></i>
										<span>Add</span>
									</a>
								</li>

								<li>
									<a href="<?php echo site_url('/administrators/manage_clients'); ?>">
										<i class="fas fa-cogs"></i>
										<span>Manage</span></a>
								</li>
								<li class="menu-title">
							</ul>
						</li>

						<li class="menu-title">
							<span> </span>
						</li>
						<li class="submenu">
							<a href="">
								<i class="fas fa-user"></i>
								<span>Employees</span>
								<i class="menu-arrow fas fa-caret-right"></i>
							</a>
							<ul style="display: none;">
								<li>
									<a href="<?php echo site_url('/administrators/create_employee'); ?>">
										<i class="fas fa-plus-circle"></i>
										<span> Add</span> </a>
								</li>
								<li>
									<a href="<?php echo site_url('/administrators/manage_employees'); ?>">
										<i class="fas fa-cogs"></i>
										<span> Manage</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url(); ?>Administrators/manage_leave_requests">
										<i class="fas fa-sign-out-alt"></i>
										<span>On Leave</span>
									</a>
								</li>
							</ul>
						</li>

						<li class="menu-title">
							<span> </span>
						</li>
						<li class="submenu">
							<a href="">
								<i class="fas fa-user-cog"></i>
								<span> Project Managers </span>
								<i class="menu-arrow fas fa-caret-right"></i>
							</a>
							<ul style="display: none;">
								<li>
									<a href="<?php echo site_url('/administrators/create_manager'); ?>">
										<i class="fas fa-plus-circle"></i>
										<span> Add</span>
									</a>
								</li>
								<li>
									<a href="<?php echo site_url('/administrators/manage_employees'); ?>">
										<i class="fas fa-cogs"></i>
										<span> Manage</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url(); ?>Administrators/manage_leave_requests">
										<i class="fas fa-sign-out-alt"></i>
										<span>On Leave</span>
									</a>
								</li>
							</ul>
						</li>

						<li class="menu-title">
							<span> </span>
						</li>
						<li class="submenu">
							<a href="">
								<i class="fas fa-project-diagram"></i>
								<span>Projects</span>
								<i class="menu-arrow fas fa-caret-right"></i>
							</a>
							<ul style="display: none;">
								<li>
									<a href="<?php echo site_url('/administrators/create_project'); ?>">
										<i class="fas fa-plus-circle"></i>
										<span> Add</span> </a>
								</li>
								<li>
									<a href="<?php echo site_url('/administrators/manage_projects'); ?>">
										<i class="fas fa-cogs"></i>
										<span> Manage</span> </a>
								</li>
							</ul>
						</li>

						<li class="menu-title">
							<span> </span>
						</li>

						<li class="submenu">
							<a href="">
								<i class="fas fa-shield-alt"></i>
								<span> Password </span>
								<i class="menu-arrow fas fa-caret-right"></i>
							</a>
							<ul style="display: none;">
								<li>
									<a href="<?php echo site_url('/administrators/change_password'); ?>"> Change Password </a>
								</li>
							</ul>
						</li>
						<li class="menu-title">
							<span> </span>
						</li>
						<li class="submenu">
							<a href="">
								<i class="fas fa-sign-out-alt"></i>
								<span>Leave Settings</span>
								<i class="menu-arrow fas fa-caret-right"></i>
							</a>
							<ul style="display: none;">
								<li>
									<a href="<?php echo base_url(); ?>Administrators/add_leave_type">
										<i class="fas fa-plus"></i>
										<span>Add Type</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url(); ?>Administrators/manage_leave_requests">
										<i class="fas fa-cogs"></i>
										<span> Manage Applications</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="submenu" onclick="location.href='<?php echo base_url(); ?>Administrators/terminator'">
							<a href="">
								<i class="fas fa-user-alt-slash"></i>
								<span>Termination</span> 
							</a> 
						</li> 

					</ul>
				</div>
			</div>
		</div>

		<div class="page-wrapper">
			<div class="content container-fluid">

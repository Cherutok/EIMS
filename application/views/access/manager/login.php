<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Manager</title>
</head>

<body class="bg-dark"> 
	<div class="container">
		<div class="account-content">
			<div class="account-logo">
			<div class="row">
					<span class="col-12 text-warning text-monospace display-4">EMS</span>
					<span class="col-12 text-warning text-monospace font-weight-bolder font-italic">Employee Management
						System</span>
				</div>
			</div>

			<div class="mt-2 p-4 text-center">
					<a href="
				<?php 
				if($this->session->userdata('logged_in'))
				{
					echo site_url('/Administrators');
				}else{ 
					echo site_url('/Administrators/login');
				} ?>
				" class="btn btn-primary m-2">Administrator <i class="fas fa-user-shield"></i></a>
					<a href="
				<?php 
				if($this->session->userdata('logged_in'))
				{
					echo site_url('/Managers');
				}else{ 
					echo site_url('/Managers/login');
				} ?>
				" class="btn btn-primary m-2">Project Manager <i class="fas fa-user-cog"></i></a>
					<a href="
				<?php 
				if($this->session->userdata('logged_in'))
				{
					echo site_url('/Employees');
				}else{ 
					echo site_url('/Employees/login');
				} ?>
				" class="btn btn-primary m-2">Employee <i class="fas fa-user"></i></a>
			</div>

			<div class="account-box bg-inverse-dark border-0 bg-inverse-white">
				<div class="account-wrapper">
					<h3 class="account-title">Login</h3>

					<?php echo form_open('Managers/validate_credentials'); ?>
					<div class="form-group">
						<label>Username</label>
						<input class="form-control" name="username" type="text" autofocus required>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col">
								<label>Password</label>
							</div>
							<div class="col-auto">
								<a class="text-info">
									<small>Default Password is <i><b>password</b></i></small>
								</a>
							</div>
						</div>
						<input class="form-control" name="password" type="password" required>
					</div>
					<div class="form-group text-center">
						<button class="btn btn-primary account-btn" type="submit">Login</button>
					</div> 
					</form>

				</div>
			</div>
		</div>
	</div>


</body>

</html>

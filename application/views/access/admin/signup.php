<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>

<body style='background-image: url("../public/images/signup.jpg");'>



	<div class="container ">
		<h1 class="text-center">
			<a href="<?php echo base_url() ?>" class="navbar-brand font-weight-bolder">
				Home
			</a>
			<br>
			Create an Account!
			<hr class="border-dark">
		</h1>
		<?php echo validation_errors('<p class="text-danger">'); ?>

		<?php echo form_open('administrators/create_member'); ?>

		<div class="container m-4 p-4">

			<div class="row ">
				<div class=" col-6">
					<div class="form-group">
						<label>First Name <sup class="text-danger font-weight-bolder">*</sup></label>
						
						<input type="text" class="form-control" name="first_name" placeholder=" " required
							autofocus>
					</div>
					<div class="form-group">
						<label>Last Name <sup class="text-danger font-weight-bolder">*</sup></label>
						<input type="text" class="form-control" name="last_name" placeholder=" " required>
					</div>
					<div class="form-group">
						<label>Phone Number <sup class="text-danger font-weight-bolder">*</sup></label>
						<input type="text" class="form-control" name="phone" maxlength="10"  step="1" placeholder="07xxxxxxxx" pattern="[0-9]{10}"  required/>
					</div>
					<div class="form-group">
						<label>Email Address<sup class="text-danger font-weight-bolder">*</sup></label>
						<input type="email" class="form-control" name="email_address" placeholder=" " required>

					</div>
				</div>
				<div class=" col-6">
					<div class="form-group">
						<label>Username <sup class="text-danger font-   weight-bolder">*</sup></label>
						<input type="text" class="form-control" minlength="4" name="username" placeholder="*at least 4 characters*"
							required>
					</div>
					<div class="form-group">
						<label>Password <sup class="text-danger font-weight-bolder">*</sup></label>
						<input type="password" class="form-control" name="password"
							placeholder="*between 4 and 32 characters*" required>
					</div>
					<div class="form-group">
						<label>Confirm Password <sup class="text-danger font-weight-bolder">*</sup></label>
						<input type="password" class="form-control" name="password2"
							placeholder="*between 4 and 32 characters*" required>
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-success btn-block">Sign Up</button>
			<a href="<?php echo base_url(); ?>administrators/login" class="btn btn-primary btn-block">Login</a>
		</div>

		<?php echo form_close(); ?>


	</div>


</body>

</html>

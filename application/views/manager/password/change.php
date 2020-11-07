 
<?php echo validation_errors('<p class="text-danger">'); ?>
	<?php echo form_open('managers/change_password'); ?> 
<div class="container m-4 p-4">
	<h2 class="lead display-4 text-center"><i class="fas fa-unlock"></i>
		<hr class="border border-dark">
	</h2>
	<div class="row">
		<div class="col-12">
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Old Password<sup
						class="text-danger font-weight-bolder">*</sup></label>

				<input type="password" class="form-control" name="oldPass" placeholder=" " required autofocus>
			</div>

			<div class="form-group">
				<label class="text-monospace font-weight-bolder">New Password<sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="password" class="form-control" name="password" placeholder=" " required>
			</div>

			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Confirm Password<sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="password" class="form-control" name="password2" placeholder=" " required>
			</div>
		</div>
	</div>
	<div class="text-center col-12">
		<button type="submit" class="btn btn-outline-primary ">Change Password</button>
	</div>
</div>

<?php echo form_close(); ?>

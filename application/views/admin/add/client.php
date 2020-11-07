 
<?php echo validation_errors('<p class="text-danger">'); ?>
	<?php echo form_open('administrators/create_client'); ?> 
		<?php if (!is_null($msg)) {echo $msg;}?> 
<div class="container m-4 p-4">
	<h2 class="lead display-4 text-center"><i class="fas fa-user-tie"></i><sup class="text-info"><small><i
					class="fas fa-plus"></i></small></sup>
		<hr class="border border-dark">
	</h2>
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">First Name <sup
						class="text-danger font-weight-bolder">*</sup></label>

				<input type="text" class="form-control" name="first_name" placeholder=" " required autofocus>
			</div>

			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Phone Number <sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="text" class="form-control" name="phone" maxlength="10" step="1" placeholder="07xxxxxxxx"
					pattern="[0-9]{10}" required />
			</div>

			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Organization <sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="text" class="form-control" name="organization" placeholder=" " required>
			</div>
		</div>
		<div class="col-md-6 col-sm-12">
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Last Name <sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="text" class="form-control" name="last_name" placeholder=" " required>
			</div>

			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Email Address<sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="email" class="form-control" name="email_address" placeholder=" " required>

			</div>

			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Unique ID <sup
						class="text-danger font-weight-bolder">*</sup></label>
						<input type="text" class="form-control" name="pid" maxlength="5" step="1" placeholder="xxxxx"
					pattern="[0-9]{5}" required />
			</div>
		</div>
	</div>
	<div class="text-center col-12">
		<button type="submit" class="btn btn-outline-primary "> <span style="font-size:1.75rem; "><i
					class="fas fa-plus-circle"></i></span></button>
	</div>
</div>

<?php echo form_close(); ?>

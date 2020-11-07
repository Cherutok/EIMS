<div class="container m-4 p-4">
<h2 class="font-weight-bolder text-center">
	<i class="fas fa-user-tie"></i>
	<sup class="text-info">
		<small>
			<i class="fas fa-edit text-info"></i>
		</small>
	</sup>
</h2>

<?php echo form_open('administrators/update_client'); ?>
<?php foreach($clients as $client) : ?>
        <div class="form-group">
				<input type="hidden" name="id" value="<?php echo $client['id']; ?>">
			</div>
	<div class="row">
		<div class="col-md-6 col-sm-12"> 
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">First Name <sup
						class="text-danger font-weight-bolder">*</sup></label>

				<input type="text" class="form-control"
					name="first_name" value="<?php echo ucfirst($client['firstName']); ?> " required >
			</div>

			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Phone Number <sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="text" class="form-control" name="phone" maxlength="10" step="1" value="0<?php echo ucfirst($client['phone']); ?>"
					pattern="[0-9]{10}" required />
			</div>

			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Organization <sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="text" class="form-control" name="organization" value=" <?php echo ucfirst($client['organization']); ?>" required>
			</div>
		</div>

		<div class="col-md-6 col-sm-12">
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Last Name <sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="text" class="form-control" name="last_name" value=" <?php echo ucfirst($client['lastName']); ?>" required>
			</div>

			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Email Address<sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="email" class="form-control" name="email_address" value="<?php echo ucfirst($client['email']); ?> " required>

			</div>

			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Unique ID <sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="text" class="form-control" name="pid" maxlength="5" step="1" value="<?php echo ucfirst($client['pid']); ?>"
					pattern="[0-9]{5}" required />
			</div>
		</div>

		<div class="text-center col-12">
			<button type="submit" class="btn btn-outline-primary">Update</button>
		</div>
	</div>
</div>

<?php endforeach; ?>
<?php echo form_close(); ?>

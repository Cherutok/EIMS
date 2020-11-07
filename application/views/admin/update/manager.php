<?php echo form_open('administrators/update_manager'); ?>
<?php foreach($managers as $manager) : ?>
<div class="container m-4 p-4">
	<h2 class="lead display-4 text-center"><i class="fas fa-user-cog"></i><sup class="text-info"><small>
				<i class="fas fa-plus"></i></small></sup>
		<hr class="border border-dark">
	</h2>
	<div class="row ">
		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $manager['id']; ?>">
		</div>
		<div class=" col-6">
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">First Name <sup
						class="text-danger font-weight-bolder">*</sup></label>

				<input type="text" class="form-control" name="first_name" value="<?php echo $manager['firstName']; ?>"
					required>
			</div>
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Last Name <sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="text" class="form-control" name="last_name" value="<?php echo $manager['lastName']; ?>"
					required>
			</div>
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Emergency Phone Number <sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="text" class="form-control" name="phone2" maxlength="10" step="1" placeholder="07xxxxxxxx"
					pattern="[0-9]{10}" value="<?php echo $manager['emergency_phone']; ?>" required />
			</div>
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Salary<sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="number" class="form-control" value="<?php echo $manager['salary']; ?>" name="salary" placeholder="KSH" required />
			</div>
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Phone Number <sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="text" class="form-control" value="0<?php echo $manager['phone']; ?>" name="phone"
					maxlength="10" step="1" value="07xxxxxxxx" pattern="[0-9]{10}" required />
			</div>
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Email Address<sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="email" class="form-control" name="email_address" value="<?php echo $manager['email']; ?>"
					required>

			</div>
		</div>
		<div class=" col-6">
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Username <sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="text" class="form-control" minlength="4" name="username"
					value="<?php echo $manager['username']; ?>" required>
			</div>
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Job Group <sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="text" class="form-control" value="<?php echo $manager['job_group']; ?>" name="job_group"  required>
			</div>
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Qualifications</label>
				<textarea class="form-control" name="qualifications" placeholder=" "><?php echo $manager['qualifications']; ?></textarea>
			</div>
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Department</label>
				<select name="department_id" class="form-control" required>
					<?php foreach($departments as $department): ?>
					<option value="<?php echo $department['id']; ?>"><?php echo $department['name']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
	</div>
	<div class="text-center col-12">
		<button type="submit" class="btn btn-outline-primary ">Update</button>
	</div>
</div>

<?php endforeach; ?>
<?php echo form_close(); ?>

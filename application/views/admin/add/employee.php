<?php echo validation_errors('<p class="lead text-monospace text-danger">'); ?>
	 <?php echo form_open('administrators/create_employee'); ?>
		<?php if (!is_null($msg)) {echo $msg;}?>



<div class="container m-4 p-4">
	<h2 class="lead display-4 text-center"><i class="fas fa-user"></i><sup class="text-info"><small>
				<i class="fas fa-plus"></i></small></sup>
		<hr class="border border-dark">
	</h2>
	<div class="row">
		<div class=" col-6">
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">First Name <sup
						class="text-danger font-weight-bolder">*</sup></label>

				<input type="text" class="form-control" name="first_name" placeholder=" " required autofocus>
			</div>
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Last Name <sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="text" class="form-control" name="last_name" placeholder=" " required>
			</div>
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Phone Number <sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="text" class="form-control" name="phone" maxlength="10" step="1" placeholder="07xxxxxxxx"
					pattern="[0-9]{10}" required />
			</div>
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Emergency Phone Number <sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="text" class="form-control" name="phone2" maxlength="10" step="1" placeholder="07xxxxxxxx"
					pattern="[0-9]{10}" required />
			</div>
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Salary<sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="number" class="form-control" name="salary" placeholder="KSH" required />
			</div>
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Email Address<sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="email" class="form-control" name="email_address" placeholder=" " required>

			</div>
		</div>
		<div class=" col-6">
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Username <sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="text" class="form-control" minlength="4" name="username"
					placeholder="*at least 4 characters*" required>
			</div>
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Job Group <sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="text" class="form-control" name="job_group"  required>
			</div>
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Qualifications</label>
				<textarea class="form-control" name="qualifications" placeholder=" "></textarea>
			</div>
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Department</label>
				<select name="department_id" class="form-control" required>
					<?php foreach($departments as $department): ?>
					<option value="<?php echo $department['id']; ?>"><?php echo $department['name']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Designation</label>
				<select name="designation_id" class="form-control" required>
					<?php foreach($designations as $designation): ?>
					<option value="<?php echo $designation['id']; ?>"><?php echo $designation['name']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Default Password is <small
						class="text-warning font-weight-bolder">password</small></label>
				<input type="hidden" class="form-control" value="password" name="password" placeholder=" " required>
			</div>
		</div>
	</div>
	<div class="text-center col-12">
		<button type="submit" class="btn btn-outline-primary "> <span style="font-size:1.75rem; "><i
					class="fas fa-plus-circle"></i></span></button>
	</div>
</div>

<?php echo form_close(); ?>

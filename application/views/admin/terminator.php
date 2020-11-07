<?php echo validation_errors('<p class="lead text-monospace text-danger">'); ?>
<?php echo form_open('administrators/terminator'); ?>

<div class="container m-4 p-4">
	<h2 class="lead display-4 text-center text-danger"><i class="fas fa-user-alt-slash"></i>
		<hr class="border border-dark">
	</h2>
	<div class="form-group">
		<label class="text-monospace font-weight-bolder">Staff Name:</label>
		<br>
		<label for="manager_id" class="text-muted text-monospace text-sm">Managers</label>
		<select name="manager_id" class="form-control">
			<option value=""></option>
			<?php foreach($managers as $manager): ?>
			<option value="<?php echo $manager['id']; ?>"><?php echo $manager['firstName']; ?>
				<?php echo $manager['lastName']; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="form-group">
		<label for="employee_id" class="text-muted text-monospace text-sm">Employees</label>
		<select name="employee_id" class="form-control">
			<option value=""></option>
			<?php foreach($employees as $employee): ?>
			<option value="<?php echo $employee['id']; ?>"><?php echo $employee['firstName']; ?>
				<?php echo $employee['lastName']; ?></option>
			<?php endforeach; ?>
		</select>
	</div>

	<div class="form-group">
		<label class="text-monospace font-weight-bolder">Reason:</label>
		<textarea class="form-control" name="reason" placeholder=" " required></textarea>
	</div>

	<div class="text-center col-12">
		<button type="submit" class="btn btn-outline-danger "> <span style="font-size:1.75rem; "><i
					class="fas fa-minus-circle"></i></span></button>
	</div>
</div>

<?php echo form_close(); ?>

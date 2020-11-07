<?php echo validation_errors('<p class="lead text-monospacetext-danger">'); ?>
<?php echo form_open('managers/addMember'); ?>
<?php if (!is_null($msg)) {echo $msg;}?>


<div class="container m-4 p-4">
	<h2 class="lead display-4 text-center"><i class="fas fa-user-plus"></i>
		<hr class="border border-dark">
	</h2>
	<div class="row ">

		<div class="col-12">
			<div class="form-group">
                 <input type="hidden" name="team_id" value="<?php echo $this->uri->segment('3'); ?>">
				<label class="text-monospace font-weight-bolder">Employee</label>
				<select name="employee_id" class="form-control" required>
					<?php foreach($employees as $employee): ?>
					<option value="<?php echo $employee['id']; ?>"><?php echo $employee['firstName']; ?>
						<?php echo $employee['lastName']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
	</div>
	<div class="text-center col-12">
		<button type="submit" class="btn btn-outline-primary "> <span style="font-size:1.75rem; "><i
					class="fas fa-plus-circle"></i></span></button>
	</div>
</div>
<?php echo form_close(); ?>

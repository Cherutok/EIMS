<?php echo validation_errors('<p class="text-danger">'); ?>

<?php echo form_open('managers/apply_for_leave'); ?>

<div class="container m-4 p-4">
	<h2 class="lead display-4 text-center"><i class="fas fa-sign-out-alt"></i>
		<hr class="border border-dark">
	</h2>
	<div class="row ">
		<div class="col-12">
			<div class="form-group">
            <input type="hidden" value="<?php echo $this->session->userdata('user_id') ?>" name="employee_id" >
				<label class="text-monospace font-weight-bolder">Leave Type</label>
				<select name="leave_id" class="form-control" autofocus required>
					<?php foreach($leaves as $leave): ?>
					<option value="<?php echo $leave['id']; ?>"><?php echo $leave['name']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Reason</label>
				<textarea class="form-control" name="reason" placeholder=" " required></textarea>
			</div>
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Days</label>
				<input type="number" class="form-control" max="" min="0" name="days">
			</div>
		</div>
	</div>
	<div class="text-center col-12">
		<button type="submit" class="btn btn-outline-primary ">Apply</button>
	</div>
</div>

<?php echo form_close(); ?>

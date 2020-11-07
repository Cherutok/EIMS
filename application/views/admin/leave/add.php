<?php echo validation_errors('<p class="text-danger">'); ?>

<?php echo form_open('administrators/add_leave_type'); ?>

<div class="container m-4 p-4">
	<h2 class="lead display-4 text-center"><i class="fas fa-user-tie"></i><sup class="text-info"><small><i
					class="fas fa-plus"></i></small></sup>
		<hr class="border border-dark">
	</h2>
	<div class="row">
		<div class="col-12">
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Type<sup
						class="text-danger font-weight-bolder">*</sup></label>

				<input type="text" class="form-control" name="name" placeholder=" " required autofocus>
			</div>

			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Days Off<sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="text" class="form-control" name="duration" maxlength="2" step="1" placeholder=""
					pattern="[0-9]{0-9}" required />
			</div>
		</div>
	</div>
	<div class="text-center col-12">
		<button type="submit" class="btn btn-outline-primary "> <span style="font-size:1.75rem; "><i
					class="fas fa-plus-circle"></i></span></button>
	</div>
</div>

<?php echo form_close(); ?>

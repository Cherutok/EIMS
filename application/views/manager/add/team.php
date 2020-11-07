<?php echo validation_errors('<p class="lead text-monospacetext-danger">'); ?>
<?php echo form_open('managers/create_team'); ?>	
	<?php if (!is_null($msg)) {echo $msg;}?>
<div class="container m-4 p-4">
	<h2 class="lead display-4 text-center"><i class="fas fa-users"></i><sup class="text-info"><small>
				<i class="fas fa-plus"></i></small></sup>
		<hr class="border border-dark">
	</h2>
	<div class="row ">
		<div class=" col-12">
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Name <sup
						class="text-danger font-weight-bolder">*</sup></label>

				<input type="text" class="form-control" name="name" placeholder=" " required autofocus>
			</div>
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Project</label>
				<select name="project_id" class="form-control" required>
					<?php foreach($projects as $project): ?>
					<option value="<?php echo $project['id']; ?>"><?php echo $project['name']; ?></option>
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

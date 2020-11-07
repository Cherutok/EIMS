<?php echo validation_errors('<p class="lead text-monospacetext-danger">'); ?>
<?php echo form_open('managers/create_task'); ?>	
	<!-- <?php if (!is_null($msg)) {echo $msg;}?> -->


<div class="container m-4 p-4">
	<h2 class="lead display-4 text-center"><i class="fas fa-tasks"></i><sup class="text-info"><small>
				<i class="fas fa-plus"></i></small></sup>
		<hr class="border border-dark">
	</h2>
	<div class="row ">

		<div class="col-12">
			<div class="form-group">
				
					<input type="hidden" value="<?= $teamId ?>" name="team_id" >
					<input type="hidden" value="<?= $projectId ?>" name="project_id" > 
				
				<label class="text-monospace font-weight-bolder">Body</label>
				<textarea class="form-control" name="body" placeholder=" " autofocus required></textarea>
			</div>
		</div>
	</div>
	<div class="text-center col-12">
		<button type="submit" class="btn btn-outline-primary "> <span style="font-size:1.75rem; "><i
					class="fas fa-plus-circle"></i></span></button>
	</div>
</div>
<?php echo form_close(); ?>

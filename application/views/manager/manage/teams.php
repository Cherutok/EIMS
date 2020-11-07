<h2 class="lead display-4 text-center">Teams
	<hr class="border-dark">
</h2>
<table class="table table-hover table-striped table-responsive" id="teamTable">
	<thead class="text-center">
		<tr>
			<th>Name</th>
			<th>Project</th>
			<th>Project Manager</th>
			<th>Assign Tasks</th>
			<th>Assign Members</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($teams as $team) : ?>
		<tr class="text-center">
			<td>
				<?php echo ucfirst($team['name']); ?>
			</td>
			<td>
				<?php 
									$id = $team['project_id'];
									$project_name = $this->manager_model->get_project_name($id); 
									echo $project_name; 
									?>
			</td>
			<td>
				<?php 
									$id = $team['manager_id'];
                                    $manager_name = $this->admin_model->get_manager_name($id); 
									echo $manager_name; 
									?>
			</td>
			<td>
				<button type="button" class="btn btn-block text-primary"
					onclick="location.href='<?php echo base_url(); ?>managers/add_task/<?php echo $team['id']; ?>'">
					<i class="fas fa-tasks"></i>
				</button>
			</td>
			<td>
				<button type="button" class="btn btn-block text-primary"
					onclick="location.href='<?php echo base_url(); ?>managers/addMember/<?php echo $team['id']; ?>'">
					<i class="fas fa-users"></i>
				</button>
			</td>
			<td>
				<form class="cat-delete"
					action="<?php echo base_url(); ?>managers/delete_team/<?php echo $team['id']; ?>"
					method="POST">
					<button type="submit" class="btn btn-block text-danger"><i class="fas fa-trash"></i></button>

				</form>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<h2 class="lead display-4 text-center">Tasks
	<hr class="border-dark">
</h2>
<table class="table table-hover table-striped table-responsive" id="teamTable">
	<thead class="text-center">
		<tr>
			<th>Project</th>
			<th>Team</th>
			<th>Body</th>
			<th>Status</th>
			<th>Incomplete(?)</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($tasks as $task) : ?>
		<tr class="text-center">
			<td>
				<?php
                    $id = $task['project_id'];
                    $project_name = $this->manager_model->get_project_name($id);
                    echo $project_name;
                ?>
			</td>
			<td>
				<?php
                    $id = $task['team_id'];
                    $team_name = $this->manager_model->get_team_name($id);
                    echo $team_name;
                ?>
			</td>
			<td>
				<?php echo $task['body']; ?>
			</td>
			<td>
				<?php
                    $status = $task['status'];
                    if ($status == 0) {
                        echo '<p class="text-danger">Incomplete</p>';
                    } else {
                        echo '<p class="text-success">Complete</p>';
                    }
                ?>
			</td>
			<td>
				<button type="button" class="btn w-100 h-100 text-danger"
					onclick="location.href='<?php echo base_url(); ?>managers/incomplete_task/<?php echo $task['id']; ?>'">
					<i class="fas fa-ban"></i>
				</button>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

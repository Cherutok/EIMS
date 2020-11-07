<h2 class="lead display-4 text-center">My Projects <sup><small><span
				class="badge badge-pill badge-warning"><?= $projectcount ?></span></small></sup>
	<hr class="border-dark">
</h2>
<div class="row">
	<?php foreach($projects as $project) : ?>
	<div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
		<div class="card">
			<div class="card-body">
				<div class="dropdown dropdown-action profile-action">
					<a href="#" class="action-icon dropdown-toggle <?php echo 'text-danger'; ?>" data-toggle="dropdown"
						aria-expanded="false"><i class="fas fa-check-double "></i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item"
							onclick="location.href='<?php echo base_url(); ?>Managers/mark_as_complete/<?= $project['id'] ?>'"
							data-toggle="modal" data-target="#edit_project"> <span>Mark as
								Complete</span></a>
					</div>
				</div>
				<h4 class="project-title"><a href="project-view.html"><?php echo ucfirst($project['name']); ?></a></h4>
				<small class="block text-ellipsis m-b-15">
					<span class="text-xs">
						<?php
                    $id = $project['id'];
                    $openTaskCount = $this->manager_model->get_project_open_tasks($id);
                    echo $openTaskCount;
                         ?>
					</span> <span class="text-muted">open tasks, </span>
					<span class="text-xs">
						<?php
                    $id = $project['id'];
                    $taskCount = $this->manager_model->get_project_tasks($id);
                    $closedTaskCount = $taskCount-$openTaskCount;
                    echo $taskCount;
                         ?>
					</span> <span class="text-muted">total tasks </span>
				</small>
				<p class="text-muted"><?php echo word_limiter(ucfirst($project['description']),6); ?>
				</p>
				<div class="pro-deadline m-b-15">
					<div class="sub-title">
						Deadline:
					</div>
					<div class="text-muted">
						<?php echo $project['end_date']; ?>
					</div>
				</div>
				<p class="m-b-5">Progress <span class="text-success float-right"><?php $progress=($closedTaskCount/$taskCount)*100;
                 echo $progress;?>%</span></p>
				<div class="progress progress-xs mb-0">
					<div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip"
						title="<?php echo $progress; ?>%" style="width: <?php echo $progress; ?>%"></div>
				</div>
			</div>
		</div>
	</div>

	<?php endforeach; ?>
</div>
<table class="table table-hover table-striped table-responsive" id="projectTable">
	<thead class="text-center">
		<tr>
			<th>Name</th>
			<th>Client</th>
			<th>Start</th>
			<th>End</th>
			<th>Price</th>
			<th>Price Interval</th>
			<th>Priority</th>
			<th>Unique ID</th>
			<th>Status</th>
			<th>Mark as Complete</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($projects as $project) : ?>
		<tr class="text-center">

			<td>
				<?php echo ucfirst($project['name']); ?>
			</td>

			<td>
				<?php
                    $id = $project['client_id'];
                    $fName = $this->admin_model->get_client_name($id)->firstName;
                    $lName = $this->admin_model->get_client_name($id)->lastName;
                    echo $fName." ".$lName;
                ?>
			</td>

			<td>
				<?php echo $project['start_date']; ?>

			<td>
				<?php echo $project['end_date']; ?>
			</td>

			<td>
				$<?php echo $project['rate']; ?>
			</td>

			<td>
				<?php echo ucfirst($project['rate_interval']); ?>
			</td>

			<td>
				<?php 
                    $priority = $project['priority'];
                    if ($priority == 1) {
                        echo "<p class='text-success'>Low</p>";
                    } elseif ($priority == 2) {
                        echo "<p class='text-warning'>Medium</p>";
                    } else {
                        echo "<p class='text-danger'>High</p>";
                    }
                ?>
			</td>

			<td>
				<?php echo $project['pid']; ?>
			</td>
			<td>
				<?php
                    $status = $project['status'];
                    if ($status == 0) {
                        echo '<p class="text-danger">Incomplete</p>';
                    } else {
                        echo '<p class="text-success">Complete</p>';
                    }
                ?>
			</td>
			<?php if($status==0): ?>
			<td>
				<i class="fas fa-check-double text-danger" style="cursor:pointer"
					onclick="location.href='<?php echo base_url(); ?>Managers/mark_as_complete/<?= $project['id'] ?>'"></i>
			</td>
			<?php endif; ?>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<div class="row">
	<div class="col-12">
		<h2 class="lead display-4 text-center">Project Managers
			<hr class="border-dark">
		</h2>
		<table class="table table-hover table-striped table-responsive   " id="managerTable">
			<thead class="text-center">
				<tr>
					<th>Name</th>
					<th>Leave Type</th>
					<th>Days Off</th>
					<th>Starting</th>
					<th>Status</th>
					<th>Reason</th>
					<th>Approve</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($managers as $manager) : ?>
				<tr class="text-center">
					<td>
						<?php 
						$name = $this->admin_model->get_manager_name($manager['employee_id']);
						echo $name;
						?>
					</td>
					<td>
						<?php 
						$leaveName = $this->admin_model->get_leave_name($manager['leave_id']);
						echo $leaveName;
						?>
					</td>
					<td>
						<?php echo $manager['days']; ?>
					</td>
					<td>
						<?php echo $manager['start']; ?>
					</td>
					<td>
						<?php
                    $status = $manager['status'];
                    if ($status == 0) {
                        echo '<p class="text-danger">Pending</p>';
                    } else {
                        echo '<p class="text-success">Approved</p>';
                    }
               	 ?>
					</td>
					<td>
						<?php echo $manager['reason']; ?>
					</td>
					<td>
						<button type="button" class="btn btn-block text-primary"
							onclick="location.href='<?php echo base_url(); ?>administrators/accept_manager_leave/<?php echo $manager['employee_id']; ?>'">
							<i class="fas fa-check-circle"></i>
						</button>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="col-12">
		<h2 class="lead display-4 text-center">Employees
			<hr class="border-dark">
		</h2>
		<table class="table table-hover table-striped table-responsive display " id="employeeTable">
			<thead class="text-center">
				<tr>
					<th>Name</th>
					<th>Leave Type</th>
					<th>Days Off</th>
					<th>Starting</th>
					<th>Status</th>
					<th>Reason</th>
					<th>Approve</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($employees as $employee) : ?>
				<tr class="text-center">
					<td>
						<?php 
						$name = $this->admin_model->get_employee_name($employee['employee_id']);
						echo $name;
						?>
					</td>
					<td>
						<?php 
						$leaveName = $this->admin_model->get_leave_name($employee['leave_id']);
						echo $leaveName;
						?>
					</td>
					<td>
					<?php echo $employee['days']; ?>
					</td>
					<td>
						<?php echo $employee['start']; ?>
					</td>
					<td>
						<?php
                    $status = $employee['status'];
                    if ($status == 0) {
                        echo '<p class="text-danger">Pending</p>';
                    } else {
                        echo '<p class="text-success">Approved</p>';
                    }
               	 ?>
					</td>
					<td>
						<?php echo $employee['reason']; ?>
					</td>
					<td>
						<button type="button" class="btn btn-block text-primary"
							onclick="location.href='<?php echo base_url(); ?>administrators/accept_employee_leave/<?php echo $employee['employee_id']; ?>'">
							<i class="fas fa-check-circle"></i>
						</button>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

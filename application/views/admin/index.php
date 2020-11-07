<div>
	<div class="page-header">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="page-title">Welcome <?php echo ucfirst($this->session->userdata('username')); ?>!</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item active">Dashboard</li>
				</ul>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
			<div class="card dash-widget"
				onclick="location.href='<?php echo base_url(); ?>administrators/manage_projects'"
				style="cursor:pointer">
				<div class="card-body">
					<span class="dash-widget-icon"><i class="fa fa-project-diagram"></i></span>
					<div class="dash-widget-info">
						<h3><?= $projectcount ?></h3>
						<span>Projects</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
			<div class="card dash-widget shadow"
				onclick="location.href='<?php echo base_url(); ?>administrators/manage_clients'" style="cursor:pointer">
				<div class="card-body">
					<span class="dash-widget-icon"><i class="fa fa-user-tie"></i></span>
					<div class="dash-widget-info">
						<h3><?= $clientcount ?></h3>
						<span>Clients</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
			<div class="card dash-widget shadow">
				<div class="card-body">
					<span class="dash-widget-icon"><i class="fa fa-tasks"></i></span>
					<div class="dash-widget-info">
						<h3><?= $taskcount ?></h3>
						<span>Tasks</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
			<div class="card dash-widget"
				onclick="location.href='<?php echo base_url(); ?>administrators/manage_employees'"
				style="cursor:pointer">
				<div class="card-body">
					<span class="dash-widget-icon"><i class="fa fa-user"></i></span>
					<div class="dash-widget-info">
						<h3><?= $employeecount ?></h3>
						<span>Staff</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 text-center">
					<div class="card">
						<div class="card-body">
							<h3 class="card-title">Total Workload</h3>
							<!-- <div id="bar-charts"></div> -->
						</div>
					</div>
				</div>
				<div class="col-md-6 text-center">
					<div class="card">
						<div class="card-body">
							<h3 class="card-title">Performance Overview</h3>
							<!-- <div id="line-charts"></div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="card-group m-b-30">
				<div class="card">
					<div class="card-body">
						<div class="d-flex justify-content-between mb-3">
							<div>
								<span class="d-block text-warning">Pending Leave Requests</span>
							</div>
						</div>
						<h3 class="mb-3"><?= $tot_o_leavecount ?></h3>
						<div class="progress mb-2" style="height: 5px;">
							<div class="progress-bar bg-primary" role="progressbar"
								style="width: <?php $percent = $tot_o_leavecount/$totleavecount*100; echo $percent; ?>%;"
								aria-valuenow="<?= $leavecount2 ?>" aria-valuemin="0"
								aria-valuemax="<?= $totleavecount ?>"></div>
						</div>
						<p class="mb-0">Overall Requests <?= $totleavecount ?></p>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-6 d-flex text-center">
			<div class="card flex-fill">
				<div class="card-body">
					<h4 class="card-title">Engaged Employees<span
							class="badge bg-inverse-light ml-2"><?= $totalrunning ?></span></h4>
					<?php foreach($eng_employees as $eng_employee) : ?>
					<div class="leave-info-box">
						<div class="media align-items-center">

							<div class="media-body badge">
								<div class="text-sm my-0">
									<?php 
										$name = $this->admin_model->get_employee_name($eng_employee['employee_id']);
										echo $name;
									?>
								</div>
							</div>
						</div>
						<div class="row align-items-center mt-3">
							<div class="col-12">
								<span class="text-sm text-muted">
									<?php 
										$project = $this->employee_model->get_project_name($eng_employee['project_id']);
										echo $project;
									?>
								</span>
								<br>
								<span class="text-sm text-muted">
									<?php 
										$team = $this->employee_model->get_team_name($eng_employee['team_id']);
										echo $team;
									?>
								</span>
								<h6 class="mb-0 text-monospace">
									<?php 
										$designation = $this->admin_model->get_employee_designation($eng_employee['employee_id']);
										echo $designation;
									?>
								</h6>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="col-6 d-flex text-center">
			<div class="card flex-fill">
				<div class="card-body">
					<h4 class="card-title">Absent Employees<span
							class="badge bg-inverse-danger ml-2"><?= $totleavecount ?></span></h4>
					<?php foreach($mleaves as $mleave) : ?>
					<div class="leave-info-box">
						<div class="media align-items-center">

							<div class="media-body badge">
								<div class="text-sm my-0">
									<?php 
									$id = $mleave['employee_id'];
									$manager_name = $this->admin_model->get_manager_name($id); 
									echo $manager_name; 
									?>
								</div>
							</div>
						</div>
						<div class="row align-items-center mt-3">
							<div class="col-6">
								<h6 class="mb-0"><?php echo $mleave['start']; ?></h6>
								<span class="text-sm text-muted" style="text-decoration:overline;">Leave Date</span>
							</div>
							<div class="col-6 text-right">
								<?php 
								$status = $mleave['status']; 
								if ($status==0) {
									echo '<span class="badge bg-inverse-danger">Pending</span>';
								} else {
									echo '<span class="badge bg-inverse-success">Approved</span>';
								}
								?>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
					<?php foreach($eleaves as $eleave) : ?>
					<div class="leave-info-box">
						<div class="media align-items-center">

							<div class="media-body badge">
								<div class="text-sm my-0">
									<?php 
						$name = $this->admin_model->get_employee_name($eleave['employee_id']);
						echo $name;
						?>
								</div>
							</div>
						</div>
						<div class="row align-items-center mt-3">
							<div class="col-6">
								<h6 class="mb-0"><?php echo $eleave['start']; ?></h6>
								<span class="text-sm text-muted" style="text-decoration:overline;">Leave Date</span>
							</div>
							<div class="col-6 text-right">
								<?php 
								$status = $eleave['status']; 
								if ($status==0) {
									echo '<span class="badge bg-inverse-danger">Pending</span>';
								} else {
									echo '<span class="badge bg-inverse-success">Approved</span>';
								}
								?>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 d-flex">
			<div class="card card-table flex-fill align-items-center ">
				<div class="card-header">
					<h3 class="card-title mb-0">Recent Clients</h3>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table custom-table mb-0 table-hover table-striped table-responsive"
							id="clientTable">
							<thead class="text-center">
								<tr>
									<th>Name</th>
									<th>Organization</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($clients as $client) : ?>
								<tr class="text-center">
									<td>
										<?php echo ucfirst($client['firstName']); ?>
										<?php echo ucfirst($client['lastName']); ?>
									</td>
									<td>
										<?php echo $client['organization']; ?>
									</td>
									<td>
										<?php if ($this->session->userdata('is_administrator')): ?>
										<button type="submit" class="btn btn-block text-primary"
											onclick="location.href='<?php echo base_url(); ?>administrators/edit_project/<?php echo $client['id']; ?>'"><i
												class="fas fa-edit"></i></button>
										<?php endif; ?>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer">
					<a href="<?php echo site_url('/administrators/manage_clients'); ?>">View all clients</a>
				</div>
			</div>
		</div>
		<div class="col-md-6 d-flex">
			<div class="card card-table flex-fill align-items-center">
				<div class="card-header">
					<h3 class="card-title mb-0">Recent Projects</h3>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table custom-table mb-0 table-hover table-striped table-responsive"
							id="projectTable">
							<thead class="text-center">
								<tr>
									<th>Name</th>
									<th>Priority</th>
									<th>Action</th>
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
										<?php if ($this->session->userdata('is_administrator')): ?>
										<button type="submit" class="btn btn-block text-primary"
											onclick="location.href='<?php echo base_url(); ?>administrators/edit_project/<?php echo $project['id']; ?>'"><i
												class="fas fa-edit"></i></button>
										<?php endif; ?>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer">
					<a href="<?php echo site_url('/administrators/manage_projects'); ?>">View all projects</a>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12 d-flex p-2">
			<div class="card card-table flex-fill align-items-center">
				<div class="card-header">
					<h3 class="card-title mb-0">Complete Projects</h3>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table custom-table mb-0 table-hover table-striped table-responsive"
							id="projectTable">
							<thead class="text-center">
								<tr>
									<th>Name</th>
									<th>project</th>
									<th>Period</th>
									<th>Price</th>
									<th>Price Interval</th>
									<th>Priority</th>
									<th>Project Manager</th>
									<th>Unique ID</th> 
								</tr>
							</thead>
							<tbody>
								<?php foreach($cprojects as $cproject) : ?>
								<tr class="text-center">

									<td>
										<?php echo ucfirst($cproject['name']); ?>
									</td>

									<td>
										<?php
                    $id = $cproject['client_id'];
                    $fName = $this->admin_model->get_client_name($id)->firstName;
                    $lName = $this->admin_model->get_client_name($id)->lastName;
                    echo $fName." ".$lName;
                ?>
									</td>

									<td>
										<?php echo $cproject['start_date']; ?><br>to<br><?php echo $cproject['end_date']; ?>
									</td>

									<td>
										$<?php echo $cproject['rate']; ?>
									</td>

									<td>
										<?php echo ucfirst($cproject['rate_interval']); ?>
									</td>

									<td>
										<?php 
                    $priority = $cproject['priority'];
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
										<?php
                    $id = $cproject['manager_id'];
                    $fName = $this->admin_model->get_manager_name($id);
                    echo $fName;
                ?>
									</td>

									<td>
										<?php echo $cproject['pid']; ?>
									</td> 
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

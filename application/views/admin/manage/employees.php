<div class="row">
	<div class="col-12">
		<h2 class="lead display-4 text-center">Project Managers
			<hr class="border-dark">
		</h2>
		<table class="table table-hover table-striped table-active table-bordered table-responsive display w-100"
			id="managerTable">
			<thead class="text-center">
				<tr>
					<th>Name</th>
					<th>Username</th>
					<th>Email Address</th>
					<th>Department</th>
					<th>Designation</th>
					<th>Contacts</th>
					<th>Edit</th>
					<th>Demote</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($managers as $manager) : ?>
				<tr class="text-center">

					<td>
						<p class="text-info" style="cursor:zoom-in"  onclick="location.href='<?php echo base_url(); ?>Administrators/view_manager/<?= $manager['username']?>'">
							<?php echo ucfirst($manager['firstName']); ?>
							<?php echo ucfirst($manager['lastName']); ?>
						</p>
					</td>
					<td>
						<?php echo $manager['username']; ?>
					</td>
					<td>
						<?php echo $manager['email']; ?>
					</td>
					<td>
						<?php 
									$id = $manager['department_id'];
									$department_name = $this->admin_model->get_department_name($id)->name; 
									echo $department_name; 
									?>
					</td>
					<td>
						<?php 
									$id = $manager['designation_id'];
									$designation_name = $this->admin_model->get_designation_name($id)->name; 
									echo $designation_name; 
									?>
					</td>
					<td>
						+254<?php echo $manager['phone']; ?>
						<br>
						+254<?php echo $manager['emergency_phone']; ?>
					</td>
					<td>
						<?php 
						if ($this->session->userdata('is_administrator')): 
                        ?>
						<button type="submit" class="btn btn-block text-primary"><i class="fas fa-edit"
								onclick="location.href='<?php echo base_url(); ?>administrators/edit_manager/<?php echo $manager['id']; ?>'"></i></button>

						<?php endif; ?>
					</td>
					<td>
						<?php 
						if ($this->session->userdata('is_administrator')): 
                        ?>
						<button type="button" class="btn btn-block text-primary">
							<i class="fas fa-angle-double-down"
								onclick="location.href='<?php echo base_url(); ?>administrators/demote_manager/<?php echo $manager['id']; ?>'"></i>
						</button>
						<?php endif; ?>
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
		<table class="table table-hover table-striped table-active table-bordered table-responsive display w-100"
			id="employeeTable">
			<thead class="text-center">
				<tr>
					<th>Name</th>
					<th>Username</th>
					<th>Email Address</th>
					<th>Department</th>
					<th>Designation</th>
					<th>Contacs</th>
					<th>Edit</th>
					<th>Promote</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($employees as $employee) : ?>
				<tr class="text-center">

					<td>
						<p class="text-info" style="cursor:zoom-in" onclick="location.href='<?php echo base_url(); ?>Administrators/view_employee/<?= $employee['username']?>'">
							<?php echo ucfirst($employee['firstName']); ?>
							<?php echo ucfirst($employee['lastName']); ?>
						</p>
						<div id="myModal" class="modal fade" role="dialog">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="card mb-0">

										<?php	
						$data = $this->admin_model->get_this_employee($employee['id']);
						$this_data = $data[0]; 
						print_r($this_data);						
					?>
									</div>
								</div>

							</div>
						</div>
					</td>
					<td>
						<?php echo $employee['username']; ?>
					</td>
					<td>
						<?php echo $employee['email']; ?>
					</td>
					<td>
						<?php 
									$id = $employee['department_id'];
									$department_name = $this->admin_model->get_department_name($id)->name; 
									echo $department_name; 
									?>
					</td>
					<td>
						<?php 
									$id = $employee['designation_id'];
									$designation_name = $this->admin_model->get_designation_name($id)->name; 
									echo $designation_name; 
									?>
					</td>
					<td>
						+254<?php echo $employee['phone']; ?>
						<br>
						+254<?php echo $manager['emergency_phone']; ?>
					</td>
					<td>
						<?php 
						if ($this->session->userdata('is_administrator')): 
                        ?>
						<button type="submit" class="btn btn-block text-primary"><i class="fas fa-edit"
								onclick="location.href='<?php echo base_url(); ?>administrators/edit_employee/<?php echo $employee['id']; ?>'"></i></button>
						<?php endif; ?>
					</td>
					<td>
						<?php 
						if ($this->session->userdata('is_administrator')): 
                        ?>
						<button type="button" class="btn btn-block text-primary">
							<i class="fas fa-angle-double-up"
								onclick="location.href='<?php echo base_url(); ?>administrators/promote_employee/<?php echo $employee['id']; ?>'"></i>
						</button>
						<?php endif; ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<div class="p-4 m-4">

	<?php foreach($managers as $manager) : ?>
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12" style="cursor:zoom-out">
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a
								onclick='location.href="<?php echo base_url(); ?>Administrators/manage_employees"'>Employees</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

		<div class="card mb-0">
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<div class="profile-view">
							<div class="profile-img-wrap">
								<div class="profile-img">
									<a href="#"><i class="fas fa-user-cog" style="height:100%;width:100%;"></i></a>
								</div>
							</div>
							<div class="profile-basic">
								<div class="row">
									<div class="col-md-6">
										<ul class="personal-info">
											<li>
												<div class="title">First Name:</div>
												<div class="text"><?php echo ucfirst($manager['firstName']); ?></div>
											</li>
											<li>
												<div class="title">Last Name:</div>
												<div class="text"><?php echo ucfirst($manager['lastName']); ?></a>
												</div>
											</li>

											<li>
												<div class="title">Email:</div>
												<div class="text"><?php echo $manager['email']; ?></div>
											</li>
											<li>
												<div class="title">Phone:</div>
												<div class="text">+254<?php echo ucfirst($manager['phone']); ?></div>
											</li>
											<li>
												<div class="title">Emergency Contact:</div>
												<div class="text">
													+254<?php echo ucfirst($manager['emergency_phone']); ?></a>
												</div>
											</li>
										</ul>
									</div>
									<div class="col-md-6">
										<ul class="personal-info">
											<li>
												<div class="title">Username:</div>
												<div class="text"><?php echo $manager['username']; ?></div>
											</li>
											<li>
												<div class="title">Department:</div>
												<div class="text"> <?php 
									$id = $manager['department_id'];
									$department_name = $this->admin_model->get_department_name($id)->name; 
									echo $department_name; 
									?></div>
											</li>
											<li>
												<div class="title">Salary:</div>
												<div class="text">KSH <?php echo $manager['salary']; ?></div>
											</li>
											<li>
												<div class="title">Highest Qualification:</div>
												<div class="text"><?php echo $manager['qualifications']; ?></div>
											</li>

										</ul>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<?php endforeach; ?>



</div>

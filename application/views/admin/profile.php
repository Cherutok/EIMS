
<div class="p-4 m-4">

	<?php foreach($administrators as $administrator) : ?>
	<div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Profile</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a onclick='location.href="<?php echo base_url(); ?>Administrators"'>Dashboard</a></li>
                                <li class="breadcrumb-item active">Profile</li>
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
                                            <a href="#"><i class="fas fa-user-shield" style="height:100%;width:100%;"></i></a>
                                        </div>
                                    </div>
                                    <div class="profile-basic">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="personal-info">
                                                    <li>
                                                        <div class="title">First Name:</div>
                                                        <div class="text"><?php echo ucfirst($administrator['firstName']); ?></div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Last Name:</div>
                                                        <div class="text"><?php echo ucfirst($administrator['lastName']); ?></a>
                                                        </div>
                                                    </li>
 
                                                    <li>
                                                        <div class="title">Email:</div>
                                                        <div class="text"><?php echo $administrator['email']; ?></div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Phone:</div>
                                                        <div class="text">+254<?php echo ucfirst($administrator['phone']); ?></div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Emergency Contact:</div>
                                                        <div class="text">+254<?php echo ucfirst($administrator['emergency_phone']); ?></a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="personal-info">
                                                    <li>
                                                        <div class="title">Username:</div>
                                                        <div class="text"><?php echo $administrator['username']; ?></div>
                                                    </li> 
                                                    <li>
                                                        <div class="title">Job Group:</div>
                                                        <div class="text"><?php echo $administrator['job_group']; ?></div>
                                                    </li> 
                                                    <li>
                                                        <div class="title">Salary:</div>
                                                        <div class="text">KSH <?php echo $administrator['salary']; ?></div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Highest Qualification:</div>
                                                        <div class="text"><?php echo $administrator['qualifications']; ?></div>
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

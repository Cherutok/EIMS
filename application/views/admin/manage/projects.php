<h2 class="lead display-4 text-center">Projects
	<hr class="border-dark">
</h2>
<table class="table table-hover table-striped table-responsive" id="projectTable">
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
			<th>Manage</th>
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
				<?php echo $project['start_date']; ?><br>to<br><?php echo $project['end_date']; ?>
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
				<?php
                    $id = $project['manager_id'];
                    $fName = $this->admin_model->get_manager_name($id);
                    echo $fName;
                ?>
            </td>	

            <td>
				<?php echo $project['pid']; ?>
            </td>
            
			<td>
				<?php if ($this->session->userdata('is_administrator')): ?>
				<form class="cat-delete"
					action="<?php echo base_url(); ?>administrators/delete_project/<?php echo $project['id']; ?>"
					method="POST">
					<button type="submit" class="btn btn-block text-danger"><i class="fas fa-trash"></i></button>
				</form>
				<hr>
				<button type="submit" class="btn btn-block text-primary"  onclick="location.href='<?php echo base_url(); ?>administrators/edit_project/<?php echo $project['id']; ?>'"><i
									class="fas fa-edit"></i></button>
				<?php endif; ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

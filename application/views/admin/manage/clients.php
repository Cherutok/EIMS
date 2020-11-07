<h2 class="lead display-4 text-center">Clients
	<hr class="border-dark">
</h2>
<table class="table table-hover table-striped table-responsive" id="clientTable">
	<thead class="text-center">
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Organization</th>
			<th>Email Address</th>
			<th>Phone Number</th>
			<th>Unique ID</th>
			<th>Manage</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($clients as $client) : ?>
		<tr class="text-center">
			<td>
				<?php echo ucfirst($client['firstName']); ?>
			</td>
			<td>
				<?php echo ucfirst($client['lastName']); ?>
			</td>
			<td>
				<?php echo $client['organization']; ?>
			</td>
			<td>
				<?php echo $client['email']; ?>
			</td>
			<td>
				+254<?php echo $client['phone']; ?>
			</td>
			<td>
				<?php echo $client['pid']; ?>
			</td>
			<td>
				<?php if ($this->session->userdata('is_administrator')): ?>
				<form class="cat-delete"
					action="<?php echo base_url(); ?>administrators/delete_client/<?php echo $client['id']; ?>"
					method="POST">
					<button type="submit" class="btn btn-block text-danger"><i class="fas fa-trash"></i></button>

				</form>
				<hr>
				<button type="button" class="btn btn-block text-primary" onclick="location.href='<?php echo base_url(); ?>administrators/edit_client/<?php echo $client['id']; ?>'"><i
						class="fas fa-edit"></i></button>

				<?php endif; ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

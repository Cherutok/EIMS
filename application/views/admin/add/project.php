<?php echo validation_errors('<p class="lead text-monospace text-danger">'); ?>
	 <?php echo form_open('administrators/create_project'); ?>
		<?php if (!is_null($msg)) {echo $msg;}?>



<div class="container m-4 p-4">
	<h2 class="lead display-4 text-center"><i class="fas fa-cogs"></i><sup class="text-info"><small>
				<i class="fas fa-plus"></i></small></sup>
		<hr class="border border-dark">
	</h2>
	<div class="row ">
		<div class=" col-6">
			<div class="form-group">
				<label class="text-monospace font-weight-bolder"> Name <sup
						class="text-danger font-weight-bolder">*</sup></label>

				<input type="text" class="form-control" name="name" placeholder=" " required autofocus>
			</div>

			<div class="form-group">
				<label class="text-monospace font-weight-bolder">End Date<sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="date" class="form-control" name="end_date" step="1" placeholder=" "
					 required />
            </div>
            
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Rate<sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="number" class="form-control" name="rate" placeholder=" " required>
            </div>
            
            <div class="form-group">
				<label class="text-monospace font-weight-bolder">Priority <sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="range" name="priority" class="form-control" min="1" max="3" step="1" list="priority">
				<datalist id="priority">
					<option value="1" label="low"></option>
					<option value="2" label="medium"></option>
					<option value="3" label="high"></option>
				</datalist>
			</div>
		</div>
		<div class=" col-6">
			
        <div class="form-group">
				<label class="text-monospace font-weight-bolder">Client</label>
				<select name="client_id" class="form-control" required>
					<?php foreach($clients as $client): ?>
					<option value="<?php echo $client['id']; ?>"><?php echo $client['firstName']; ?> <?php echo $client['lastName']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Manager</label>
				<select name="manager_id" class="form-control" required>
					<?php foreach($managers as $manager): ?>
					<option value="<?php echo $manager['id']; ?>"><?php echo $manager['firstName']; ?> <?php echo $manager['lastName']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Rate Interval</label>
				<select name="rate_interval" class="form-control" required>
					<option value="fixed">Fixed</option>
					<option value="hourly">Hourly</option>
					<option value="modular">Modular</option>
				</select>
			</div>

			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Unique ID <sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="text" class="form-control" name="pid" maxlength="5" step="1" placeholder="xxxxx"
					pattern="[0-9]{5}" required />
			</div>
		</div>
		<div class="col-12">
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Description</label>
				<textarea id="ckeditor" class="form-control" name="description" placeholder=" "></textarea>
			</div>
		</div>
	</div>
	<div class="text-center col-12">
		<button type="submit" class="btn btn-outline-primary "> <span style="font-size:1.75rem; "><i
					class="fas fa-plus-circle"></i></span></button>
	</div>
</div>

<?php echo form_close(); ?>

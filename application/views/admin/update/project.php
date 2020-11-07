<?php echo form_open('administrators/update_project'); ?>
<?php foreach($projects as $project) : ?>
<div class="container m-4 p-4">
	<h2 class="lead display-4 text-center"><i class="fas fa-user-cog"></i><sup class="text-info"><small>
				<i class="fas fa-plus"></i></small></sup>
		<hr class="border border-dark">
	</h2>
	<div class="row ">
		<div class=" col-6">
			<div class="form-group">
				<label class="text-monospace font-weight-bolder"> Name <sup
						class="text-danger font-weight-bolder">*</sup></label>

				<input type="text" class="form-control" value="<?php echo $project['name']; ?>" name="name" placeholder=" " required>
			</div>

			<div class="form-group">
				<label class="text-monospace font-weight-bolder">End Date<sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="date" class="form-control" value="<?php echo $project['end_date']; ?>" name="end_date" step="1" placeholder=" "
					 required />
            </div>
            
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Rate<sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="number" class="form-control" value="<?php echo $project['rate']; ?>" name="rate" placeholder=" " required>
            </div>
            
            <div class="form-group">
				<label class="text-monospace font-weight-bolder">Priority <sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="range" name="priority"  value="<?php echo $project['priority']; ?>" class="form-control" min="1" max="3" step="1" list="priority">
				<datalist id="priority">
					<option value="1" label="low"></option>
					<option value="2" label="medium"></option>
					<option value="3" label="high"></option>
				</datalist>
			</div>
		</div>
		<div class=" col-6">


			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Rate Interval</label>
				<select value="<?php echo $project['rate_interval']; ?>" name="rate_interval" class="form-control" required>
					<option value="fixed">Fixed</option>
					<option value="hourly">Hourly</option>
					<option value="modular">Modular</option>
				</select>
			</div>

			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Unique ID <sup
						class="text-danger font-weight-bolder">*</sup></label>
				<input type="text" value="<?php echo $project['pid']; ?>" class="form-control" name="pid" maxlength="5" step="1" placeholder="xxxxx"
					pattern="[0-9]{5}" required />
			</div>
		</div>
		<div class="col-12">
			<div class="form-group">
				<label class="text-monospace font-weight-bolder">Description</label>
				<textarea id="ckeditor" value="<?php echo $project['description']; ?>" class="form-control" name="description" placeholder=" "></textarea>
			</div>
		</div>
	</div>
	<div class="text-center col-12">
		<button type="submit" class="btn btn-outline-primary ">Update</button>
	</div>
</div>

<?php endforeach; ?>
<?php echo form_close(); ?>

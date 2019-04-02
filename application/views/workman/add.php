<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Workman Add</h3>
            </div>
            <?php echo form_open('workman/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="name" class="control-label">Name</label>
						<div class="form-group">
							<input type="text" name="name" value="<?php echo $this->input->post('name'); ?>" class="form-control" id="name" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="last_name" class="control-label">Last Name</label>
						<div class="form-group">
							<input type="text" name="last_name" value="<?php echo $this->input->post('last_name'); ?>" class="form-control" id="last_name" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="salary_per_hour" class="control-label">Salary Per Hour</label>
						<div class="form-group">
							<input type="text" name="salary_per_hour" value="<?php echo $this->input->post('salary_per_hour'); ?>" class="form-control" id="salary_per_hour" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="unpaid_hours" class="control-label">Unpaid Hours</label>
						<div class="form-group">
							<input type="text" name="unpaid_hours" value="<?php echo $this->input->post('unpaid_hours'); ?>" class="form-control" id="unpaid_hours" />
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Save
            	</button>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>
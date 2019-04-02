<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Project Edit</h3>
            </div>
			<?php echo form_open('project/edit/'.$project['id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="manager_id" class="control-label">Manager</label>
						<div class="form-group">
							<select name="manager_id" class="form-control">
								<option value="">select manager</option>
								<?php 
								foreach($all_manager as $manager)
								{
									$selected = ($manager['id'] == $project['manager_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$manager['id'].'" '.$selected.'>'.$manager['id'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="employer_id" class="control-label">Employer</label>
						<div class="form-group">
							<select name="employer_id" class="form-control">
								<option value="">select employer</option>
								<?php 
								foreach($all_employer as $employer)
								{
									$selected = ($employer['id'] == $project['employer_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$employer['id'].'" '.$selected.'>'.$employer['id'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="name" class="control-label">Name</label>
						<div class="form-group">
							<input type="text" name="name" value="<?php echo ($this->input->post('name') ? $this->input->post('name') : $project['name']); ?>" class="form-control" id="name" />
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
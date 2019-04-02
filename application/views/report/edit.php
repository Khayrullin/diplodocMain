<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Report Edit</h3>
            </div>
			<?php echo form_open('report/edit/'.$report['id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="task_id" class="control-label">Task</label>
						<div class="form-group">
							<select name="task_id" class="form-control">
								<option value="">select task</option>
								<?php 
								foreach($all_task as $task)
								{
									$selected = ($task['id'] == $report['task_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$task['id'].'" '.$selected.'>'.$task['name'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="workman_id" class="control-label">Workman</label>
						<div class="form-group">
							<select name="workman_id" class="form-control">
								<option value="">select workman</option>
								<?php 
								foreach($all_workman as $workman)
								{
									$selected = ($workman['id'] == $report['workman_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$workman['id'].'" '.$selected.'>'.$workman['name'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="amount" class="control-label">Amount</label>
						<div class="form-group">
							<input type="text" name="amount" value="<?php echo ($this->input->post('amount') ? $this->input->post('amount') : $report['amount']); ?>" class="form-control" id="amount" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="type_of_work" class="control-label">Type Of Work</label>
						<div class="form-group">
							<input type="text" name="type_of_work" value="<?php echo ($this->input->post('type_of_work') ? $this->input->post('type_of_work') : $report['type_of_work']); ?>" class="form-control" id="type_of_work" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="work_hours" class="control-label">Work Hours</label>
						<div class="form-group">
							<input type="text" name="work_hours" value="<?php echo ($this->input->post('work_hours') ? $this->input->post('work_hours') : $report['work_hours']); ?>" class="form-control" id="work_hours" />
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
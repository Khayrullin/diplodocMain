<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Material Add</h3>
            </div>
            <?php echo form_open('material/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="project_id" class="control-label">Project</label>
						<div class="form-group">
                            <select name="task_id" class="form-control">
                                <option value="">select task</option>
                                <?php
                                foreach($all_task as $task)
                                {
                                    $selected = ($task['id'] == $this->input->post('task_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$task['id'].'" '.$selected.'>'.$task['id'].'</option>';
                                }
                                ?>
                            </select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="name" class="control-label">Name</label>
						<div class="form-group">
							<input type="text" name="name" value="<?php echo $this->input->post('name'); ?>" class="form-control" id="name" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="unit" class="control-label">Unit</label>
						<div class="form-group">
							<input type="text" name="unit" value="<?php echo $this->input->post('unit'); ?>" class="form-control" id="unit" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="quantity" class="control-label">Quantity</label>
						<div class="form-group">
							<input type="text" name="quantity" value="<?php echo $this->input->post('quantity'); ?>" class="form-control" id="quantity" />
						</div>
					</div>
                    <div class="col-md-6">
                        <label for="quantity_left" class="control-label">Quantity Left</label>
                        <div class="form-group">
                            <input type="text" name="quantity_left" value="<?php echo $this->input->post('quantity_left'); ?>" class="form-control" id="quantity_left" />
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
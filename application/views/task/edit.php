<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Task Edit</h3>
            </div>
            <?php echo form_open('task/edit/' . $task['id']); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="project_id" class="control-label">Project</label>
                        <div class="form-group">
                            <select name="project_id" class="form-control">
                                <option value="">select project</option>
                                <?php
                                foreach ($all_project as $project) {
                                    $selected = ($project['id'] == $task['project_id']) ? ' selected="selected"' : "";

                                    echo '<option value="' . $project['id'] . '" ' . $selected . '>' . $project['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="status_id" class="control-label">Status</label>
                        <div class="form-group">
                            <select name="status_id" class="form-control">
                                <option value="">select status</option>
                                <?php
                                foreach ($all_status as $status) {
                                    $selected = ($status['id'] == $task['status_id']) ? ' selected="selected"' : "";

                                    echo '<option value="' . $status['id'] . '" ' . $selected . '>' . $status['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="quantity" class="control-label">Quantity</label>
                        <div class="form-group">
                            <input type="text" name="quantity"
                                   value="<?php echo($this->input->post('quantity') ? $this->input->post('quantity') : $task['quantity']); ?>"
                                   class="form-control" id="quantity"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="unit" class="control-label">Unit</label>
                        <div class="form-group">
                            <input type="text" name="unit"
                                   value="<?php echo($this->input->post('unit') ? $this->input->post('unit') : $task['unit']); ?>"
                                   class="form-control" id="unit"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="name" class="control-label">Name</label>
                        <div class="form-group">
                            <input type="text" name="name"
                                   value="<?php echo($this->input->post('name') ? $this->input->post('name') : $task['name']); ?>"
                                   class="form-control" id="name"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="description" class="control-label">Description</label>
                        <div class="form-group">
                            <input type="text" name="description"
                                   value="<?php echo($this->input->post('description') ? $this->input->post('description') : $task['description']); ?>"
                                   class="form-control" id="description"/>
                        </div>
                    </div>
                    <?php
                    $date = DateTime::createFromFormat('Y-m-d h:i:s', $task['deadline']);
                    $deadline = $date->format('m/d/Y h:i A'); ?>

                    <div class="col-md-6">
                        <label for="deadline" class="control-label">Deadline</label>
                        <div class="form-group">
                            <input type="text" name="deadline"
                                   value=" <?php echo $deadline ?>"
                                   class="has-datetimepicker form-control" id="deadline"/>
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
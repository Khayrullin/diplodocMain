<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Редактирование задачи</h3>
            </div>
            <?php echo form_open('task/edit_by_user/' . $task['id']); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="status_id" class="control-label">Статус</label>
                        <div class="form-group">
                            <select name="status_id" class="form-control">
                                <option value="">Выберите статус</option>
                                <?php
                                foreach ($all_status as $status) {
                                    $selected = ($status['id'] == $task['status_id']) ? ' selected="selected"' : "";

                                    echo '<option value="' . $status['id'] . '" ' . $selected . '>' . $status['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php
                    $date = DateTime::createFromFormat('Y-m-d h:i:s', $task['deadline']);
                    $deadline = $date->format('m/d/Y h:i A'); ?>

                    <div class="col-md-6">
                        <label for="deadline" class="control-label">Срок сдачи</label>
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
                    <i class="fa fa-check"></i> Сохранить
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Report Edit</h3>
            </div>
            <?php echo form_open('report/edit_by_user/' . $report['id']); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="status_id" class="control-label">Статус</label>
                        <div class="form-group">
                            <select name="status_id" class="form-control">
                                <option value="">Выберите статус</option>
                                <?php
                                foreach ($all_status as $status) {
                                    $selected = ($status['id'] == $report['status_id']) ? ' selected="selected"' : "";

                                    echo '<option value="' . $status['id'] . '" ' . $selected . '>' . $status['name'] . '</option>';
                                }
                                ?>
                            </select>
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
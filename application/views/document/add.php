<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Document Add</h3>
            </div>
            <?php echo form_open('document/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="report_id" class="control-label">Report</label>
						<div class="form-group">
							<select name="report_id" class="form-control">
								<option value="">select report</option>
								<?php 
								foreach($all_report as $report)
								{
									$selected = ($report['id'] == $this->input->post('report_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$report['id'].'" '.$selected.'>'.$report['id'].'</option>';
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
						<label for="data" class="control-label">Data</label>
						<div class="form-group">
							<input type="text" name="data" value="<?php echo $this->input->post('data'); ?>" class="form-control" id="data" />
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
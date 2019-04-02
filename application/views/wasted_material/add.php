<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Wasted Material Add</h3>
            </div>
            <?php echo form_open('wasted_material/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="material_id" class="control-label">Material</label>
						<div class="form-group">
							<select name="material_id" class="form-control">
								<option value="">select material</option>
								<?php 
								foreach($all_materials as $material)
								{
									$selected = ($material['id'] == $this->input->post('material_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$material['id'].'" '.$selected.'>'.$material['name'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
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
						<label for="amount" class="control-label">Amount</label>
						<div class="form-group">
							<input type="text" name="amount" value="<?php echo $this->input->post('amount'); ?>" class="form-control" id="amount" />
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
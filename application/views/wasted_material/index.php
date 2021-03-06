<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Wasted Materials Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('wasted_material/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Material Id</th>
						<th>Report Id</th>
						<th>Amount</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($wasted_materials as $w){ ?>
                    <tr>
						<td><?php echo $w['id']; ?></td>
						<td><?php echo $w['material_id']; ?></td>
						<td><?php echo $w['report_id']; ?></td>
						<td><?php echo $w['amount']; ?></td>
						<td>
                            <a href="<?php echo site_url('wasted_material/edit/'.$w['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('wasted_material/remove/'.$w['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>

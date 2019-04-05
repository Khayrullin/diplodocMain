<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Materials Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('material/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
                        <th>Task Id</th>
						<th>Name</th>
						<th>Unit</th>
						<th>Quantity</th>
                        <th>Quantity left</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($materials as $m){ ?>
                    <tr>
						<td><?php echo $m['id']; ?></td>
                        <td><?php echo $m['task_id']; ?></td>
						<td><?php echo $m['name']; ?></td>
						<td><?php echo $m['unit']; ?></td>
                        <td><?php echo $m['quantity_left']; ?></td>
						<td>
                            <a href="<?php echo site_url('material/edit/'.$m['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('material/remove/'.$m['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>

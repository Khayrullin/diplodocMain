<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Task Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('task/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Project Id</th>
						<th>Status Id</th>
						<th>Quantity</th>
						<th>Unit</th>
						<th>Name</th>
						<th>Description</th>
						<th>Deadline</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($task as $T){ ?>
                    <tr>
						<td><?php echo $T['id']; ?></td>
						<td><?php echo $T['project_id']; ?></td>
						<td><?php echo $T['status_id']; ?></td>
						<td><?php echo $T['quantity']; ?></td>
						<td><?php echo $T['unit']; ?></td>
						<td><?php echo $T['name']; ?></td>
						<td><?php echo $T['description']; ?></td>
						<td><?php echo $T['deadline']; ?></td>
						<td>
                            <a href="<?php echo site_url('task/edit/'.$T['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('task/remove/'.$T['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>

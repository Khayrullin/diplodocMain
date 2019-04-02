<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Manager Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('manager/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>User Id</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($manager as $m){ ?>
                    <tr>
						<td><?php echo $m['id']; ?></td>
						<td><?php echo $m['user_id']; ?></td>
						<td>
                            <a href="<?php echo site_url('manager/edit/'.$m['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('manager/remove/'.$m['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Workman Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('workman/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Name</th>
						<th>Last Name</th>
						<th>Salary Per Hour</th>
						<th>Unpaid Hours</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($workman as $w){ ?>
                    <tr>
						<td><?php echo $w['id']; ?></td>
						<td><?php echo $w['name']; ?></td>
						<td><?php echo $w['last_name']; ?></td>
						<td><?php echo $w['salary_per_hour']; ?></td>
						<td><?php echo $w['unpaid_hours']; ?></td>
						<td>
                            <a href="<?php echo site_url('workman/edit/'.$w['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('workman/remove/'.$w['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
            </div>
        </div>
    </div>
</div>

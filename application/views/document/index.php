<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Documents Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('document/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Report Id</th>
						<th>Name</th>
						<th>Data</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($documents as $d){ ?>
                    <tr>
						<td><?php echo $d['id']; ?></td>
						<td><?php echo $d['report_id']; ?></td>
						<td><?php echo $d['name']; ?></td>
						<td><?php echo $d['data']; ?></td>
						<td>
                            <a href="<?php echo site_url('document/edit/'.$d['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('document/remove/'.$d['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Report Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('report/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Task Id</th>
						<th>Workman Id</th>
						<th>Amount</th>
						<th>Type Of Work</th>
						<th>Work Hours</th>
						<th>Sendtime</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($report as $r){ ?>
                    <tr>
						<td><?php echo $r['id']; ?></td>
						<td><?php echo $r['task_id']; ?></td>
						<td><?php echo $r['workman_id']; ?></td>
						<td><?php echo $r['amount']; ?></td>
						<td><?php echo $r['type_of_work']; ?></td>
						<td><?php echo $r['work_hours']; ?></td>
						<td><?php echo $r['sendtime']; ?></td>
						<td>
                            <a href="<?php echo site_url('report/edit/'.$r['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a>
                            <a href="<?php echo site_url('report/remove/' . $r['id']); ?>"
                               class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Документы отчета "<?php echo $report['type_of_work']; ?>"</h3>
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

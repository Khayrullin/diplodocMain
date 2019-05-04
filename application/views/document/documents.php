<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Документы отчета "<?php echo $report['type_of_work']; ?>"</h3>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Имя файла</th>
						<th>Файл</th>
                    </tr>
                    <?php foreach($documents as $d){ ?>
                    <tr>
						<td><?php echo $d['name']; ?></td>
                        <td> <img src="<?php echo $d['data']?>" /> </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>

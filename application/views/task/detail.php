<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Задача "<?php echo $task['name']; ?>" </h3>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
                        <th>Задача</th>
                        <th>Описание</th>
                        <th>Проект</th>
                        <th>Количество</th>
                        <th>Ед. Измерения</th>
                        <th>Дедлайн</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>

                    <tr>
                        <td><?php echo $task['name']; ?></td>
                        <td><?php echo $task['description']; ?></td>
                        <td><?php echo $task['project_id']; ?></td>
                        <td><?php echo $task['quantity']; ?></td>
                        <td><?php echo $task['unit']; ?></td>
                        <td><?php echo $task['deadline']; ?></td>
                        <td><?php echo $status['name']; ?></td>

                        <td>
                            <a href="<?php echo site_url('task/edit_by_user/' . $task['id']); ?>"
                               class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Отчеты по задаче</h3>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
                        <th>Тип работы</th>
                        <th>Объём работы</th>
                        <th>Потраченые материалы</th>
                        <th>Имя рабочего</th>
                        <th>Время работы</th>
                        <th>Дата отправки</th>
                        <th>Документы</th>
                        <th>Действия</th>
                    </tr>
                    <?php foreach ($report as $r) { ?>
                        <tr>
                            <td><?php echo $r['type_of_work']; ?></td>
                            <td><?php echo $r['amount']; ?></td>
                            <td>-</td>
                            <td><?php echo $r['workman_id']; ?></td>


                            <td><?php echo $r['work_hours']; ?></td>
                            <td><?php echo $r['sendtime']; ?></td>
                            <td>Документы</td>
                            <td>
                                <a href="<?php echo site_url('report/edit/' . $r['id']); ?>"
                                   class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a>
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

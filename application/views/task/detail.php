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
                        <th>План работ</th>
                        <th>Выполнено</th>
                        <th>Осталось</th>
                        <th>Ед. Измерения</th>
                        <th>Дедлайн</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>

                    <tr>
                        <td><?php echo $task['name']; ?></td>
                        <td><?php echo $task['description']; ?></td>
                        <td><?php echo $project['name']; ?></td>
                        <td><?php echo $task['quantity']; ?></td>
                        <td><?php echo $task['quantity_done']; ?></td>
                        <td><?php echo $task['quantity_left']; ?></td>
                        <td><?php echo $task['unit']; ?></td>
                        <td><?php echo $task['deadline']; ?></td>
                        <td><?php echo $status['name']; ?></td>


                        <td>
                            <a href="<?php echo site_url('task/edit_by_user/' . $task['id']); ?>"
                               class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Список материалов </h3>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
                        <th>Название</th>
                        <th>Ед. Измерения</th>
                        <th>План</th>
                        <th>Остаток</th>
                    </tr>
                    <?php foreach ($materials as $m) { ?>
                        <tr>
                            <td><?php echo $m['name']; ?></td>
                            <td><?php echo $m['unit']; ?></td>
                            <td><?php echo $m['quantity']; ?></td>
                            <td><?php echo $m['quantity_left']; ?></td>
                        </tr>
                    <?php } ?>
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
                        <th>Статус</th>
                        <th>Документы</th>
                        <th>Действия</th>
                    </tr>
                    <?php foreach ($report as $r) { ?>
                        <tr>
                            <td><?php echo $r['type_of_work']; ?></td>
                            <td><?php echo $r['amount']; ?></td>
                            <td>
                                <table class="table">
                                    <tr>
                                        <th>Материал</th>
                                        <th>Израсходовано</th>
                                    </tr>
                                    <?php foreach ($wasted

                                    as $w) { ?>
                                    <tr>
                                        <? if ($w['report_id'] == $r['id']) { ?>
                                            <td><?php
                                                foreach ($materials as $m) {
                                                    if ($m['id'] == $w['material_id']) {
                                                        echo $m['name'];
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $w['amount']; ?></td>
                                        <? } ?>
                                        <? } ?>
                                    </tr>
                                </table>
                            </td>
                            <td><?php
                                foreach ($workers as $w) {
                                    if ($w['id'] == $r['workman_id']) {
                                        echo $w['name'] . " " . $w['last_name'];
                                    }
                                }
                                ?></td>


                            <td><?php echo $r['work_hours']; ?></td>
                            <td><?php echo $r['sendtime']; ?></td>
                            <td><?php
                                foreach ($statuses as $s) {
                                    if ($s['id'] == $r['status_id']) {
                                        echo $s['name'];
                                    }
                                }
                                ?></td>
                            <td><a href="<?php echo site_url('document/get_documents/' . $r['id']); ?>"
                                   class="btn btn-info btn-xs" style="background-color: #17a51b; border-color: #158416">Файлы </a>
                            </td>
                            <td>
                                <a href="<?php echo site_url('report/edit_by_user/'.$r['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Изменить статус</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo $project['name'] . "s tasks"; ?> </h3>
                <div class="box-tool" style="position: relative; float: right; width: 60%">
                    <a href="<?php echo site_url('task/export/'. $project['id']); ?>" style="background-color: #1dad3b; color: white; float: right" class="btn btn-sm">Экспорт</a>
                    <form style="float: right; width: 300px; height: 40px" action="<?php echo site_url('task/import/'. $project['id']); ?>" method="post" enctype="multipart/form-data">
                        <input style="width: 250px; margin-top: 4px;" type="file" name="csv" value=""/>
                        <input type="submit" style="position: absolute; margin-top: -26px; margin-left: 230px; background-color: #0f8adf; color: white" class="btn btn-sm" name="submit" value="Импорт"/></form>
                </div>

            </div>
            <div class="box-body">

                <table class="table table-striped">
                    <tr>
                        <th>Задача</th>
                        <th>Дедлайн</th>
                        <th>Текущий статус</th>
                    </tr>
                    <?php foreach ($task as $T) {
                        if (strtotime($T['deadline']) > strtotime('today')) { ?>
                            <tr>
                                <td>

                                    <a href="<?php echo site_url('task/get_detail/' . $T['id']); ?>">
                                        <?php echo $T['name']; ?></a>

                                </td>
                                <td><?php echo $T['deadline']; ?></td>
                                <td><?php
                                    foreach ($status as $s) {
                                        if ($T['status_id'] == $s['id']) {
                                            echo $s['name'];
                                        }
                                    }
                                    ?>

                                </td>
                            </tr>
                        <?php }
                    } ?>
                </table>
            </div>


            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Просроченные задачи </h3>
                </div>
                <div class="box-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Задача</th>
                            <th>Дедлайн</th>
                            <th>Текущий статус</th>
                        </tr>
                        <?php foreach ($task as $T) {
                            if (strtotime($T['deadline']) < strtotime('today')) { ?>
                                <tr>
                                    <td>

                                        <a href="<?php echo site_url('task/get_detail/' . $T['id']); ?>">
                                            <?php echo $T['name']; ?></a>

                                    </td>
                                    <td><?php echo $T['deadline']; ?></td>
                                    <td><?php
                                        foreach ($status as $s) {
                                            if ($T['status_id'] == $s['id']) {
                                                echo $s['name'];
                                            }
                                        }
                                        ?>

                                    </td>
                                </tr>
                            <?php }
                        } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

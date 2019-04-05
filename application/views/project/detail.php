<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo $project['name'] . "s tasks"; ?> </h3>
            </div>
            <div class="box-body">

                <table class="table table-striped">
                    <tr>
                        <th>Задача</th>
                        <th>Дедлайн</th>
                        <th>Текущий статус</th>
                    </tr>
                    <?php foreach ($task as $T) { ?>
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
                    <?php } ?>
                </table>

            </div>
        </div>
    </div>
</div>

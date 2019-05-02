<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Список проектов</h3>
                <div class="box-tools">
                    <a href="<?php echo site_url('project/add'); ?>" class="btn btn-success btn-sm">Add</a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
                        <th>Название проекта</th>
                        <th>Имя прораба</th>
                    </tr>
                    <?php foreach ($project as $p) { ?>
                        <tr>
                            <td>
                                <a href="<?php echo site_url('project/get_detail/' . $p['id']); ?>">
                                    <?php echo $p['name']; ?></a>
                            </td>
                            <td><?php
                                foreach ($manager as $m) {
                                    if ($p['manager_id'] == $m['id']) {
                                        foreach ($users as $prorab) {
                                            if ($m['user_id'] == $prorab['id']) {
                                                echo $prorab['first_name']." ". $prorab['last_name'];
                                            }
                                        }

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

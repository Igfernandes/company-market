<div id="group-btns">
</div>
<div class="table-content">
    <div class="table-wapper overflow-auto" >
        <table id="<?= $id ? $id : 'example1' ?>" class="table table-bordered table-striped" <?= $attributes ?>>
            <thead>
                <tr>
                    <?php foreach ($table->columns as $column) :  ?>
                        <th style="width:<?= $column->width ?>%"><?= $column->title ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($table->data)) :
                    foreach ($table->data as $data) : ?>

                    <?php endforeach; ?>
                <?php else : ?>
                    <tr class="text-center">
                        <td colspan="<?= count($table->columns) ?>">Não foi possível encontrar registros</td>
                    </tr>
                <?php endif ?>
            </tbody>
            <tfoot>
                <tr>
                    <?php foreach ($table->columns as $column) :  ?>
                        <th style="width:<?= $column->width ?>%"><?= $column->title ?></th>
                    <?php endforeach; ?>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
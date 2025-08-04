<table id="<?= esc($id) ?>" class="<?= esc($class) ?>" component="table">
    <thead>
        <tr class="">
            <?php foreach ($dataTitles as $title): ?>
                <th class=""><?= empty($title) ? '---' : esc($title) ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataTable as $row): ?>
            <tr class="">
                <?php foreach ($row as $cell): ?>
                    <td class=""><?= empty($cell) ? '---' : esc($cell) ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?> 
    </tbody>
</table>
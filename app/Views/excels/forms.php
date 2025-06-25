<?php
$headers = array_map(fn(array $field) => $field['name'], $form[0]);
?>

<table>
    <tr>
        <?php foreach ($headers as $header): ?>
            <th>
                <?= $header ?>
            </th>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($form as $row): ?>
        <tr>
            <?php foreach ($row as $td): ?>
                <td>
                    <?= $td['value'] ?>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>
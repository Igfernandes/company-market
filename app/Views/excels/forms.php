<?php
$headers = array_map(fn(array $field) => $field['name'], $forms[0]);
?>

<table>
    <tr>
        <?php foreach ($headers as $header): ?>
            <th>
                <?= $header ?>
            </th>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($forms as $row): ?>
        <tr>
            <?php foreach ($row as $td): ?>
                <td>
                    <?php if (strstr($td['value'], "writable")): ?>
                       <span>ANEXO [BAIXE DIRETAMENTE NO REGISTRO]</span>
                    <?php else : ?>
                        <?= $td['value'] ?>
                    <?php endif; ?>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>
<?php
$headerStyled = "background-color: #d5ae82;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;"

?>
<?php if (is_array($users)):
    foreach ($users as $key => $user): ?>
        <br>
        <table>
            <thead>
                <tr style="border: 10px solid #000;">
                    <th colspan="11" style="font-family: Arial; 
            font-size: 20rem;color: white;
             text-align: center; background-color: #d5ae82; 
             padding: 100px;">Informações do Usuário</th>
                </tr>
            </thead>
            <tbody>
                <?php $fieldsGroup =  [];
                if (isset($user['fields'])) {
                    $fieldsGroup =  $user['fields'];
                    unset($user['fields']);
                }
                if (isset($fieldsGroup['ATTACHMENTS'])) {
                    $files = $fieldsGroup['ATTACHMENTS'];
                    unset($fieldsGroup['ATTACHMENTS']);
                } else
                    $files = [];
                ?>

                <?php foreach ($user as $key => $value): ?>
                    <?php if (is_array($value) || is_object($value)): ?>
                        <tr>
                            <td colspan="4" class="label"><?= ucfirst($key) ?></td>
                            <td colspan="7" class="value">
                                <pre><?= json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?></pre>
                            </td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="label"><?= ucfirst($key) ?></td>
                            <td colspan="7" class="value"><?= $value ?></td>
                        </tr>
                    <?php endif; ?>
                    <?php endforeach;
                if (is_array($fieldsGroup)):
                    foreach ($fieldsGroup as $groupField => $fields):
                    ?>
                        <tr>
                            <td colspan="11" style="<?= $headerStyled ?>"><?= lang("Words." . strtolower($groupField)) ?></td>
                        </tr>
                        <?php if (is_array($fields)):
                            foreach ($fields as $field): ?>
                                <tr>
                                    <td colspan="4" class="label"><?= $field->name ?? 'Inválido' ?></td>
                                    <td colspan="7" class="value"><?= $field->value ?></td>
                                </tr>
                    <?php
                            endforeach;
                        endif;
                    endforeach;
                endif;
                if (!empty($files) && is_array($files)): ?>
                    <tr>
                        <td colspan="2" style="<?= $headerStyled ?>"><?= lang("Words.attachments") ?></td>
                    </tr>
                    <?php foreach ($files as $file): ?>
                        <tr>
                            <td class="label"><?= $file->name ?? 'Arquivo' ?></td>
                            <td class="value"><?= $file->value ?? 'Indisponível' ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
<?php endforeach;
endif; ?>
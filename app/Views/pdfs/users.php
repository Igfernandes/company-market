<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin-bottom: 80px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background-color: #8B0000;
            color: white;
            font-size: 20px;
            padding: 20px;
            text-align: center;
        }

        td,
        th {
            border: 1px solid #ccc;
            padding: 8px;
            vertical-align: top;
            word-break: break-word;
        }

        .section-header {
            background-color: #d5ae82;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
        }

        .label {
            font-weight: bold;
            width: 30%;
            background-color: #f9f9f9;
        }

        .value {
            width: 70%;
            white-space: pre-wrap;
        }

        .fixed-footer {
            position: fixed;
            bottom: 10px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ccc;
            padding-top: 5px;
        }
    </style>
</head>

<body>
    <?php if (is_array($users)):
        foreach ($users as $index => $user): ?>
            <table>
                <thead>
                    <tr>
                        <th colspan="2">Informações do Usuário</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $fieldsGroup =  [];
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
                                <td class="label"><?= ucfirst($key) ?></td>
                                <td class="value">
                                    <pre><?= json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?></pre>
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td class="label"><?= ucfirst($key) ?></td>
                                <td class="value"><?= $value ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php endforeach;
                    if (is_array($fieldsGroup)):
                        foreach ($fieldsGroup as $groupField => $fields):
                        ?>
                            <tr>
                                <td colspan="2" class="section-header"><?= lang("Words." . strtolower($groupField)) ?></td>
                            </tr>
                            <?php if (is_array($fields)):
                                foreach ($fields as $field): ?>
                                    <tr>
                                        <td class="label"><?= $field->name ?? 'Inválido' ?></td>
                                        <td class="value"><?= $field->value ?></td>
                                    </tr>
                        <?php
                                endforeach;
                            endif;
                        endforeach;
                    endif;
                    if (!empty($files) && is_array($files)): ?>
                        <tr>
                            <td colspan="2" class="section-header"><?= lang("Words.attachments") ?></td>
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
            <?php if ($index < count($users) - 1): ?>
                <div style="page-break-after: always;"></div>
            <?php endif; ?>
    <?php endforeach;
    endif; ?>
    <div class="fixed-footer">
        © <?= date("Y") ?> <?= getenv("globals.company.name") ?> LTDA. CNPJ <?= getenv("globals.company.cnpj") ?><br>
        <?= getenv("globals.company.phone") ?> | <?= getenv("globals.company.email") ?>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin-bottom: 80px;
            /* espaço para o rodapé fixo */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            /* força controle de largura das colunas */
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
            word-wrap: break-word;
            word-break: normal;
            white-space: normal;
        }

        .section-header {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            font-size: 14px;
        }

        .label {
            font-weight: bold;
            width: 30%;
        }

        .value {
            width: 70%;
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
    <?php foreach ($forms as $index => $register): ?>
        <?php if (count($register) > 2): ?>
            <table>
                <thead>
                    <tr>
                        <th colspan="11"><?= $title ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($service)): ?>
                        <tr>
                            <td class="label" colspan="3"><?= lang("Words.event") ?>:</td>
                            <td class="value" colspan="8"><?= $service ?? "" ?></td>
                        </tr>
                    <?php endif; ?>

                    <?php if (!empty($description)): ?>
                        <tr>
                            <td class="label" colspan="3"><?= lang("Words.description") ?>:</td>
                            <td class="value" colspan="8"><?= $description ?? "" ?></td>
                        </tr>
                    <?php endif; ?>

                    <tr>
                        <td colspan="11" class="section-header"><?= lang("Words.report") ?></td>
                    </tr>

                    <?php if (is_array($register)): ?>
                        <?php foreach ($register as $field): ?>
                            <tr>
                                <td class="label" colspan="4"><?= $field['name'] ?></td>
                                <td class="value" colspan="7"><?= $field['value'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>

            <?php if ($index < count($forms) - 1): ?>
                <div style="page-break-after: always;"></div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <div class="fixed-footer">
        © <?= date("Y") ?> <?= getenv("globals.company.name") ?> LTDA. CNPJ <?= getenv("globals.company.cnpj") ?><br>
        <?= getenv("globals.company.phone") ?> | <?= getenv("globals.company.email") ?>
    </div>

</body>

</html>
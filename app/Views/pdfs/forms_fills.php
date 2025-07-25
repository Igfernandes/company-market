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
            background-color: #f0f0f0;
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

        .spacer {
            height: 100px;
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
    <table>
        <thead>
            <tr>
                <th colspan="2"><?= $title ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($service)): ?>
                <tr>
                    <td class="label"><?= lang("Words.event") ?>:</td>
                    <td class="value"><?= $service ?? "" ?></td>
                </tr>
            <?php endif; ?>

            <?php if (!empty($description)): ?>
                <tr>
                    <td class="label"><?= lang("Words.description") ?>:</td>
                    <td class="value"><?= $description ?? "" ?></td>
                </tr>
            <?php endif; ?>

            <tr>
                <td class="label"><?= lang("Words.filled_at") ?>:</td>
                <td class="value"><?= DateTime::createFromFormat("Y-m-d H:i:s", $filledAt)->format("d/m/Y H:i:s") ?? "" ?></td>
            </tr>

            <tr>
                <td colspan="2" class="section-header"><?= lang("Words.report") ?></td>
            </tr>

            <?php if (is_array($fields)):
                foreach ($fields as $field): ?>
                    <tr>
                        <td class="label"><strong><?= $field['name'] ?></strong></td>
                        <td class="value"><?= $field['value'] ?></td>
                    </tr>
            <?php endforeach;
            endif; ?>

            <tr>
                <td colspan="2" class="section-header"><?= lang("Words.attachments") ?></td>
            </tr>

            <?php if (is_array($files)):
                foreach ($files as $file): ?>
                    <tr>
                        <td class="label"><strong><?= $file['name'] ?></strong></td>
                        <td class="value">
                            <?php if (is_file($file['value']) && getimagesize($file['value'])): ?>
                                <?php $imageData = base64_encode(file_get_contents($file['value']));
                                $imageSrc = 'data:image/jpeg;base64,' . $imageData; ?>
                                <img style="width: 300px; object-fit: contain;" src="<?= $imageSrc ?>">
                            <?php else: ?>
                                <span><?= getPublicUrl($file['value']) ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
            <?php endforeach;
            endif; ?>
        </tbody>
    </table>

    <div class="fixed-footer">
        © <?= date("Y") ?> <?= getenv("globals.company.name") ?> LTDA. CNPJ <?= getenv("globals.company.cnpj") ?><br>
        <?= getenv("globals.company.phone") ?> | <?= getenv("globals.company.email") ?>
    </div>
</body>

</html>

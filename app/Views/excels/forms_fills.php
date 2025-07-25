<?php helper(["files"]) ?>
<table>
    <thead>
        <tr style="border: 10px solid #000;">
            <th colspan="11" style="font-family: Arial; 
            font-size: 20rem;color: white;
             text-align: center; background-color: brown; 
             padding: 100px;">
                <p><?= $title ?></p>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($service)): ?>
            <tr>
                <td colspan="3">
                    <p><strong><?= lang("Words.event") ?>:</strong></p>
                </td>
                <td colspan="8">
                    <p> <?= $service ?? "" ?></p>
                </td>
            </tr>
        <?php endif; ?>
        <?php if (!empty($description)): ?>
            <tr>
                <td colspan="3">
                    <p><strong><?= lang("Words.description") ?>:</strong></p>
                </td>
                <td colspan="8">
                    <p> <?= $description ?? "" ?></p>
                </td>
            </tr>
        <?php endif; ?>
        <tr>
            <td colspan="3">
                <p><strong><?= lang("Words.filled_at") ?>:</strong>
                </p>
            </td>
            <td colspan="8">
                <p> <?= DateTime::createFromFormat("Y-m-d H:i:s",  $filledAt)->format("d/m/Y H:i:s") ?? "" ?></p>
            </td>
        </tr>
        <tr>
            <td colspan="11" style="text-align: center;font-family: Calibri;">
                <strong><?= lang("Words.report") ?></strong>
            </td>
        </tr>
        <?php if (is_array($fields)):
            foreach ($fields as $field): ?>
                <tr style="text-align: left;">
                    <td colspan="2" style="width: 50px;">
                        <strong><?= $field['name'] ?></strong>
                    </td>
                    <td colspan="9">
                        <?= $field['value'] ?>
                    </td>
                </tr>
        <?php endforeach;
        endif; ?>
        <tr>
            <td colspan="11" style="text-align: center;">
                <strong><?= lang("Words.attachments") ?></strong>
            </td>
        </tr>

        <?php if (is_array($files)):
            foreach ($files as $file): ?>
                <tr>
                    <td colspan="4">
                        <span><strong> <?= $file['name'] ?></strong></span>
                    </td>
                    <td colspan="8">
                        <span><?= getPublicUrl($file['value'])  ?></span>
                    </td>
                </tr>
        <?php endforeach;
        endif; ?>
    </tbody>
</table>
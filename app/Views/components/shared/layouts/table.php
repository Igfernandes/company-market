<?php
if (isset($attributes)) {
    $attributesRef = [];
    foreach ($attributes as $index => $attribute) {
        if (empty($attribute)) continue;
        array_push($attributesRef, join("=", [$index, $attribute]));
    }

    $attributeData = join(" ", $attributesRef);
}
?>

<div class="<?= esc($class) ?> w-full bg-white p-4 rounded-lg"
    id="<?= esc($id) ?>"
    component="table"
    data-heads="<?= join("/", $heads) ?>"
    <?= is_array($relations) && count($relations) > 0 ? "table-relations='" . join(",", $relations) . "'" : "" ?>
    data-ajax="<?= $ajax ?>"
    <?= $update ? "data-update-action='$update'" : null ?>
    <?= $delete ? "data-delete-action='$delete'" : null ?>
    <?= $checked ? "checked='true'" : null ?>
    <?= !empty($attributeData) ? $attributeData : null ?>>
    <table id="<?= esc($id) ?>_<?= esc(date("YmdHis")) ?>">
        <?php if (is_array($heads)): ?>
            <thead>
                <tr>
                    <?php foreach ($heads as $tHead): ?>
                        <th><?= empty($tHead) ? '---' : esc($tHead) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
        <?php endif; ?>
        <tbody>
            <?php foreach ($data as $row): ?>
                <tr class="trow">
                    <?php foreach ($row as $cell): ?>
                        <td class=""><?= empty($cell) ? '---' : esc($cell) ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
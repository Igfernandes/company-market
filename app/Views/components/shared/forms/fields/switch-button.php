<?php
$session = session();
$storeValue = $session->get($form ?? "");
$attributeData = "";

if (isset($attributes)) {
    $attributesRef = [];
    foreach ($attributes as $index => $attribute) {
        if (empty($attribute)) continue;
        array_push($attributesRef, join("=", [$index, $attribute]));
    }

    $attributeData = join(" ", $attributesRef);
}

if (isset($storeValue[$name]))
    $value = $storeValue[$name];

if (isset($readonly)) {
    $readonly = "readonly";
}

$id = !empty($id) ? $id : uniqid(str_replace("[]", "", $name));
?>

<div class="switch" component='switch-button'>
    <div class="switch-content flex items-center"
        <?= !empty($attributeData) ? $attributeData : null ?>>
        <label class="label-left cursor-pointer <?= $class ?>" for="left_<?= $id ?>">
            <input type="radio"
                id="left_<?= $id ?>"
                name="<?= $name ?>"
                value="<?= isset($left['value']) ? $left['value'] : null ?>"
                class="radio appearance-none rounded-xs p-[7px] cursor-pointer <?= $class ?? "" ?>"
                data-label="<?= $label ?>"
                <?= $value == $left['value'] || empty($value) ? "checked" : null ?>
                <?= !empty($attributeData) ? $attributeData : null ?>>
            <span> <strong><?= ucfirst($left['title']) ?></strong></span>
            <span class="slide"> </span>
        </label>
        <label class="label-right cursor-pointer <?= $class ?>" for="right_<?= $id ?>">
            <input
                type="radio"
                name="<?= $name ?>"
                value="<?= isset($right['value']) ? $right['value'] : null ?>"
                id="right_<?= $id ?>"
                class="radio appearance-none rounded-xs p-[7px] cursor-pointer <?= $class ?? "" ?>"
                <?= $value == $right['value'] || empty($value) ? "checked" : null ?>
                <?= $required ? "true" : null ?>
                <?= strval($readonly) ?? null ?>>
            <span> <strong><?= ucfirst($right['title']) ?></strong></span>
            <span class="slide"> </span>
        </label>
    </div>
</div>
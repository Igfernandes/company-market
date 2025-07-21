<?php
$session = session();
$storeValue = $session->get($form);
$attributeData = "";

if (isset($attributes)) {
    $attributesRef = [];
    foreach ($attributes as $index => $attribute) {
        array_push($attributesRef, join("=", [$index, $attribute]));
    }

    $attributeData = join(" ", $attributesRef);
}
?>

<div class="form-group">
    <label for="<?= $id ?? $name ?>">
        <strong>
            <i>
                <?= ucfirst($label) ?>
                <?= isset($required) && $required == "required" ?  view("/components/shared/forms/tooltip/required") : null ?>:
            </i>
        </strong>
    </label>
    <div class="p-relative mb-3 d-flex">
        <div class="w-100">
            <select name="<?= $name ?>" id="<?= $id ?? $name ?>" data-label="<?= $label ?>" class="form-control select2 <?= $class ?? null ?>" <?= !empty($attributeData) ? $attributeData : null ?> <?= isset($disabled) ? $disabled : null ?> <?= $required ? "required" : null ?>>
                <?php foreach ($options as $option) : ?>
                    <option value="<?= isset($option['value']) ? $option['value'] : 'null' ?>" <?= isset($storeValue[$name]) && $storeValue[$name] === $option['value'] || isset($value) && $value === $option['value'] ? "selected" : null ?>><?= $option['text'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-tooltip" data-invalid="<?= $name ?>">
                <?= lang("Register.invalid.select") ?>
            </div>
        </div>
        <div class="input-group-append" style="width: 45px;">
            <div class="input-group-text">
                <span>
                    <?= $icon ?>
                </span>
            </div>
        </div>
    </div>
</div>
<?php
$session = session();
$storeValue = $session->get($form);
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

?>

<div class="form-group">
    <?php if (!isset($labelNot)) : ?>
        <label for="<?= $id ?? $name ?>">
            <strong>
                <i>
                    <?= ucfirst($label) ?>
                    <?= isset($required) && $required == "required" ?  view("/components/shared/forms/tooltip/required") : null ?>:
                </i>
            </strong>
        </label>
    <?php endif; ?>
    <div class="d-flex p-relative mb-3">
        <div class="w-100">
            <input type="<?= isset($type) ? $type : "text" ?>" name="<?= $name ?>" value="<?= isset($value) ? $value : null ?>" id="<?= $id ?? $name ?>" data-label="<?= $label ?>" class="form-control <?= $className ?? null ?>" placeholder="<?= $placeholder ?? null ?>" <?= !empty($attributeData) ? $attributeData : null ?> <?= isset($disabled) ? $disabled : null  ?> <?= $required ? "required" : null ?> <?= isset($storeValue[$name]) && $storeValue[$name] == $value && isset($type) && ($type == "checkbox" || $type == "radio")  ? "checked" : null  ?> <?= $readonly ?? null ?>>
            <div class="invalid-tooltip" data-invalid="<?= $name ?>">
                <?= lang("Register.invalid.input") ?>
            </div>
        </div>
        <?php if (isset($icon)) : ?>
            <div class="input-group-append" style="width: 45px;">
                <div class="input-group-text">
                    <span>
                        <?= $icon ?>
                    </span>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
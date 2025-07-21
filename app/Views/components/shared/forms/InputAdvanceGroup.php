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

<div class="form-group row  align-items-center my-2">
    <?php if (!isset($labelNot)) : ?>
        <div  class="col-12 <?= isset($column->label) ?  $column->label  : "col-md-3" ?>">
            <label for="<?= $id ?? $name ?>" class="d-flex">
                <?= ucfirst($label) ?>
                <?= isset($required) && $required == "required" ?  view("/components/shared/forms/tooltip/required") : null ?>
            </label>
        </div>
    <?php endif; ?>
    <div class="d-flex p-relative col-12  <?= isset($column->input) ?  $column->input  : "col-md-9" ?>">
        <div class="w-100">
            <input type="<?= isset($type) ? $type : "text" ?>" name="<?= $name ?>" value="<?= isset($value) ? $value : null ?>" id="<?= $id ?? $name ?>" data-label="<?= $label ?>" class="form-control <?= $className ?? null ?>" placeholder="<?= $placeholder ?? null ?>" <?= !empty($attributeData) ? $attributeData : null ?> <?= isset($disabled) ? $disabled : null  ?> <?= isset($required) ? "required" : null ?> <?= isset($storeValue[$name]) && $storeValue[$name] == $value && isset($type) && ($type == "checkbox" || $type == "radio")  ? "checked" : null  ?> <?= $readonly ?? null ?>>
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
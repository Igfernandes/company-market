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

?>

<div class="checkbox">
    <div class="">
        <input type="checkbox"
            name="<?= $name ?>"
            value="<?= isset($value) ? $value : null ?>"
            id="<?= $id ?? $name ?>"
            class="checkbox appearance-none bg-accent rounded-xs p-[7px] cursor-pointer text-accent <?= $class ?? "" ?>"
            data-label="<?= $label ?>"
            <?= $checked ? "checked" : null ?>
            <?= !empty($attributeData) ? $attributeData : null ?>
            <?= isset($disabled) ? strval($disabled) : null  ?>
            <?= $required ? "true" : null ?>
            <?= isset($storeValue[$name]) && $storeValue[$name] == $value && isset($type) ?>
            <?= strval($readonly) ?? null ?>>
        <label class="form-check-label" for="<?= $id ?? $name ?>">
            <?= ucfirst($label) ?>
            <?= isset($required) && $required == "true" ?  Component("/components/shared/forms/tooltip/required") : "" ?>
        </label>
    </div>
</div>
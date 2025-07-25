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

if (isset($name) && isset($storeValue[$name]))
    $value = $storeValue[$name];

?>

<div class="d-flex flex-column">
    <?php if (!isset($labelNot)) : ?>
        <label for="<?= $id ?? $name ?>" >
            <strong>
                <i>
                    <?= ucfirst($label) ?>
                    <?= isset($required) && $required == "required" ?  view("/components/shared/forms/tooltip/required") : null ?>
                </i>
            </strong>
        </label>
    <?php endif; ?>
    <div class="p-relative mb-3">
        <div class="w-100">
            <input type="email"
                name="<?= $name ?>" 
                value="<?= isset($name) ? $name : null ?>" 
                id="<?= $id ?? $name ?>" 
                data-label="<?= $label ?>" 
                class="bg-gray-100 rounded text-gray-600 email <?= $className ?? null ?>"
                placeholder="<?= $placeholder ?? null ?>" 
                <?= !empty($attributeData) ? $attributeData : null ?> 
                <?= isset($disabled) ? strval($disabled) : null  ?> 
                <?= $required ? "required" : null ?> 
                <?= isset($storeValue[$name]) && $storeValue[$name] == $value && isset($type) ?> 
                <?= strval($readonly) ?? null ?>
                >
        </div>
        <?php if (isset($icon)) : ?>
            <div class="" style="width: 45px;">
                <div class="bd-radius-100 d-flex justify-content-center align-items-center h-100 bg-white">
                    <span>
                        <?= $icon ?>
                    </span>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
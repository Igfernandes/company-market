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

<div class="email relative">
    <div class="p-relative mb-3">
        <div class="w-100">
            <input type="email"
                name="<?= $name ?>"
                value="<?= isset($name) ? $name : null ?>"
                id="<?= $id ?? $name ?>"
                data-label="<?= $label ?>"
                class="form-control w-100 h-[3rem] text-lg px-2 pt-2 rounded-sm outline-accent focus:outline-solid <?= $className ?? null ?>"
                data-password-target
                <?= !empty($placeholder) ? "placeholder='$placeholder'" : null ?>
                <?= !empty($attributeData) ? $attributeData : null ?>
                <?= isset($disabled) ? strval($disabled) : null  ?>
                <?= $required ? "required" : null ?>
                <?= isset($storeValue[$name]) && $storeValue[$name] == $value && isset($type) ?>
                <?= strval($readonly) ?? null ?>>
            <?php if (!isset($labelNot)) : ?>
                <label class="absolute left-1 top-20" data-label-toggle data-component="email-toggle:label" for="<?= $id ?? $name ?>">
                    <strong>
                        <?= ucfirst($label) ?>
                        <?= isset($required) && $required == "true" ?  view("/components/shared/forms/tooltip/required") : null ?>
                    </strong>
                </label>
            <?php endif; ?>
        </div>
        <?php if (isset($icon)) : ?>
            <div class="absolute right-1 top-20">
                <div class="input-group-append absolute w-[1rem] h-[1rem] top-20 right-2 z-20 text-accent">
                    <?= $icon ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
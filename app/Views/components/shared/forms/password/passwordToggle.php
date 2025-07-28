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

<div class="password-toggle" data-password='visibility'>
    <div class="input-group relative">

        <input class="form-control w-100 h-[3rem] text-lg px-2 pt-2 rounded-sm outline-accent focus:outline-solid" type="password" name="password" data-password-target
            name="<?= $name ?>"
            value="<?= isset($name) ? $name : null ?>"
            id="<?= $id ?? $name ?>"
            data-label="<?= $label ?>"
            <?= !empty($placeholder) ? "placeholder='$placeholder'" : null ?>
            <?= !empty($attributeData) ? $attributeData : null ?>
            <?= isset($disabled) ? strval($disabled) : null  ?>
            <?= $required ? "required" : null ?>
            <?= isset($storeValue[$name]) && $storeValue[$name] == $value && isset($type) ?>
            <?= strval($readonly) ?? null ?>>
        <label class="absolute left-1 top-20" data-label-toggle data-component="password-toggle:label" for="<?= $id ?? $name ?>">
            <strong>
                <?= ucfirst($label) ?>
                <?= isset($required) && $required == "true" ?  view("/components/shared/forms/tooltip/required") : null ?>

            </strong>
        </label>
        <div data-component="password-toggle:visibility" class="input-group-append absolute w-[1rem] h-[1rem] top-20 right-2 z-20 cursor-pointer fill-accent" data-password-visibility='show'>
        </div>
    </div>
</div>
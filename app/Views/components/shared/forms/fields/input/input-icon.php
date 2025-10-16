<?php

$session = session();
$storeValue = $session->get($form ?? "");

if (isset($name) && isset($storeValue[$name]))
    $value = $storeValue[$name];

$requiredIcon = isset($required) && strval($required) == "true" ? "*" : "";
$id = !empty($id) ?  $id : $name;
?>

<div class="input mb-3" component="input-icon">
    <div class="relative flex shadow-sm border-gray-200 border-2 rounded-md">
        <?php if (isset($iconLeft) || !isset($iconRight)) : ?>
            <label class="text-lg py-2 px-4 text-black-700" component="input-icon:label" for="<?= $id ?>">
                <?= isset($iconLeft) ? $iconLeft : '<i class="bi bi-pencil"></i>' ?>
            </label>
        <?php endif; ?>
        <div class="w-100">
            <input type="<?= $type  ?>"
                name="<?= $name ?>"
                value="<?= isset($value) ? $value : null ?>"
                id="<?= $id ?>"
                data-label="<?= $label ?>"
                class="form-control w-100 h-100 text-md px-3 rounded-sm outline-accent focus:outline-solid <?= $class ?? null ?>"
                <?= !empty($label) ? "placeholder='$label" . "$requiredIcon'" : null ?>
                <?= getAttributes($attributes) ?>
                <?= isset($disabled) ? strval($disabled) : null  ?>
                <?= $required ? "required" : null ?>
                <?= strval($readonly) ?? null ?>>

        </div>
        <?php if (isset($iconRight)) : ?>
            <label class="text-lg py-2 px-4 text-black-700" component="input-icon:label" for="<?= $id ?? $name ?>">
                <?= isset($iconRight) ? $iconRight : '<i class="bi bi-pencil"></i>' ?>
            </label>
        <?php endif; ?>
    </div>
    <div class="invalid-message text-xs text-red-500 px-2 mt-1" data-invalid="<?= $name ?>">
    </div>
</div>
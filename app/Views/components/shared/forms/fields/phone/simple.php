<?php

$session = session();
$storeValue = $session->get($form ?? "");

if (isset($name) && isset($storeValue[$name]))
    $value = $storeValue[$name];

$requiredIcon = isset($required) && strval($required) == "true" ? "*" : "";
?>

<div class="input mb-3" component="phone"
    code="<?= $code ?? "br" ?>">
    <div class="relative flex shadow-sm border-gray-200 border-2 rounded-md">
        <div class="w-100 relative">
            <div class="absolute">
                <input type="text" component='phone:reference'>
            </div>
            <input type="<?= $type  ?>"
                name="<?= $name ?>"
                component='phone:input'
                value="<?= isset($value) ? $value : null ?>"
                id="<?= $id ?? $name ?>"
                data-label="<?= $label ?>"
                class="form-control  block ml-auto w-88 h-100 text-md pl-3 py-3 rounded-sm outline-accent focus:outline-solid <?= $class ?? null ?>"
                <?= getAttributes($attributes) ?>
                <?= isset($disabled) ? strval($disabled) : null  ?>
                <?= $required ? "required" : null ?>
                <?= strval($readonly) ?? null ?>>
        </div>
    </div>
    <div class="invalid-message text-xs text-red-500 px-2 mt-1" data-invalid="<?= $name ?>">
    </div>
</div>
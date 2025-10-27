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
            <input type="text"
                name="<?= $name ?>"
                component='phone:input'
                value="<?= isset($value) ? $value : null ?>"
                id="<?= !empty($id) ? $id : $name ?>"
                data-label="<?= $label ?>"
                class="form-control  block ml-auto w-100 h-[3rem] text-md pl-16 pt-4 rounded-sm outline-theme focus:outline-solid <?= $class ?? null ?>"
                <?= getAttributes($attributes) ?>
                <?= isset($disabled) ? strval($disabled) : null  ?>
                <?= $required ? "required" : null ?>
                <?= strval($readonly) ?? null ?>>
            <?php if (isset($label)) : ?>
                <label class="absolute left-1 top-15 pl-14 text-sm lg:text-lg text-black-700" data-label-toggle component="input:label" for="<?= !empty($id) ? $id : $name ?>">
                    <strong class="font-arial">
                        <?= ucfirst($label) ?>
                        <?= isset($required) && $required == "true" ?  Component("/components/shared/forms/variants/tooltip/required") : null ?>
                    </strong>
                </label>
            <?php endif; ?>
        </div>
    </div>
    <div class="invalid-message text-xs text-red-500 px-2 mt-1" data-invalid="<?= $name ?>">
    </div>
</div>
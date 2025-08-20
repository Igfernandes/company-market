<?php

use App\Components\Shared\Forms\Fields\Date\DateInput\DateInput;

$session = session();
$storeValue = $session->get($form ?? "");

if (isset($name) && isset($storeValue[$name]))
    $value = $storeValue[$name];

$requiredIcon = isset($required) && strval($required) == "true" ? "*" : "";
?>

<div class="date mb-3" component="date-icon">
    <div class="relative flex shadow-sm border-gray-200 border-2 rounded-md">
        <?php if (isset($iconLeft) || !isset($iconRight)) : ?>
            <label class="text-lg py-2 px-4 text-black-700" component="input-icon:label" for="<?= $id ?? $name ?>">
                <?= isset($iconLeft) ? $iconLeft : '<i class="bi bi-pencil"></i>' ?>
            </label>
        <?php endif; ?>
        <div class="w-100">
            <input type="text"
                component='date-icon:input'
                country="br"
                value="<?php
                        if (isset($value)) {
                            $date = new Datetime($value);
                            echo $date->format("d/m/Y");
                        } ?>"
                id="<?= $id ?? $name ?>"
                class="form-control w-100 h-100 text-md px-3 rounded-sm outline-accent focus:outline-solid  <?= isset($iconRight) ? "text-right" : "text-left"   ?> <?= $class ?? null ?>"
                <?= !empty($placeholder) ? "placeholder='$placeholder'" : null ?>
                <?= getAttributes($attributes) ?>
                <?= isset($disabled) ? strval($disabled) : null  ?>
                <?= $required ? "required" : null ?>
                <?= strval($readonly) ?? null ?>>
            <div class="absolute top-22 <?= isset($iconRight) ? "left" : "right"   ?>-4 w-[1rem] h-full cursor-pointer">
                <input
                    value="<?= isset($value) ? $value : null ?>"
                    name="<?= $name ?>"
                    type="date"
                    data-label="<?= $label ?>"
                    component='date-icon:reference'
                    class="w-100 h-100 absolute left-0 opacity-0" style="top:-1rem">
                <i class="bi bi-calendar4-event cursor-pointer"></i>
            </div>

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
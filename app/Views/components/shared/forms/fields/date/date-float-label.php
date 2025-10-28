<?php

$session = session();
$storeValue = $session->get($form ?? "");

if (isset($name) && isset($storeValue[$name]))
    $value = $storeValue[$name];

?>

<div class="date mb-3" component="date" date='true'>
    <div class="relative shadow-sm border-gray-200 border-2 rounded-md">
        <div class="w-100">
            <div class="absolute top-22 <?= isset($iconRight) ? "left" : "right"   ?>-2 w-[1rem] h-full cursor-pointer">
                <input
                    value="<?= isset($value) ? $value : null ?>"
                    type="date" name="<?= $name ?>"
                    data-label="<?= $label ?>"
                    component='date:reference'
                    class="w-100 h-100 absolute left-0 opacity-0" style="top:-1rem">
                <i class="bi bi-calendar4-event cursor-pointer"></i>
            </div>
            <input type="text"
                component='date:input'
                country="br"
                value="<?php
                        if (isset($value)) {
                            $date = new Datetime($value);
                            echo $date->format("d/m/Y");
                        } ?>"
                id="<?= $id ?? $name ?>"
                class="form-control w-100 h-[3.5rem] text-sm lg:text-lg pl-2 pr-9 pt-3 rounded-sm outline-accent focus:outline-solid <?= $className ?? null ?>"
                <?= !empty($placeholder) ? "placeholder='$placeholder'" : null ?>
                <?= getAttributes($attributes) ?>
                <?= isset($disabled) ? strval($disabled) : null  ?>
                <?= $required ? "required" : null ?>
                <?= strval($readonly) ?? null ?>>
            <?php if (!isset($labelNot)) : ?>
                <label class="absolute left-1 top-2 pl-1 text-sm lg:text-sm text-black-600" data-label-toggle component="email:label" for="<?= !empty($id) ? $id : $name ?>">
                    <strong class="font-arial text-black-600">
                        <?= ucfirst($label) ?>
                        <?= isset($required) && $required == "true" ?  Component("/components/shared/forms/variants/tooltip/required") : null ?>
                    </strong>
                </label>
            <?php endif; ?>

        </div>
        <?php if (isset($icon)) : ?>
            <div class="absolute right-0 top-0 h-full pt-2 pr-2">
                <div class="input-group-append text-xl w-[1.5rem] h-[1rem] text-accent">
                    <?= $icon ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="invalid-message text-xs text-red-500 px-2 mt-1" data-invalid="<?= $name ?>">
    </div>
</div>
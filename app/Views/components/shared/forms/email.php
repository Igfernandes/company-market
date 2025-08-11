<?php

$session = session();
$storeValue = $session->get($form ?? "");

if (isset($name) && isset($storeValue[$name]))
    $value = $storeValue[$name];

?>

<div class="email mb-3" component="email">
    <div class="relative shadow-sm border-gray-200 border-2 rounded-md">
        <div class="w-100">
            <input type="email"
                name="<?= $name ?>"
                value="<?= isset($value) ? $value : null ?>"
                id="<?= $id ?? $name ?>"
                data-label="<?= $label ?>"
                class="form-control w-100 h-[3rem] text-lg pl-2 pr-9 pt-2 rounded-sm outline-accent focus:outline-solid <?= $className ?? null ?>"
                <?= !empty($placeholder) ? "placeholder='$placeholder'" : null ?>
                <?= getAttributes($attribute) ?>
                <?= isset($disabled) ? strval($disabled) : null  ?>
                <?= $required ? "required" : null ?>
                <?= strval($readonly) ?? null ?>>
            <?php if (!isset($labelNot)) : ?>
                <label class="absolute left-1 top-20 pl-1 text-black-700" data-label-toggle component="email:label" for="<?= $id ?? $name ?>">
                    <strong class="font-arial">
                        <?= ucfirst($label) ?>
                        <?= isset($required) && $required == "true" ?  Component("/components/shared/forms/tooltip/required") : null ?>
                    </strong>
                </label>
            <?php endif; ?>
        </div>
        <?php if (isset($icon)) : ?>
            <div class="absolute right-0 top-0 h-full pt-2 pr-2 ">
                <div class="input-group-append text-xl w-[1.5rem] h-[1rem] text-accent">
                    <?= $icon ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="invalid-message text-xs text-red-500 px-2 mt-1" data-invalid="<?= $name ?>">
    </div>
</div>
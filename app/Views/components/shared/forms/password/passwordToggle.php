<?php
$session = session();
$storeValue = $session->get($form ?? "");

if (isset($name) && isset($storeValue[$name]))
    $value = $storeValue[$name];

?>

<div class="password-toggle mb-3" component="password-toggle" data-password='visibility'>
    <div class="input-group relative shadow-sm border-gray-200 border-2 rounded-md">
        <input class="form-control w-100 h-[3rem] text-lg px-2 pt-2 rounded-sm outline-accent focus:outline-solid" type="password" name="password" data-password-target
            name="<?= $name ?>"
            value="<?= isset($value) ? $value : null ?>"
            id="<?= $id ?? $name ?>"
            data-label="<?= $label ?>"
            <?= !empty($placeholder) ? "placeholder='$placeholder'" : null ?>
            <?= getAttributes($attributes) ?>
            <?= isset($disabled) ? strval($disabled) : null  ?>
            <?= $required ? "required" : null ?>
            <?= strval($readonly) ?? null ?>>
        <label class="absolute left-1 top-20 pl-1 text-black-700" data-label-toggle component="password-toggle:label" for="<?= $id ?? $name ?>">
            <strong>
                <?= ucfirst($label) ?>
                <?= isset($required) && $required == "true" ?  Component("/components/shared/forms/tooltip/required") : null ?>

            </strong>
        </label>
        <div component="password-toggle:visibility" class="input-group-append absolute w-[.5rem] h-[.5rem] top-20 right-2 z-20 cursor-pointer fill-accent" data-password-visibility='show'>
        </div>
    </div>
    <div class="invalid-message text-xs text-red-500 px-2 mt-1" data-invalid="<?= $name ?>">
    </div>
</div>
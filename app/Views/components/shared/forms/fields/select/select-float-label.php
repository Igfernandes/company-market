<?php

$session = session();
$storeValue = $session->get($form ?? "");

if (isset($name) && isset($storeValue[$name]))
    $value = $storeValue[$name];

?>

<div class="mb-3" component="select">
    <div class="relative shadow-sm border-gray-200 border-2 rounded-md">
        <div class="w-100">
            <select
                name="<?= $name ?>"
                id="<?= !empty($id) ? $id : $name ?>"
                data-label="<?= $label ?>"
                class="form-control w-100 h-[3.5rem] text-sm lg:text-lg pl-2 pr-9 pt-3 rounded-sm outline-accent focus:outline-solid <?= $className ?? null ?>"
                <?= isset($disabled) ? strval($disabled) : null ?>
                <?= $required ? "required" : null ?>
                <?= strval($readonly) ?? null ?>
                <?= getAttributes($attributes) ?>>
                <?php if (!empty($placeholder)) : ?>
                    <option value=""><?= $placeholder ?></option>
                <?php endif; ?>
                <?php foreach ($options as $key => $option) : ?>
                    <option value="<?= $key ?>" <?= (isset($value) && $value == $key) ? "selected" : "" ?>>
                        <?= $option ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <?php if (!isset($labelNot)) : ?>
                <label class="absolute left-1 top-4 pl-1 text-sm text-black-500" component="select:label" for="<?= !empty($id) ? $id : $name ?>">
                    <strong class="font-arial">
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

    <div class="invalid-message text-xs text-red-500 px-2 mt-1" data-invalid="<?= $name ?>"></div>
</div>
